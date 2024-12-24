<?php

namespace Humpff\Shared;

use Humpff\Shared\Concerns\InteractsWithComponent;

class Component implements InteractsWithComponent
{
    protected $__id;

    protected $__name;

    public function init(): void
    {}

    public function id(): string
    {
        return $this->getId();
    }

    public function setId($id): void
    {
        $this->__id = $id;
    }

    public function getId(): string
    {
        return $this->__id;
    }

    public function tab($callback): self
    {
        $callback($this);

        return $this;
    }
}