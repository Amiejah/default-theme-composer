<?php

namespace Humpff\Posts;

use Humpff\Posts\Concerns\InteractsWithCustomPosts;
use Humpff\Shared\Component;

class CptPosts extends Component
{
    use InteractsWithCustomPosts;

    /**
     * Register custom post types
     * @action after_setup_theme
     */
    public function init(): void
    {
        $this->setTypes([
            'services' => __('Services'),
            'team' => __('Teams'),
            'vacancies' => __('Vacancies'),
            'faq' => __('FAQ'),
        ]);
    }

    /**
     * Register custom post types
     * @action init
     */
    public function registerPosts()
    {

        $filtered = $this->getTypes()->except(
            $this->getDisabledTypes()->toArray()
        );

        // dd($filtered, $this->getTypes(), $this->getDisabledTypes());
    }
}