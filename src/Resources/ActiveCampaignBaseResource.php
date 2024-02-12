<?php

namespace RossBearman\ActiveCampaign\Resources;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use RossBearman\ActiveCampaign\ActiveCampaign;
use RossBearman\ActiveCampaign\Exceptions\ActiveCampaignException;

class ActiveCampaignBaseResource
{
    protected PendingRequest $client;

    public function __construct(
        protected ActiveCampaign $service,
    ) {
        $this->client = $this->service->makeRequest();
    }

    /**
     * @throws ActiveCampaignException
     */
    public function request(string $method, string $path, ?array $data = [], ?string $responseKey = null): array
    {
        if ($data === [] && $method === 'get') {
            $data = null;
        }

        try {
            /** @var Response $response */
            $response = $this->client->$method($path, $data);

            $responseBody = $response->throw()->json($responseKey);

            return is_array($responseBody) ? $responseBody : [$responseBody];
        } catch (RequestException $exception) {
            throw new ActiveCampaignException($exception->response);
        }
    }
}
