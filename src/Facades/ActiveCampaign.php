<?php

namespace RossBearman\ActiveCampaign\Facades;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Facade;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignContactsResource;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignFieldValuesResource;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignTagsResource;

/**
 * @method PendingRequest makeRequest()
 * @method ActiveCampaignContactsResource contacts()
 * @method ActiveCampaignFieldValuesResource fieldValues()
 * @method ActiveCampaignTagsResource tags()
 */
class ActiveCampaign extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \RossBearman\ActiveCampaign\ActiveCampaign::class;
    }
}
