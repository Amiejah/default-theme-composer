<?php

namespace Humpff\Posts\Concerns;

use Carbon_Fields\Helper\Helper;
use Illuminate\Support\Collection;

trait InteractsWithTypes
{
    public Collection|array|null $types;

    protected Collection|array|null $disabledTypes;

    public function setTypes( array $types = [] ): void
    {
        $this->types = collect($types);
    }

    public function getTypes(): ?Collection
    {
        return $this->types;
    }

    public function getDisabledTypes(): Collection
    {
        $this->disabledTypes = Helper::get_theme_option('disabled_types') ?? null;

        return collect($this->disabledTypes);
    }

    public function getFilteredTypes(): Collection
    {
        return $this->getTypes()->except(
            $this->getDisabledTypes()->toArray()
        );
    }
}