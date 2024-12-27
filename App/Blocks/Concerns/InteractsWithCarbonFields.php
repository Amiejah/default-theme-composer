<?php

namespace Humpff\Blocks\Concerns;

trait InteractsWithCarbonFields
{
    protected function socialOptions(): array
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
}