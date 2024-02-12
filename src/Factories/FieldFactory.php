<?php

namespace RossBearman\ActiveCampaign\Factories;

use RossBearman\ActiveCampaign\DataObjects\ActiveCampaignField;

class FieldFactory
{
    public static function make(array $attributes): ActiveCampaignField
    {
        return new ActiveCampaignField(
            (int) $attributes['id'],
            $attributes['title'],
            $attributes['descript'],
            $attributes['type'],
            $attributes['isrequired'],
            $attributes['perstag'],
            $attributes['defval'],
            $attributes['show_in_list'],
            $attributes['rows'],
            $attributes['cols'],
            $attributes['visible'],
            $attributes['service'],
            $attributes['ordernum'],
            $attributes['cdate'],
            $attributes['udate'],
            $attributes['options'],
            $attributes['relations'],
            $attributes['links']
        );
    }
}
