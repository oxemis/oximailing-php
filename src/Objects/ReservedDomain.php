<?php

namespace Oxemis\OxiMailing\Objects;

use DateTime;

/**
 * This class is used to help developpers.
 * It is mapped with the JSON returned by the API.
 */
class ReservedDomain extends ApiObject
{

    private string $domain;
    private string $emailRedirection;
    private string $webRedirection;
    private DateTime $createdAt;
    private DateTime $expirationDate;
    private bool $ready;

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): void
    {
        $this->domain = $domain;
    }

    public function getEmailRedirection(): string
    {
        return $this->emailRedirection;
    }

    public function setEmailRedirection(string $emailRedirection): void
    {
        $this->emailRedirection = $emailRedirection;
    }

    public function getWebRedirection(): string
    {
        return $this->webRedirection;
    }

    public function setWebRedirection(string $webRedirection): void
    {
        $this->webRedirection = $webRedirection;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = new DateTime($createdAt);
    }

    public function getExpirationDate(): DateTime
    {
        return $this->expirationDate;
    }

    public function setExpirationDate(string $expirationDate): void
    {
        $this->expirationDate = new DateTime($expirationDate);
    }

    public function isReady(): bool
    {
        return $this->ready;
    }

    public function setReady(bool $ready): void
    {
        $this->ready = $ready;
    }

}
