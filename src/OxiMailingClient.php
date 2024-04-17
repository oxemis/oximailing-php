<?php

namespace Oxemis\OxiMailing;

use Oxemis\OxiMailing\Components\BlacklistsAPI;
use Oxemis\OxiMailing\Components\BouncesAPI;
use Oxemis\OxiMailing\Components\ComplaintsAPI;
use Oxemis\OxiMailing\Components\DomainsAPI;
use Oxemis\OxiMailing\Components\SendAPI;
use Oxemis\OxiMailing\Components\SendersAPI;
use Oxemis\OxiMailing\Components\TrackingAPI;
use Oxemis\OxiMailing\Components\UserAPI;

/**
 * API Client for OxiMailing
 */
class OxiMailingClient
{

    private string $auth;
    private string $baseURL;
    private string $userAgent;

    public function __construct(string $apiLogin, string $apiPassword) {

        $this->auth = base64_encode($apiLogin . ":" . $apiPassword);
        $this->userAgent = Configuration::USER_AGENT . PHP_VERSION . '/' . Configuration::WRAPPER_VERSION;
        $this->baseURL = Configuration::MAIN_URL;
        $this->userAPI = new UserAPI($this);
        $this->sendersAPI = new SendersAPI($this);
        $this->domainsAPI = new DomainsAPI($this);
        $this->bouncesAPI = new BouncesAPI($this);
        $this->blacklistsAPI = new BlacklistsAPI($this);
        $this->complaintsAPI = new ComplaintsAPI($this);
        $this->sendAPI = new SendAPI($this);
        $this->trackingAPI = new TrackingAPI($this);

    }

    public function getAuth(): string
    {
        return $this->auth;
    }

    public function getBaseURL(): string
    {
        return $this->baseURL;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

}
