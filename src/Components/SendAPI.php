<?php

namespace Oxemis\OxiMailing\Components;

use Oxemis\OxiMailing\ApiClient;
use Oxemis\OxiMailing\ApiException;
use Oxemis\OxiMailing\Objects\Message;

/**
 * Class for https://api.oximailing.com/doc/#/send
 */
class SendAPI extends Component
{

    /**
     * @param ApiClient $apiClient
     */
    public function __construct(ApiClient $apiClient)
    {
        parent::__construct($apiClient);
    }

    /**
     * @param Message $message  The Message you want to send.
     * @return object           Informations about the sending (see API doc for details).
     * @throws ApiException
     */
    public function send(Message $message): object
    {
        return ($this->request("POST", "/send", null, json_encode($message)));
    }

    /**
     * @param string $JSONMessage   The JSON representation of the message you want to send (see :https://api.oximailing.com/doc/#/send/post_send).
     * @return object               Informations about the sending (see API doc for details).
     * @throws ApiException
     */
    public function sendJSON(string $JSONMessage): object
    {
        return ($this->request("POST", "/send", null, $JSONMessage));
    }

    /**
     * @return array|null           List of scheduled sendings.
     * @throws ApiException
     */
    public function getScheduled(): ?array
    {
        return ($this->request("GET", "/scheduled"));
    }

    /**
     * @param int $sendingID        The ID of the sending you want to cancel.
     * @return bool
     * @throws ApiException
     */
    public function deleteScheduled(int $sendingID): bool
    {
        $result = $this->request("DELETE", "/scheduled", ["sendingid" => $sendingID]);
        return ($result->Code == 200);
    }

}
