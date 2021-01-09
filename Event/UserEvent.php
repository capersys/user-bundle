<?php

namespace Capersys\UserBundle\Event;

/*
 * This file is part of the UserBundle package
 *
 * @author Christ Wood
 * @link https://github.com/Capersys/userBundle
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


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * User Account Events.
 *
 */
class UserEvent extends Event
{
    public const REGISTER_BEFORE = 'user.register_before';
    public const REGISTER = 'user.register';
    public const REGISTER_CONFIRM = 'user.register_confirm';
    public const RESETTING = 'user.resetting';
    public const RESETTING_COMPLETE = 'user.resetting_complete';

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var Response
     */
    private $response;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Get User.
     */
    public function getUser(): UserInterface
    {
        return $this->user;
    }

    /**
     * Returns the response object.
     */
    public function getResponse(): ?Response
    {
        return $this->response;
    }

    /**
     * Sets a response and stops event propagation.
     */
    public function setResponse(Response $response): void
    {
        $this->response = $response;

        $this->stopPropagation();
    }

    /**
     * Returns whether a response was set.
     *
     * @return bool Whether a response was set
     */
    public function hasResponse(): bool
    {
        return null !== $this->response;
    }
}
