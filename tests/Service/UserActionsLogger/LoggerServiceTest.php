<?php

namespace RedFireDigital\Helper\Service\UserActionsLogger;

use PHPUnit\Framework\TestCase;

class PersisterConcrete implements PersisterInterface
{

    public function persist(object $object)
    {
        // TODO: Implement persist() method.
    }

    public function flush()
    {
        // TODO: Implement flush() method.
    }
}

class UserActionConcrete extends UserAction
{

}

class UserConcrete implements UserInterface
{
    protected $actions = [];

    public function getUserActions(): null|array
    {
        return $this->actions;
    }

    public function setUserActions($userActions)
    {
        $this->actions = $userActions;
    }

    public function addUserAction(UserAction $userAction)
    {
        $this->actions[] = $userAction;
    }
}

class LoggerServiceTest extends TestCase
{
    public function test_it_should_log_an_action() {
        $user = new UserConcrete();
        $details = [
            'headers' => 'test',
            'method' => 'GET'
        ];

        $userAction = new UserActionConcrete(
            $user,
            UserAction::VIEW_ACTION,
            'Client',
            '54321',
            $details
        );
        $persiser = $this->createMock(PersisterInterface::class);
        $persiser->expects($this->once())
            ->method('persist')
            ->with($this->equalTo($userAction));

        $loggerService = new LoggerService($persiser);
        $loggerService->log($userAction);
    }
}
