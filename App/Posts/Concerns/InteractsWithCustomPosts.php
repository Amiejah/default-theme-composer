<?php

namespace Humpff\Posts\Concerns;

use Illuminate\Support\Collection;

trait InteractsWithCustomPosts
{
    protected Collection|array $types;
    protected Collection|array $disabledTypes;

    protected function registerPostsTypes(): void
    {}

    public function setTypes( array $types = [] )
    {
        $this->types = $types;
    }

    public function getTypes(): Collection
    {
        return collect($this->types);
    }

    /**
     * Get disabled types
     */
    public function getDisabledTypes(): Collection
    {
        $this->disabledTypes = carbon_get_theme_option('disabled_types');

        return collect($this->disabledTypes);
    }
}