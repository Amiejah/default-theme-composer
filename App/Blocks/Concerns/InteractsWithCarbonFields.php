<?php

namespace Humpff\Blocks\Concerns;

trait InteractsWithCarbonFields
{
    public function socialOptions(): array
    {
        return [
            'twitter' => 'Twitter',
            'instagram' => 'Instagram',
            'facebook' => 'Facebook',
            'linkedin' => 'Linkedin',
            'youtube' => 'Youtube',
            'vimeo' => 'Vimeo',
            'snapchat' => 'Snapchat',
            'tiktok' => 'TikTok',
        ];
    }

    public function defaultPostTypes(): array
    {
        return [
            'service' => __('Services'),
            'team' => __('Teams'),
            'vacancy' => __('Vacancies'),
            'faq' => __('FAQ'),
        ];
    }
}