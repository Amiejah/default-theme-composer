<?php

namespace Humpff\Shared\Concerns;

interface InteractsWithComponent
{
    public function init(): void;

    public function id(): string;

    public function setId($id): void;

    public function getId(): string;

    public function tab($callback): self;
}