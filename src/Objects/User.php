<?php

namespace Oxemis\OxiMailing\Objects;

use DateTime;
use stdClass;

/**
 * This class is used to help developpers.
 * It is mapped with the JSON returned by the API.
 */
class User extends ApiObject
{

    private string $companyName;
    private int $credits = 0;
    private ?DateTime $creditsValidBefore = null;
    private int $subcription = 0;
    private ?DateTime $subscriptionValidBefore = null;
    private int $subcriptionUsedThisMonth = 0;
    private ?int $subscriptionRenewDay = null;
    private ?string $dedicatedIp = null;
    private ?string $dedicatedDomain = null;
    private ?bool $smtpAccessActive = false;
    private ?string $smtpAccessServer = null;
    private array $trackingAccounts = [];

    /**
     * Name of the company or the organization.
     *
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    protected function setCompanyName(string $companyName): void
    {
        $this->companyName = $companyName;
    }

    /**
     * Number of remaining on demand credits.
     *
     * @return int
     */
    public function getCredits(): int
    {
        return $this->credits;
    }

    protected function setCredits(int $credits): void
    {
        $this->credits = $credits;
    }

    /**
     * Expiration date of the remaining credit.
     *
     * @return DateTime|null
     */
    public function getCreditsValidBefore(): ?DateTime
    {
        return $this->creditsValidBefore;
    }

    protected function setCreditsValidBefore(string $creditsValidBefore): void
    {
        $this->creditsValidBefore = new DateTime($creditsValidBefore);
    }

    /**
     * Number of credits in the active subscription (if any).
     *
     * @return int
     */
    public function getSubcription(): int
    {
        return $this->subcription;
    }

    protected function setSubcription(int $subcription): void
    {
        $this->subcription = $subcription;
    }

    /**
     * Subscription end date (if any).
     *
     * @return DateTime|null
     */
    public function getSubscriptionValidBefore(): ?DateTime
    {
        return $this->subscriptionValidBefore;
    }

    protected function setSubscriptionValidBefore(string $subscriptionValidBefore): void
    {
        $this->subscriptionValidBefore = new DateTime($subscriptionValidBefore);
    }

    /**
     * Number of credits used this month.
     *
     * @return int
     */
    public function getSubcriptionUsedThisMonth(): int
    {
        return $this->subcriptionUsedThisMonth;
    }

    protected function setSubcriptionUsedThisMonth(int $subcriptionUsedThisMonth): void
    {
        $this->subcriptionUsedThisMonth = $subcriptionUsedThisMonth;
    }

    /**
     * Day of the month that generates the credit reset (this is the day on which your available credit is reset).
     *
     * @return int|null
     */
    public function getSubscriptionRenewDay(): ?int
    {
        return $this->subscriptionRenewDay;
    }

    protected function setSubscriptionRenewDay(int $subscriptionRenewDay): void
    {
        $this->subscriptionRenewDay = $subscriptionRenewDay;
    }

    /**
     * Dedicated IP Address (if you have a premium offer).
     *
     * @return string|null
     */
    public function getDedicatedIp(): ?string
    {
        return $this->dedicatedIp;
    }

    protected function setDedicatedIp(string $dedicatedIp): void
    {
        $this->dedicatedIp = $dedicatedIp;
    }

    /**
     * Dedicated domain address (if you have a premium offer + dedicated server).
     *
     * @return string|null
     */
    public function getDedicatedDomain(): ?string
    {
        return $this->dedicatedDomain;
    }

    protected function setDedicatedDomain(string $dedicatedDomain): void
    {
        $this->dedicatedDomain = $dedicatedDomain;
    }

    /**
     * True if SMTP access is activated.
     *
     * @return bool|null
     */
    public function getSmtpAccessActive(): ?bool
    {
        return $this->smtpAccessActive;
    }

    protected function setSmtpAccessActive(?bool $smtpAccessActive): void
    {
        $this->smtpAccessActive = $smtpAccessActive;
    }

    /**
     * SMTP server to use in order to send emails (if SmtpAccessActive = true)
     *
     * @return string|null
     */
    public function getSmtpAccessServer(): ?string
    {
        return $this->smtpAccessServer;
    }

    protected function setSmtpAccessServer(?string $smtpAccessServer): void
    {
        $this->smtpAccessServer = $smtpAccessServer;
    }

    /**
     * List of tracking accounts. Each item as "ID" (the tracking account ID)
     * and "Caption" (the internal name of the account).
     *
     * @return array
     */
    public function getTrackingAccounts(): array
    {
        return $this->trackingAccounts;
    }

    protected function setTrackingAccounts(array $trackingAccounts): void
    {
        $this->trackingAccounts = $trackingAccounts;
    }

    /** Mapping can't be done automatically cause the JSON structure has a sub part "ResultDetails" */
    protected function myMapFromStdClass(stdClass $object)
    {

        if (property_exists($object, "SMTPAccess")) {
            $this->setSmtpAccessActive($object->SMTPAccess->Active);
            if ($object->SMTPAccess->Active) {
                $this->setSmtpAccessServer($object->SMTPAccess->Server);
            }
        }

        $list = [];
        foreach ($object->TrackingAccounts as $trackingAccount) {
            $list[] = ["ID" => $trackingAccount->ID, "Caption" => $trackingAccount->Caption];
        }
        $this->setTrackingAccounts($list);

    }

}
