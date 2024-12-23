<?php

namespace Humpff\Shared;

use Humpff\Contracts\HasComponent;

class Component implements HasComponent
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