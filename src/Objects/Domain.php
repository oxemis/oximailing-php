<?php

namespace Oxemis\OxiMailing\Objects;

use stdClass;

/**
 * This class is used to help developpers.
 * It is mapped with the JSON returned by the API.
 */
class Domain extends ApiObject
{

    private string $domain;
    private string $documentation;
    private bool $spfValid;
    private bool $dkimValid;
    private bool $trckValid;

    public function getDomain(): string
    {
        return $this->domain;
    }

    protected function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    public function getDocumentation(): string
    {
        return $this->documentation;
    }

    protected function setDocumentation(string $documentation): void
    {
        $this->documentation = $documentation;
    }

    public function isSpfValid(): bool
    {
        return $this->spfValid;
    }

    protected function setSpfValid(bool $spfValid): void
    {
        $this->spfValid = $spfValid;
    }

    public function isDkimValid(): bool
    {
        return $this->dkimValid;
    }

    protected function setDkimValid(bool $dkimValid): void
    {
        $this->dkimValid = $dkimValid;
    }

    public function isTrckValid(): bool
    {
        return $this->trckValid;
    }

    protected function setTrckValid(bool $trckValid): void
    {
        $this->trckValid = $trckValid;
    }

    /** Mapping can't be done automatically */
    protected function myMapFromStdClass(stdClass $object)
    {

        $this->setDkimValid($object->DKIM_valid);
        $this->setSpfValid($object->SPF_valid);
        $this->setTrckValid($object->TRCK_valid);

    }

}
