<?php

namespace christwood\UserBundle\Security;

use christwood\UserBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * User Switcher.
 *
 */
class SwitchUserVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return 'CAN_SWITCH_USER' === $attribute && $subject instanceof UserInterface;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        if (!$user instanceof UserInterface || !$subject instanceof UserInterface) {
            return false;
        }

        // All Access
        if (\in_array(User::ROLE_ALL_ACCESS, $token->getRoleNames(), true)) {
            return true;
        }

        // Check Account Switcher
        if (\in_array('ROLE_ALLOWED_TO_SWITCH', $user->getRoles(), true)) {
            return true;
        }

        return false;
    }
}
