<?php

namespace RossBearman\ActiveCampaign\Factories;

use RossBearman\ActiveCampaign\DataObjects\ActiveCampaignContact;

class ContactFactory
{
    /**
     * @param  array<string>  $attributes
     */
    public static function make(array $attributes): ActiveCampaignContact
    {
        return new ActiveCampaignContact(
            (int) $attributes['id'],
            $attributes['email'],
            $attributes['phone'],
            $attributes['firstName'],
            $attributes['lastName'],
        );
    }
}
