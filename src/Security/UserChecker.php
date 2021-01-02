<?php

namespace christwood\UserBundle\Security;

use christwood\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User Checker.
 *
 */
class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof UserInterface) {
            return;
        }

        // Frozen Account
        /** @var User $user */
        if ($user->isFreeze()) {
            throw new CustomUserMessageAuthenticationException('The account has been suspended');
        }

        // Activate Account
        /** @var User $user */
        if (!$user->isActive()) {
            throw new CustomUserMessageAuthenticationException('Account has not been activated');
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof UserInterface) {
            return;
        }
    }
}
