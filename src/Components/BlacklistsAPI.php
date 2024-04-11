<?php

namespace Oxemis\OxiMailing\Components;

use Oxemis\OxiMailing\ApiClient;
use Oxemis\OxiMailing\ApiException;

/**
 * Class for https://api.oximailing.com/doc/#/blacklists
 */
class BlacklistsAPI extends Component
{

    public function __construct(ApiClient $apiClient)
    {
        parent::__construct($apiClient);
    }

    /**
     * @param int $lastId               (Optional) Get the bounces added since this ID.
     * @param string $trackingAccountId (Optional) Specify the tracking account id (if not set the default account is used).
     * @return array<string>            List of blacklisted emails (the items index in the array are the IDs of the blacklisted emails).
     * @throws ApiException
     */
    public function getBlacklistedEmails(int $lastId = -1, string $trackingAccountId = ""): ?array
    {
        $result = $this->request("GET", "/blacklists", ["lastid" => $lastId, "trackingaccountid" => $trackingAccountId]);
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
     * @param string $email             The email of the sender you want to add.
     * @param string $trackingAccountId (Optional) Specify the tracking account id (if not set the default account is used).
     * @return bool                     true means that the address has been added.
     * @throws ApiException
     */
    public function addEmailToBlacklist(string $email, string $trackingAccountId = ""): bool
    {
        $result = ($this->request("POST", "/blacklists", ["email" => $email, "trackingaccountid" => $trackingAccountId]));
        return ($result->Code == 200);
    }

    /**
     * @param string $email             The email you want to remove.
     * @param string $trackingAccountId (Optional) Specify the tracking account id (if not set, the default account is used).
     * @return bool                     true means that the address has been removed.
     * @throws ApiException
     */
    public function deleteEmailInBlacklist(string $email, string $trackingAccountId = ""): bool
    {
        $result = ($this->request("DELETE", "/blacklists", ["email" => $email, "trackingaccountid" => $trackingAccountId]));
        return ($result->Code == 200);
    }

}
