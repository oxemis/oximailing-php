<?php

namespace Oxemis\OxiMailing\Components;

use Oxemis\OxiMailing\ApiClient;
use Oxemis\OxiMailing\ApiException;

/**
 * Class for https://api.oximailing.com/doc/#/senders
 */
class SendersAPI extends Component
{

    public function __construct(ApiClient $apiClient)
    {
        parent::__construct($apiClient);
    }

    /**
     * @return array                List of validated senders.
     * @throws ApiException
     */
    public function getValidatedSenders(): array
    {
        return ($this->request("GET", "/senders")->OK);
    }

    /**
     * @return array                List of pending senders.
     * @throws ApiException
     */
    public function getPendingSenders(): array
    {
        return ($this->request("GET", "/senders")->PENDING);
    }

    /**
     * @param string $email         The email of the sender you want to add.
     * @param string $language      Language of the validation email sent to validate.
     * @return bool                 OK means that the address has been added and is pending validation.
     * @throws ApiException
     */
    public function addSender(string $email, string $language = "en"): bool
    {
        $result = ($this->request("POST", "/senders", ["email" => $email, "lng" => $language]));
        return ($result->Code == 200);
    }

    /**
     * @param string $email         The email of the sender you want to remove.
     * @return bool
     * @throws ApiException
     */
    public function deleteSender(string $email): bool
    {
        $result = ($this->request("DELETE", "/senders", ["email" => $email]));
        return ($result->Code == 200);
    }

}
