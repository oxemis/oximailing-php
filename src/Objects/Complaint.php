<?php

namespace Oxemis\OxiMailing\Objects;

use DateTime;

/**
 * This class is used to help developpers.
 * It is mapped with the JSON returned by the API.
 */
class Complaint extends ApiObject
{

    private int $sendingId;
    private string $email;
    private string $fromName;
    private string $fromMail;
    private string $subject;
    private DateTime $messageDate;
    private DateTime $complaintDate;
    private string $complaintOperator;

    /**
     * Internal ID of the sending.
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
     * Email of the recipient.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    protected function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Sender name.
     *
     * @return string
     */
    public function getFromName(): string
    {
        return $this->fromName;
    }

    protected function setFromName(string $fromName): void
    {
        $this->fromName = $fromName;
    }

    /**
     * Sender email.
     *
     * @return string
     */
    public function getFromMail(): string
    {
        return $this->fromMail;
    }

    protected function setFromMail(string $fromMail): void
    {
        $this->fromMail = $fromMail;
    }

    /**
     * Subject of the message considered as spam.
     *
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
     * Date and time of the original message.
     *
     * @return DateTime
     */
    public function getMessageDate(): DateTime
    {
        return $this->messageDate;
    }

    protected function setMessageDate(string $messageDate): void
    {
        $this->messageDate = new DateTime($messageDate);
    }

    /**
     * Date and time of the complaint.
     *
     * @return DateTime
     */
    public function getComplaintDate(): DateTime
    {
        return $this->complaintDate;
    }

    protected function setComplaintDate(string $complaintDate): void
    {
        $this->complaintDate = new DateTime($complaintDate);
    }

    /**
     * Email operator who transmitted the spam complaint.
     *
     * @return string
     */
    public function getComplaintOperator(): string
    {
        return $this->complaintOperator;
    }

    protected function setComplaintOperator(string $complaintOperator): void
    {
        $this->complaintOperator = $complaintOperator;
    }

}
