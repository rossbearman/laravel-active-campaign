<?php

namespace RossBearman\ActiveCampaign\Facades;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Facade;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignContactsResource;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignFieldsResource;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignFieldValuesResource;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignListsResource;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignMessagesResource;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignTagsResource;

/**
 * @method PendingRequest makeRequest()
 * @method ActiveCampaignContactsResource contacts()
 * @method ActiveCampaignFieldsResource fields()
 * @method ActiveCampaignFieldValuesResource fieldValues()
 * @method ActiveCampaignTagsResource tags()
 * @method ActiveCampaignListsResource lists()
 * @method ActiveCampaignMessagesResource messages()
 */
class ActiveCampaign extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \RossBearman\ActiveCampaign\ActiveCampaign::class;
    }
}
