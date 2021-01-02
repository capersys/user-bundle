<?php

/*
 * This file is part of the UserBundle package
 *
 * @author Christ Wood
 * @link https://github.com/ChristWood/userBundle
 *
 * The MIT License (MIT)
 * Copyright (c) 2021
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */


namespace christwood\UserBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

/**
 * User Role Changer.
 *
 */
class RoleUserCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var string
     */
    private $userClass;

    public function __construct(EntityManagerInterface $entityManager, string $userClass)
    {
        $this->em = $entityManager;
        $this->userClass = $userClass;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('user:role')
            ->setDescription('Change user role')
            ->addArgument('email', InputArgument::OPTIONAL, 'Email address')
            ->addArgument('role', InputOption::VALUE_OPTIONAL, 'User Role');
    }

    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('email')) {
            $question = new Question('Email Address: ');
            $question->setValidator(function ($email) {
                if (empty($email)) {
                    throw new \RuntimeException('Email can not be empty');
                }

                return $email;
            });
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setArgument('email', $answer);
        }

        if (!$input->getArgument('role')) {
            $question = new ChoiceQuestion('Role: ', ['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPER_ADMIN'], 2);
            $question->setMultiselect(true);
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setArgument('role', $answer);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // Find User
        $user = $this->em->getRepository($this->userClass)->findOneBy(['email' => $input->getArgument('email')]);

        if (null !== $user) {
            // Set Roles
            $user->setRoles($input->getArgument('role'));

            // Save
            $this->em->persist($user);
            $this->em->flush();

            // Output
            $output->writeln('User Roles Changed:');
            $output->writeln(sprintf('Email: <comment>%s</comment>', $user->getEmail()));
            $output->writeln(sprintf('Roles: <comment>%s</comment>', implode(',', $input->getArgument('role'))));
        } else {
            $output->writeln('User not found!');
        }

        return 0;
    }
}
