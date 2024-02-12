<?php

namespace RossBearman\ActiveCampaign\Factories;

use RossBearman\ActiveCampaign\DataObjects\ActiveCampaignFieldValue;

class FieldValueFactory
{
    /**
     * @param  array<string>  $attributes
     */
    public static function make(array $attributes): ActiveCampaignFieldValue
    {
        return new ActiveCampaignFieldValue(
            (int) $attributes['id'],
            $attributes['field'],
            $attributes['value'],
        );
    }
}
