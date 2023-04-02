<?php
declare(strict_types=1);

namespace RedFireDigital\Helper\Service\UserActionsLogger;

interface PersisterInterface
{
    public function persist(object $object);

    public function flush();
}
