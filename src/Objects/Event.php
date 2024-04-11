<?php

namespace Oxemis\OxiMailing\Objects;

use DateTime;
use stdClass;

/**
 * This class is used to help developpers.
 * It is mapped with the JSON returned by the API.
 */
class Event extends ApiObject
{

    public const EVENT_TYPE_CLICK = "click";
    public const EVENT_TYPE_OPEN = "open";
    public const EVENT_TYPE_UNSUB = "unsub";
    public const EVENT_TYPE_SOFT_BOUNCE = "softbounce";
    public const EVENT_TYPE_HARD_BOUNCE = "hardbounce";
    public const EVENT_TYPE_SENT = "sent";
    public const EVENT_TYPE_COMPLAINT = "complaint";

    private int $sendingId;
    private DateTime $eventDate;
    private string $eventEmail;
    private string $eventType;
    private array $eventInfo;

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
     * Event date and time.
     *
     * @return DateTime
     */
    public function getEventDate(): DateTime
    {
        return $this->eventDate;
    }

    protected function setEventDate(string $eventDate): void
    {
        $this->eventDate = new DateTime($eventDate);
    }

    /**
     * Email at the origin of the event.
     *
     * @return string
     */
    public function getEventEmail(): string
    {
        return $this->eventEmail;
    }

    protected function setEventEmail(string $eventEmail): void
    {
        $this->eventEmail = $eventEmail;
    }

    /**
     * Event type (sent is only available on selected customer account, please contact support for more information).
     *
     * @return string
     */
    public function getEventType(): string
    {
        return $this->eventType;
    }

    protected function setEventType(string $eventType): void
    {
        $this->eventType = $eventType;
    }

    /**
     * Additional information about the event. You will find for example the URL clicked for a 'click' event.
     *
     * @return array
     */
    public function getEventInfo(): array
    {
        return $this->eventInfo;
    }

    protected function setEventInfo(array $eventInfo): void
    {
        $this->eventInfo = $eventInfo;
    }

    /** Mapping can't be done automatically cause the JSON structure has a sub part "ResultDetails" */
    protected function myMapFromStdClass(stdClass $object)
    {
        $this->setEventInfo((array)$object->EventInfos);
    }

}
