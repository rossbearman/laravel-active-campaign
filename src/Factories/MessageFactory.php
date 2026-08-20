<?php

namespace RossBearman\ActiveCampaign\Factories;

use RossBearman\ActiveCampaign\DataObjects\ActiveCampaignMessage;

class MessageFactory
{
    /**
     * The create endpoint returns a trimmed message object, so every attribute
     * that isn't present on that response must be treated as optional.
     *
     * @param  array<string>  $attributes
     */
    public static function make(array $attributes): ActiveCampaignMessage
    {
        return new ActiveCampaignMessage(
            $attributes['id'],
            isset($attributes['userid']) ? (int) $attributes['userid'] : null,
            $attributes['name'] ?? '',
            $attributes['fromname'],
            $attributes['fromemail'],
            $attributes['reply2'],
            $attributes['subject'] ?? null,
            $attributes['preheader_text'] ?? null,
            $attributes['text'] ?? null,
            $attributes['html'] ?? null,
            $attributes['charset'] ?? null,
            $attributes['encoding'] ?? null,
            $attributes['format'] ?? null,
            $attributes['priority'] ?? null,
            $attributes['hidden'] ?? null,
            $attributes['cdate'] ?? null,
            $attributes['mdate'] ?? null,
        );
    }
}
