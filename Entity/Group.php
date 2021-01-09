<?php
namespace Capersys\UserBundle\Entity;
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


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User Group.
 *
 */
class Group implements GroupInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true, length=180)
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="180")
     */
    protected $name;

    /**
     * @ORM\Column(type="array")
     */
    protected $roles;

    public function __construct($name, $roles = [])
    {
        $this->name = $name;
        $this->roles = $roles;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return $this
     */
    public function setName(string $name): GroupInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles(): ?array
    {
        return $this->roles;
    }

    /**
     * @return $this
     */
    public function setRoles(array $roles): GroupInterface
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @return $this
     */
    public function addRole(string $role): GroupInterface
    {
        if (!$this->hasRole($role)) {
            $this->roles[] = mb_strtoupper($role);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function removeRole(string $role): GroupInterface
    {
        if (false !== $key = array_search(mb_strtoupper($role), $this->roles, true)) {
            unset($this->roles[$key]);
            $this->roles = array_values($this->roles);
        }

        return $this;
    }

    /**
     * @param $role
     */
    public function hasRole(string $role): bool
    {
        return \in_array(mb_strtoupper($role), $this->roles, true);
    }
}