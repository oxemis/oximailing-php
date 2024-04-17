<?php

namespace Oxemis\OxiMailing\Components;

use DateTime;
use DateTimeInterface;
use Oxemis\OxiMailing\OxiMailingClient;
use Oxemis\OxiMailing\OxiMailingException;
use Oxemis\OxiMailing\Objects\Event;

/**
 * Class for https://api.oximailing.com/doc/#/tracking
 */
class TrackingAPI extends Component
{

    public const EVENT_TYPE_ALL = "all";
    public const EVENT_TYPE_CLICK = "click";
    public const EVENT_TYPE_OPEN = "open";
    public const EVENT_TYPE_UNSUB = "unsub";
    public const EVENT_TYPE_SOFT_BOUNCE = "softbounce";
    public const EVENT_TYPE_HARD_BOUNCE = "hardbounce";
    public const EVENT_TYPE_SENT = "sent";
    public const EVENT_TYPE_COMPLAINT = "complaint";

    public function __construct(OxiMailingClient $apiClient)
    {
        parent::__construct($apiClient);
    }

    /**
     * Get recorded events on your messages sent with tracking.
     * Important information about dates :
     * If you don't specify any dates, the maximum event date is set to NOW()
     * If you set only the maximum event date, the minimum event date is set to 'end - 7 days'
     * If you set only the minimum event date, the maximum event date is set to 'start + 7 days'
     * The queried period can't exceed 7 days (max - min <= 7 days)
     * So, if you don't set any date, you'll get all the events recorded in the past 7 days from now.
     *
     * @param string $type              the type of events you want to get (EVENT_TYPE_*)
     * @param string|null $email        (Optional) filter on this email
     * @param DateTime|null $start      (Optional) start date
     * @param DateTime|null $end        (Optional) end date
     * @param int|null $sendingId       (Optional) filter on this sendingid
     * @param string $trackingAccountId (Optional) specify the tracking account you want to use (if not specified, the default account is used)
     * @return array<Event>|null        See : https://api.oximailing.com/doc/#/tracking/get_events
     * @throws OxiMailingException
     */
    public function getEvents(
        string $type,
        string $email = null,
        DateTime $start = null,
        DateTime $end = null,
        int $sendingId = null,
        string $trackingAccountId = ""
    ): ?array {

        $params["type"] = $type;
        if (!empty($email)) {
            $params["email"] = $email;
        }
        if (!empty($start)) {
            $params["start"] = $start->format(DateTimeInterface::RFC3339);
        }
        if (!empty($end)) {
            $params["end"] = $end->format(DateTimeInterface::RFC3339);
        }
        if (!empty($sendingId)) {
            $params["sendingid"] = $sendingId;
        }
        if (!empty($trackingAccountId)) {
            $params["trackingaccountid"] = $trackingAccountId;
        }

        $result = $this->request("GET", "/events", $params);
        if (!is_null($result)) {
            $events = $result->data;
            $list = [];
            foreach ($events as $event) {
                $list[] = Event::mapFromStdClass($event);
            }
            return $list;
        } else {
            return null;
        }

    }

    /**
     * This path allows you to retrieve the tracking report URL for a specified SendingID.
     *
     * @param int $sendingId
     * @param string $lng
     * @return string
     * @throws OxiMailingException
     */
    public function getReportURL(int $sendingId, string $lng = "en"): string
    {

        $result = $this->request("GET", "/report", ["sendingid" => $sendingId, "lng" => $lng]);
        return $result[0]->ReportUrl;

    }

    /**
     * Get statistics (nb opens, nb clicks...) for one SendingID.
     *
     * @param int $sendingId
     * @return object|mixed|null
     * @throws OxiMailingException
     */
    public function getStatisticsForSendingId(int $sendingId): object
    {

        return ($this->request("GET", "/statistics", ["sendingid" => $sendingId]));

    }

}
