<?php

namespace RossBearman\ActiveCampaign;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignContactsResource;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignFieldsResource;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignFieldValuesResource;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignListsResource;
use RossBearman\ActiveCampaign\Resources\ActiveCampaignTagsResource;

class ActiveCampaign
{
    public function __construct(
        public string $baseUrl,
        public string $key,
        public int $timeout,
        public ?int $retryTimes = null,
        public ?int $retrySleep = null,
    ) {
    }

    public function makeRequest(): PendingRequest
    {
        $request = Http::withHeaders([
            'Api-Token' => $this->key,
        ])
            ->acceptJson()
            ->baseUrl($this->baseUrl)
            ->timeout($this->timeout);

        if ($this->retryTimes != null && $this->retrySleep != null) {
            $request->retry($this->retryTimes, $this->retrySleep);
        }

        return $request;
    }

    public function contacts(): ActiveCampaignContactsResource
    {
        return new ActiveCampaignContactsResource($this);
    }

    public function fields(): ActiveCampaignFieldsResource
    {
        return new ActiveCampaignFieldsResource($this);
    }

    public function fieldValues(): ActiveCampaignFieldValuesResource
    {
        return new ActiveCampaignFieldValuesResource($this);
    }

    public function tags(): ActiveCampaignTagsResource
    {
        return new ActiveCampaignTagsResource($this);
    }

    public function lists(): ActiveCampaignListsResource
    {
        return new ActiveCampaignListsResource($this);
    }
}
