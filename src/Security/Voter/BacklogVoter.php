<?php

/*
 * Pull your hearder here, for exemple, Licence header.
 */

namespace App\Security\Voter;

use App\Entity\Backlog;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class BacklogVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    protected function supports($attribute, $subject)
    {
        return \in_array($attribute, ['SHOW', 'EDIT', 'DELETE', 'MOVE'], true)
            && $subject instanceof Backlog;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
//        $user = $token->getUser();
//
//        if (!$user instanceof UserInterface) {
//            return false;
//        }

        switch ($attribute) {
            case 'SHOW':
                return true;
                break;
            case 'EDIT':
                return true;
                break;
            case 'DELETE':
                return true;
                break;
            case 'MOVE':
                return true;
                break;
        }

        return false;
    }
}
