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

namespace christwood\UserBundle\Entity;

use Doctrine\ORM\PersistentCollection;
use Symfony\Component\Security\Core\User\UserInterface as BaseUserInterface;

/**
 * User Interface.
 *
 */
interface UserInterface extends BaseUserInterface
{
    public function getId(): int;

    /**
     * @return ProfileInterface
     */
    public function getProfile(): ?ProfileInterface;

    /**
     * @return $this
     */
    public function setProfile(ProfileInterface $profile): self;

    /**
     * @param $username
     *
     * @return $this
     */
    public function setUsername(string $username): self;

    /**
     * @param $password
     *
     * @return $this
     */
    public function setPassword(string $password): self;

    /**
     * @return string
     */
    public function getEmail(): ?string;

    /**
     * @param $email
     *
     * @return $this
     */
    public function setEmail(string $email): self;

    /**
     * @return bool
     */
    public function isActive(): bool;

    /**
     * @param $enabled
     *
     * @return $this
     */
    public function setActive(bool $enabled): self;

    /**
     * @return bool
     */
    public function isFreeze(): bool;

    /**
     * @param $enabled
     *
     * @return $this
     */
    public function setFreeze(bool $enabled): self;

    /**
     * @return \DateTime
     */
    public function getLastLogin(): ?\DateTime;

    /**
     * @return $this
     */
    public function setLastLogin(\DateTime $time = null): self;

    /**
     * @return string|null
     */
    public function getLastLoginIp(): ?string;

    /**
     * @return $this
     */
    public function setLastLoginIp(?string $lastLoginIp): self;

    /**
     * @return string
     */
    public function getConfirmationToken(): ?string;

    /**
     * @param string $confirmationToken
     *
     * @return $this
     */
    public function setConfirmationToken(?string $confirmationToken): self;

    /**
     * @return $this
     */
    public function createConfirmationToken(): self;

    /**
     * @return \DateTime
     */
    public function getPasswordRequestedAt(): ?\DateTime;

    /**
     * @return $this
     */
    public function setPasswordRequestedAt(\DateTime $date = null): self;

    /**
     * @param $ttl
     */
    public function isPasswordRequestNonExpired($ttl): bool;

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime;

    /**
     * @return $this
     */
    public function setCreatedAt(\DateTime $time = null): self;

    /**
     * @return array
     */
    public function getRolesUser(): ?array;

    /**
     * @return $this
     */
    public function setRoles(array $roles): self;

    /**
     * @param $role
     *
     * @return $this
     */
    public function addRole(string $role): self;

    /**
     * @param $role
     *
     * @return $this
     */
    public function removeRole(string $role): self;

    /**
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool;

    /**
     * @return array|null
     */
    public function getGroupNames(): ?array;

    /**
     * Get Group Collection.
     */
    public function getGroups();

    /**
     * @param string $name
     * @return bool
     */
    public function hasGroup(string $name): bool;

    /**
     * @return $this
     */
    public function addGroup(GroupInterface $group): self;

    /**
     * @return $this
     */
    public function removeGroup(GroupInterface $group): self;
}
