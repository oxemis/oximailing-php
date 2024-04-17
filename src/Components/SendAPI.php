<?php

namespace Oxemis\OxiMailing\Components;

use Oxemis\OxiMailing\OxiMailingClient;
use Oxemis\OxiMailing\OxiMailingException;
use Oxemis\OxiMailing\Objects\Message;
use Oxemis\OxiMailing\Objects\ScheduledSending;
use Oxemis\OxiMailing\Objects\Sending;

/**
 * Class for https://api.oximailing.com/doc/#/send
 */
class SendAPI extends Component
{

    /**
     * @param OxiMailingClient $apiClient
     */
    public function __construct(OxiMailingClient $apiClient)
    {
        parent::__construct($apiClient);
    }

    /**
     * @param Message $message  The Message you want to send.
     * @return Sending          Informations about the sending (see API doc for details).
     * @throws OxiMailingException
     */
    public function send(Message $message): Sending
    {
        return ($this->sendJSON(json_encode($message)));
    }

    /**
     * @param string $JSONMessage   The JSON representation of the message you want to send (see :https://api.oximailing.com/doc/#/send/post_send).
     * @return Sending              Informations about the sending (see API doc for details).
     * @throws OxiMailingException
     */
    public function sendJSON(string $JSONMessage): Sending
    {
        $result = ($this->request("POST", "/send", null, $JSONMessage));
        return Sending::mapFromStdClass($result);
    }

    /**
     * @return array|null           List of scheduled sendings.
     * @throws OxiMailingException
     */
    public function getScheduled(): ?array
    {
        $sendings = $this->request("GET", "/scheduled");
        if (!is_null($sendings)) {
            $list = [];
            foreach ($sendings as $sending) {
                $list[] = ScheduledSending::mapFromStdClass($sending);
            }
            return $list;
        } else {
            return null;
        }
    }

    /**
     * @param int $sendingID        The ID of the sending you want to cancel.
     * @return bool
     * @throws OxiMailingException
     */
    public function deleteScheduled(int $sendingID): bool
    {
        $result = $this->request("DELETE", "/scheduled", ["sendingid" => $sendingID]);
        return ($result->Code == 200);
    }

}
