<?php

namespace RossBearman\ActiveCampaign\DataObjects;

class ActiveCampaignTag
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly string $description,
    ) {
    }
}
