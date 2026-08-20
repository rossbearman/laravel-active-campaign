<?php

namespace RossBearman\ActiveCampaign\Resources;

use Illuminate\Support\Collection;
use RossBearman\ActiveCampaign\DataObjects\ActiveCampaignMessage;
use RossBearman\ActiveCampaign\Exceptions\ActiveCampaignException;
use RossBearman\ActiveCampaign\Factories\MessageFactory;

class ActiveCampaignMessagesResource extends ActiveCampaignBaseResource
{
    /**
     * Retrieve an existing message by its ID.
     *
     * @see https://developers.activecampaign.com/reference/retrieve-a-message
     *
     * @throws ActiveCampaignException
     */
    public function get(string $id): ActiveCampaignMessage
    {
        return MessageFactory::make($this->request(
            method: 'get',
            path: 'messages/'.$id,
            responseKey: 'message'
        ));
    }

    /**
     * List all messages, or filter messages by query defined criteria.
     *
     * @see https://developers.activecampaign.com/reference/list-all-messages
     *
     * @return Collection<int, ActiveCampaignMessage>
     *
     * @throws ActiveCampaignException
     */
    public function list(?string $query = ''): Collection
    {
        $messages = $this->request(
            method: 'get',
            path: 'messages?'.$query,
            responseKey: 'messages'
        );

        return collect($messages)
            ->map(fn ($message) => MessageFactory::make($message));
    }

    /**
     * Create a message and return the message ID.
     *
     * @see https://developers.activecampaign.com/reference/create-a-new-message
     *
     * @param  array<string, mixed>  $attributes
     *
     * @throws ActiveCampaignException
     */
    public function create(string $fromname, string $fromemail, string $reply2, array $attributes = []): string
    {
        $message = $this->request(
            method: 'post',
            path: 'messages',
            data: [
                'message' => array_merge($attributes, [
                    'fromname' => $fromname,
                    'fromemail' => $fromemail,
                    'reply2' => $reply2,
                ]),
            ],
            responseKey: 'message'
        );

        return $message['id'];
    }

    /**
     * Update an existing message.
     *
     * @see https://developers.activecampaign.com/reference/update-a-message
     *
     * @throws ActiveCampaignException
     */
    public function update(ActiveCampaignMessage $message): ActiveCampaignMessage
    {
        return MessageFactory::make($this->request(
            method: 'put',
            path: 'messages/'.$message->id,
            data: [
                'message' => [
                    'name' => $message->name,
                    'fromname' => $message->fromname,
                    'fromemail' => $message->fromemail,
                    'reply2' => $message->reply2,
                    'subject' => $message->subject,
                    'preheader_text' => $message->preheader_text,
                    'text' => $message->text,
                    'html' => $message->html,
                ],
            ],
            responseKey: 'message'
        ));
    }

    /**
     * Delete an existing message by its ID.
     *
     * @see https://developers.activecampaign.com/reference/delete-a-message
     *
     * @throws ActiveCampaignException
     */
    public function delete(string $id): void
    {
        $this->request(
            method: 'delete',
            path: 'messages/'.$id
        );
    }
}
