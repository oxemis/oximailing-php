<?php

namespace Oxemis\OxiMailing\Objects;

use stdClass;

/**
 * This class is used to help developpers.
 * It is mapped with the JSON returned by the API.
 */
class Sending extends ApiObject
{

    private int $sendingId;
    private array $filtered;
    private array $invalid;
    private array $OK;

    /**
     * Get the internal ID of the sending.
     *
     * @return int
     */
    public function getSendingId(): int
    {
        return $this->sendingId;
    }

    protected function setSendingId(int $sendingId): void
    {
        $this->sendingId = $sendingId;
    }

    /**
     * Get the filtered recipients.
     *
     * @return array
     */
    public function getFiltered(): array
    {
        return $this->filtered;
    }

    protected function setFiltered(array $filtered): void
    {
        $this->filtered = $filtered;
    }

    /**
     * Get the invalid recipients.
     *
     * @return array
     */
    public function getInvalid(): array
    {
        return $this->invalid;
    }

    protected function setInvalid(array $invalid): void
    {
        $this->invalid = $invalid;
    }

    /**
     * Get the valid recipients.
     *
     * @return array
     */
    public function getOK(): array
    {
        return $this->OK;
    }

    protected function setOK(array $ok): void
    {
        $this->OK = $ok;
    }

    /** Mapping can't be done automatically cause the JSON structure has a sub part "ResultDetails" */
    protected function myMapFromStdClass(stdClass $object)
    {

        $this->setFiltered($object->Blocked->Filtered);
        $this->setInvalid($object->Blocked->Invalid);

    }

}
