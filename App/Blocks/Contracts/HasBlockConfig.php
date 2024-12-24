<?php

namespace Humpff\Blocks\Contracts;


interface HasBlockConfig
{
    public function getConfig(): array;

    public function getFields(): array;

    public function getBlockType(): string;

    public function getBlockName(): string;

    public function getBlockTitle(): string;

    public function getBlockDescription(): string;
}