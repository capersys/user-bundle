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

/**
 * User Group Interface.
 *
 */
interface GroupInterface
{
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName(string $name): self;

    /**
     * @return array
     */
    public function getRoles(): ?array;

    /**
     * @return $this
     */
    public function setRoles(array $roles): self;

    /**
     * @return $this
     */
    public function addRole(string $role): self;

    /**
     * @return $this
     */
    public function removeRole(string $role): self;

    /**
     * @param $role
     */
    public function hasRole(string $role): bool;
}
