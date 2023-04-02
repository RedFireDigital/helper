<?php
declare(strict_types=1);

namespace RedFireDigital\Helper\Service\UserActionsLogger;

interface UserInterface
{
    public function getUserActions();
    public function setUserActions($userActions);
    public function addUserAction(UserAction $userAction);
}