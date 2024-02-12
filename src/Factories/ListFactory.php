<?php

namespace RossBearman\ActiveCampaign\Factories;

use RossBearman\ActiveCampaign\DataObjects\ActiveCampaignList;

class ListFactory
{
    /**
     * @param  array<string>  $attributes
     */
    public static function make(array $attributes): ActiveCampaignList
    {
        return new ActiveCampaignList(
            $attributes['id'],
            $attributes['name'],
            $attributes['stringid'],
            $attributes['sender_url'],
            $attributes['sender_reminder'],
            $attributes['send_last_broadcast'],
            $attributes['carboncopy'],
            $attributes['subscription_notify'],
            $attributes['unsubscription_notify'],
            (int) $attributes['user'],
        );
    }
}
