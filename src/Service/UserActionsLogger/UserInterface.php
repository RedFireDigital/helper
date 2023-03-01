<?php
declare(strict_types=1);

namespace RedFireDigital\Helper\Service\UserActionsLogger;

interface UserInterface
{
    public function getUserActions(): null|array;
    public function setUserActions(array $userActions);
    public function addUserAction(UserAction $userAction);
}