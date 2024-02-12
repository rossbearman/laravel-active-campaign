<?php

namespace RossBearman\ActiveCampaign\Factories;

use RossBearman\ActiveCampaign\DataObjects\ActiveCampaignTag;

class TagFactory
{
    /**
     * @param  array<string>  $attributes
     */
    public static function make(array $attributes): ActiveCampaignTag
    {
        return new ActiveCampaignTag(
            (int) $attributes['id'],
            $attributes['tag'],
            $attributes['description'],
        );
    }
}
