<?php

namespace RossBearman\ActiveCampaign\DataObjects;

class ActiveCampaignMessage
{
    public function __construct(
        public readonly string $id,
        public readonly ?int $userid,
        public readonly string $name,
        public readonly string $fromname,
        public readonly string $fromemail,
        public readonly string $reply2,
        public readonly ?string $subject,
        public readonly ?string $preheader_text,
        public readonly ?string $text,
        public readonly ?string $html,
        public readonly ?string $charset,
        public readonly ?string $encoding,
        public readonly ?string $format,
        public readonly ?string $priority,
        public readonly ?string $hidden,
        public readonly ?string $cdate,
        public readonly ?string $mdate,
    ) {
    }
}
