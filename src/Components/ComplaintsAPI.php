<?php

namespace Oxemis\OxiMailing\Components;

use Oxemis\OxiMailing\OxiMailingClient;
use Oxemis\OxiMailing\OxiMailingException;
use Oxemis\OxiMailing\Objects\Complaint;

/**
 * Class for https://api.oximailing.com/doc/#/complaints
 */
class ComplaintsAPI extends Component
{

    public function __construct(OxiMailingClient $apiClient)
    {
        parent::__construct($apiClient);
    }

    /**
     * @return array                List of complaints
     * @throws OxiMailingException
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
