<?php

namespace Oxemis\OxiMailing\Components;

use Oxemis\OxiMailing\ApiClient;
use Oxemis\OxiMailing\ApiException;
use Oxemis\OxiMailing\Objects\Domain;
use Oxemis\Oximailing\Objects\ReservedDomain;

/**
 * Class for https://api.oximailing.com/doc/#/domains
 */
class DomainsAPI extends Component
{

    public function __construct(ApiClient $apiClient)
    {
        parent::__construct($apiClient);
    }

    /**
     * @return null|array<Domain>   List of domains.
     * @throws ApiException
     */
    public function getDomains(): ?array
    {
        $result = $this->request("GET", "/domains");
        if (!is_null($result)) {
            $list = [];
            foreach ($result as $domain) {
                $list[] = Domain::mapFromStdClass($domain);
            }
            return $list;
        } else {
            return null;
        }
    }

    /**
     * @param string $domain        The domain for the lookup.
     * @return object|null          Domain object (see doc for properties).
     * @throws ApiException
     */
    public function getDomain(string $domain): ?object
    {
        $result = $this->request("GET", "/domains", ["domain" => $domain]);
        if (!is_null($result)) {
            return Domain::mapFromStdClass($result);
        } else {
            return null;
        }
    }

    /**
     * @param string $domain        The domain to add on the account.
     * @return bool                 True if OK.
     * @throws ApiException
     */
    public function addDomain(string $domain): bool
    {
        $result = $this->request("POST", "/domains", ["domain" => $domain]);
        return ($result->Code == 200);
    }

    /**
     * @param string $domain        The domain you want to delete.
     * @return bool                 True if OK.
     * @throws ApiException
     */
    public function deleteDomain(string $domain): bool
    {
        $result = ($this->request("DELETE", "/domains", ["domain" => $domain]));
        return ($result->Code == 200);
    }

    /**
     * @param string $domain        The domain you want to refresh.
     * @return bool                 True if OK.
     * @throws ApiException
     */
    public function refreshDomain(string $domain): bool
    {
        $result = ($this->request("GET", "/domains/refresh", ["domain" => $domain]));
        return ($result->Code == 200);
    }

    /**
     * @return null|array<ReservedDomain>                The list of reserved domains.
     * @throws ApiException
     */
    public function getReservedDomains(): ?array
    {
        $result = $this->request("GET", "/domains/reserved");
        if (!is_null($result)) {
            $list = [];
            foreach ($result as $domain) {
                $list[] = ReservedDomain::mapFromStdClass($domain);
            }
            return $list;
        } else {
            return null;
        }
    }

}
