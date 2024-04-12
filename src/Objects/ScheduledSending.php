<?php

namespace Oxemis\OxiMailing\Objects;

use DateTime;

/**
 * This class is used to help developpers.
 * It is mapped with the JSON returned by the API.
 */
class ScheduledSending extends ApiObject
{

    private string $sendingId;
    private DateTime $scheduledDateTime;
    private int $nbMails;
    private string $campaign;
    private string $subject;
    private string $from;

    /**
     * Get the internal ID of the sending.
     *
     * @return string
     */
    public function getSendingId(): string
    {
        return $this->sendingId;
    }

    protected function setSendingId(string $sendingId): void
    {
        $this->sendingId = $sendingId;
    }

    /**
     * Get the scheduled date and time.
     *
     * @return DateTime
     */
    public function getScheduledDateTime(): DateTime
    {
        return $this->scheduledDateTime;
    }

    protected function setScheduledDateTime(string $scheduledDateTime): void
    {
        $this->scheduledDateTime = new DateTime($scheduledDateTime);
    }

    /**
     * Get the name of the campaign associated with the sending.
     *
     * @return string
     */
    public function getCampaign(): string
    {
        return $this->campaign;
    }

    protected function setCampaign(string $campaign): void
    {
        $this->campaign = $campaign;
    }

    /**
     * Get the number of emails associated with the sending.
     * @return int
     */
    public function getNbMails(): int
    {
        return $this->nbMails;
    }

    protected function setNbMails(int $nbMails): void
    {
        $this->nbMails = $nbMails;
    }

    /**
     * Get the subject of the message.
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    protected function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * Get the from mail of the message.
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    protected function setFrom(string $from): void
    {
        $this->from = $from;
    }

}
