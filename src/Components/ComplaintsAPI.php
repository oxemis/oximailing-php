<?php

namespace Oxemis\OxiMailing\Components;

use Oxemis\OxiMailing\ApiClient;
use Oxemis\OxiMailing\ApiException;
use Oxemis\OxiMailing\Objects\Complaint;

/**
 * Class for https://api.oximailing.com/doc/#/complaints
 */
class ComplaintsAPI extends Component
{

    public function __construct(ApiClient $apiClient)
    {
        parent::__construct($apiClient);
    }

    /**
     * @return array                List of complaints
     * @throws ApiException
     */
    public function getComplaints(): ?array
    {
        $result = $this->request("GET", "/complaints");
        if (!is_null($result)) {
            $list = [];
            foreach ($result as $complaint) {
                $list[] = Complaint::mapFromStdClass($complaint);
            }
            return $list;
        } else {
            return null;
        }
    }

}
