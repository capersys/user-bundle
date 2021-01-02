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


/**
 * User Profile Data.
 *
 */
interface ProfileInterface
{
    /**
     * Get id.
     */
    public function getId(): int;

    /**
     * Get firstname.
     *
     * @return string
     */
    public function getFirstName(): ?string;

    /**
     * Set firstname.
     *
     * @return $this
     */
    public function setFirstName(?string $firstname): self;

    /**
     * @return string
     */
    public function getLastName(): ?string;

    /**
     * Set Last Name.
     *
     * @return $this
     */
    public function setLastName(?string $lastname): self;

    /**
     * Get Full Name.
     */
    public function getFullName(): ?string;

    /**
     * @return string
     */
    public function getPhone(): ?string;

    /**
     * @return $this
     */
    public function setPhone(?string $phone): self;

    /**
     * Get website.
     *
     * @return string
     */
    public function getWebsite(): ?string;

    /**
     * @return $this
     */
    public function setWebsite(?string $website): self;

    /**
     * Get company.
     *
     * @return string
     */
    public function getCompany(): ?string;

    /**
     * @return $this
     */
    public function setCompany(?string $company): self;

    /**
     * @return string
     */
    public function getLanguage(): ?string;

    /**
     * @return $this
     */
    public function setLanguage(?string $language): self;

    /**
     * @return string
     */
    public function getCountry(): ?string;

    /**
     * @return $this
     */
    public function setCountry(?string $country): self;
}
