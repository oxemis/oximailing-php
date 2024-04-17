<?php

namespace Oxemis\OxiMailing\Components;

use Oxemis\OxiMailing\OxiMailingClient;
use Oxemis\OxiMailing\OxiMailingException;

/**
 * Class for https://api.oximailing.com/doc/#/bounces
 */
class BouncesAPI extends Component
{

    public function __construct(OxiMailingClient $apiClient)
    {
        parent::__construct($apiClient);
    }

    /**
     * @param int $lastId       (Optional) Get the bounces added since this ID.
     * @return array<string>    List of bounced emails (the indexes in the array are the IDs of the bounced emails).
     * @throws OxiMailingException
     */
    public function getBouncedEmails(int $lastId = -1): ?array
    {
        $result = $this->request("GET", "/bounces", ["lastid" => $lastId]);
        if (!is_null($result)) {
            $list = [];
            foreach ($result->data as $data) {
                $list[$data->Id] = $data->Email;
            }
            return $list;
        } else {
            return null;
        }
    }

    /**
     * @param string $email         The email you want to add to your bouncelist.
     * @return bool                 OK means that the address has been added.
     * @throws OxiMailingException
     */
    public function addEmailToBouncelist(string $email): bool
    {
        $result = ($this->request("POST", "/bounces", ["email" => $email]));
        return ($result->Code == 200);
    }

    /**
     * @param string $email         The email you want to remove from the bouncelist.
     * @return bool                 OK means that the address has been removed.
     * @throws OxiMailingException
     */
    public function deleteEmailInBouncelist(string $email): bool
    {
        $result = ($this->request("DELETE", "/bounces", ["email" => $email]));
        return ($result->Code == 200);
    }

}
