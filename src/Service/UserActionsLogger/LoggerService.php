<?php
declare(strict_types=1);

namespace RedFireDigital\Helper\Service\UserActionsLogger;

class LoggerService
{
    public function __construct(
        protected PersisterInterface $persister
    ) {}

    public function log(UserAction $userAction) {
        $this->persister->persist($userAction);
        $this->persister->flush();
    }
}
