<?php

namespace Humpff\Posts;

use Humpff\Shared\Component;
use Humpff\Posts\Concerns\InteractsWithTypes;
use Humpff\Blocks\Concerns\InteractsWithCarbonFields;
use PostTypes\PostType;

class CptPosts extends Component
{
    use InteractsWithTypes;
    use InteractsWithCarbonFields;

    /**
     * Initialize the custom posts types
     * @action carbon_fields_fields_registered
     */
    public function init(): void
    {
        $this
            ->getFilteredTypes()
            ->each(function ($label, $type) {
                $post = new PostType($type);
                $post->register();
            });
    }
}