<?php
declare(strict_types=1);

namespace RedFireDigital\Helper\Service\UserActionsLogger;
abstract class UserAction
{
    public const VIEW_ACTION = 'view';
    public const EDIT_ACTION = 'edit';
    public const DELETE_ACTION = 'delete';
    public const LIST_ACTION = 'list';

    private string|int|null $id;

    private ?string $action = null;

    private ?string $resource = null;

    private ?string $resourceId = null;

    private array|null $details = null;

    private ?\DateTimeInterface $createdDate = null;

    private ?UserInterface $user = null;

    public function __construct(
        UserInterface $user,
        string $action,
        string $resource,
        string $resourceId,
        array $details
    ) {
        $this->user = $user;
        $this->createdDate = new \DateTime();
        $this->action = $action;
        $this->resource = $resource;
        $this->resourceId = $resourceId;
        $this->details = $details;
    }

    public function getId(): int|string|null
    {
        return $this->id;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function getDetails(): ?array
    {
        return $this->details;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    public function getResource(): ?string
    {
        return $this->resource;
    }

    public function getResourceId(): ?string
    {
        return $this->resourceId;
    }
}