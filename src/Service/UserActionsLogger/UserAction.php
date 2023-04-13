<?php
declare(strict_types=1);

namespace RedFireDigital\Helper\Service\UserActionsLogger;
abstract class UserAction
{
    public const VIEW_ACTION = 'view';
    public const EDIT_ACTION = 'edit';
    public const DELETE_ACTION = 'delete';
    public const NEW_ACTION = 'new';
    public const LIST_ACTION = 'list';
    public const LOGIN_ACTION = 'login';
    public const LOGIN_FAILED_ACTION = 'login_failed';

    public const LOGOUT_ACTION = 'logout';
    protected string|int|null $id;

    protected ?string $action = null;

    protected ?string $resource = null;

    protected ?string $resourceId = null;

    protected array|null $details = null;

    protected ?\DateTimeInterface $createdDate = null;

    protected ?UserInterface $user = null;

    public function __construct(
        UserInterface|null $user,
        string $action,
        string|null $resource,
        string|null $resourceId,
        array|null $details
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