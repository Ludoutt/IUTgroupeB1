<?php

/*
 * Pull your hearder here, for exemple, Licence header.
 */

namespace App\Security\Voter;

use App\Entity\Backlog;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class BacklogVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return \in_array($attribute, ['VIEW', 'EDIT', 'DELETE'], true)
            && $subject instanceof Backlog;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case 'VIEW':
                return true;
                break;
            case 'EDIT':
                return true;
                break;
            case 'DELETE':
                return true;
                break;
        }

        return false;
    }
}
