<?php

namespace Oxemis\OxiMailing\Components;

use Oxemis\OxiMailing\ApiClient;
use Oxemis\OxiMailing\ApiException;
use Oxemis\OxiMailing\Objects\User;

/**
 * Class for https://api.oximailing.com/doc/#/user
 */
class UserAPI extends Component
{

    public function __construct(ApiClient $apiClient)
    {
        parent::__construct($apiClient);
    }

    /**
     * Get informations about your account.
     *
     * @return User           Current user information (see https://api.oximailing.com/doc/#/user).
     * @throws ApiException
     */
    public function getUser(): object
    {
        $o = $this->request("GET", "/user");
        return User::mapFromStdClass($o);
    }

}
