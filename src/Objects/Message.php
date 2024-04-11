<?php

namespace Oxemis\OxiMailing\Objects;

use DateTime;
use DateTimeInterface;
use Exception;
use JsonSerializable;

class Message implements JsonSerializable
{

    public const MESSAGE_FORMAT_HTML = "html";
    public const MESSAGE_FORMAT_TXT = "txt";

    /** @var array<Recipient> List of recipients */
    private array $recipients = array();
    /** @var bool Allows duplicates in recipients list */
    private bool $allowDuplicates = false;
    /** @var string Campaign name allows you to group sendings */
    private string $campaignName = "";
    /** @var DateTime|null The date and time you wish to send messages (if null: send immediately) */
    private ?DateTime $scheduledDateTime = null;
    /** @var bool Allows you to track events on the message */
    private bool $trackEmails = false;
    /** @var string Allows you to specify the tracking account you want to use (if not specified, the default account is used) */
    private string $trackingLogin = "";
    /** @var array<string> List of CCs e-mails */
    private array $cc = array();
    /** @var array<string> List of BCCs e-mails */
    private array $bcc = array();
    /** @var array<Attachment> Attachments of the message */
    private array $attachments = array();
    /** @var array<Header> Custom headers of the message */
    private array $customHeaders = array();
    /** @var string The format of the message. Can be MESSAGE_FORMAT_HTML ou MESSAGE_FORMAT_TEXT */
    private string $format = Message::MESSAGE_FORMAT_HTML;
    /** @var string The HTML Message content */
    private string $htmlMessage = "";
    /** @var array<InlineAttachment> Inline attachments of the message */
    private array $inlineAttachments = array();
    /** @var string Sender email address */
    private string $sender;
    /** @var string Sender name */
    private string $senderName;
    /** @var string Subject of the message */
    private string $subject = "";
    /** @var string The TEXT message content.
     *  If you set the HTML format and not the TEXT part, this one is automatically generated for you.
     */
    private string $txtMessage = "";

    /**
     * Get the list of attachments.
     *
     * @return Attachment[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * Set this list of "Attachement"s as message attachments.
     *
     * @param Attachment[] $attachments
     * @return $this
     */
    public function setAttachments(array $attachments): Message
    {
        $this->attachments = $attachments;
        return $this;
    }

    /**
     * Add this file as attachment.
     * You can specify a different file name and force the file type if you need.
     *
     * @param string $filePath
     * @param string|null $fileName
     * @param string|null $fileType
     * @return $this
     * @throws Exception
     */
    public function addAtachement(string $filePath, string $fileName = null, string $fileType = null): Message
    {
        $a = new Attachment($filePath, $fileName, $fileType);
        $this->attachments[] = $a;
        return $this;
    }

    /**
     * Get the list of custom headers
     *
     * @return Header[]
     */
    public function getCustomHeaders(): array
    {
        return $this->customHeaders;
    }

    /**
     * Set the list of "Header"s objects as custom headers.
     *
     * @param Header[] $customHeaders
     * @return $this
     */
    public function setCustomHeaders(array $customHeaders): Message
    {
        $this->customHeaders = $customHeaders;
        return $this;
    }

    /**
     * Add this custom header to the message.
     *
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function addCustomHeader(string $name, string $value): Message
    {
        $h = new Header();
        $h->setName($name);
        $h->setValue($value);
        $this->customHeaders[] = $h;
        return $this;
    }

    /**
     * Get the message format.
     *
     * @return string
     */
    public function getFormat(): string
    {
        return $this->format;
    }

    /**
     * Set message format.
     * Can be MESSAGE_FORMAT_HTML or MESSAGE_FORMAT_TEXT
     *
     * @param string $format
     * @return $this
     * @throws Exception
     */
    public function setFormat(string $format): Message
    {
        if (($format != self::MESSAGE_FORMAT_HTML) && ($format != self::MESSAGE_FORMAT_TXT)) {
            throw new Exception("Invalid format.");
        }
        $this->format = $format;
        return $this;
    }

    /**
     * Get the HTML content of the message.
     *
     * @return string
     */
    public function getHtmlMessage(): string
    {
        return $this->htmlMessage;
    }

    /**
     * Set the HTML content of the message.
     *
     * @param string $htmlMessage
     * @return $this
     */
    public function setHtmlMessage(string $htmlMessage): Message
    {
        $this->htmlMessage = $htmlMessage;
        return $this;
    }

    /**
     * Get the list of Inline Attachements.
     *
     * @return InlineAttachment[]
     */
    public function getInlineAttachments(): array
    {
        return $this->inlineAttachments;
    }

    /**
     * Set these "InlineAttachment"s objects as the message inline attachments.
     *
     * @param array $inlineAttachments
     * @return $this
     */
    public function setInlineAttachments(array $inlineAttachments): Message
    {
        $this->inlineAttachments = $inlineAttachments;
        return $this;
    }

    /**
     * Get the sender email address.
     *
     * @return string
     */
    public function getSender(): string
    {
        return $this->sender;
    }

    /**
     * Set the sender email address.
     * Remember to register this address on your account before using it.
     * You can also validate the address with the "SendersAPI" object.
     *
     * @param string $sender
     * @return $this
     */
    public function setSender(string $sender): Message
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * Get the sender name.
     *
     * @return string
     */
    public function getSenderName(): string
    {
        return $this->senderName;
    }

    /**
     * Set the sender name (usually displayed before the sender email).
     *
     * @param string $senderName
     * @return $this
     */
    public function setSenderName(string $senderName): Message
    {
        $this->senderName = $senderName;
        return $this;
    }

    /**
     * Get the message subject.
     *
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * Set message subject.
     *
     * @param string $subject
     * @return $this
     */
    public function setSubject(string $subject): Message
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get the text content of the message.
     *
     * @return string
     */
    public function getTxtMessage(): string
    {
        return $this->txtMessage;
    }

    /**
     * Set the text content of the message.
     * The text content is used when the format is text and as a fallback of HTML content when it can be
     * displayed (very rare). If this case (HTML format) if you don't set the text content, it will be
     * generated from HTML to improve delivrability.
     *
     * @param string $txtMessage
     * @return $this
     */
    public function setTxtMessage(string $txtMessage): Message
    {
        $this->txtMessage = $txtMessage;
        return $this;
    }

    /**
     * Get the list of recipients (as an array of "Recipient"s objects).
     *
     * @return Recipient[]
     */
    public function getRecipients(): array
    {
        return $this->recipients;
    }

    /**
     * Use this array of "Recipient"s objects as recipients.
     *
     * @param Recipient[] $recipients
     * @return $this
     */
    public function setRecipients(array $recipients): Message
    {
        $this->recipients = $recipients;
        return $this;
    }

    /**
     * Add this "Recipient" object as a recipent.
     *
     * @param Recipient $recipient
     * @return $this
     */
    public function addRecipient(Recipient $recipient): Message
    {
        $this->recipients[] = $recipient;
        return $this;
    }

    /**
     * Add this email as a recipient of the message.
     * "name" allows you to set the name (usually displayed next to the email address).
     *
     * @param string $email
     * @param string $name
     * @return $this
     */
    public function addRecipientEmail(string $email, string $name = ""): Message
    {
        $r = new Recipient();
        $r->setEmail($email);
        $r->setName($name);
        $this->recipients[] = $r;
        return $this;
    }

    /**
     * Are duplicates allowed in the message ?
     *
     * @return bool
     */
    public function isAllowDuplicates(): bool
    {
        return $this->allowDuplicates;
    }

    /**
     * Set it to true to allow duplicates
     *
     * @param bool $allowDuplicates
     * @return $this
     */
    public function setAllowDuplicates(bool $allowDuplicates): Message
    {
        $this->allowDuplicates = $allowDuplicates;
        return $this;
    }

    /**
     * Get the campaign name.
     *  Campaign name allows you to group sendings.
     *
     * @return string
     */
    public function getCampaignName(): string
    {
        return $this->campaignName;
    }

    /**
     * Set the campaign name.
     * Campaign name allows you to group sendings.
     *
     * @param string $campaignName
     * @return $this
     */
    public function setCampaignName(string $campaignName): Message
    {
        $this->campaignName = $campaignName;
        return $this;
    }

    /**
     * Get the scheduled date and time
     *
     * @return DateTime|null
     */
    public function getScheduledDateTime(): ?DateTime
    {
        return $this->scheduledDateTime;
    }

    /**
     * Set the date and time to send the message
     *
     * @param DateTime|null $scheduledDateTime
     * @return $this
     */
    public function setScheduledDateTime(?DateTime $scheduledDateTime): Message
    {
        $this->scheduledDateTime = $scheduledDateTime;
        return $this;
    }

    /**
     * Get the tracking account used to track emails
     *
     * @return string
     */
    public function getTrackingLogin(): string
    {
        return $this->trackingLogin;
    }

    /**
     * Set the tracking account used to track emails
     *
     * @param string $trackingLogin
     * @return $this
     */
    public function setTrackingLogin(string $trackingLogin): Message
    {
        $this->trackingLogin = $trackingLogin;
        return $this;
    }

    /**
     * Get the list of BCC
     *
     * @return string[]
     */
    public function getCc(): array
    {
        return $this->cc;
    }

    /**
     * @param string[] $cc Set these addresses as CC
     * @return $this
     */
    public function setCc(array $cc): Message
    {
        $this->cc = $cc;
        return $this;
    }

    /**
     * @param string $cc Add this mail to CC
     * @return $this
     */
    public function addCc(string $cc): Message
    {
        $this->cc[] = $cc;
        return $this;
    }

    /**
     * Get the list of BCC
     *
     * @return string[]
     */
    public function getBcc(): array
    {
        return $this->bcc;
    }

    /**
     * @param string[] $bcc Set a list of BCC
     * @return $this
     */
    public function setBcc(array $bcc): Message
    {
        $this->bcc = $bcc;
        return $this;
    }

    /**
     * @param string $bcc Set these addresses as BCC
     * @return $this
     */
    public function addBcc(string $bcc): Message
    {
        $this->bcc[] = $bcc;
        return $this;
    }

    /**
     * @return bool                 True if events on the message are tracked
     */
    public function isTrackEmails(): bool
    {
        return $this->trackEmails;
    }

    /**
     * @param bool $trackEmails If you want to track events on the message
     * @return $this
     */
    public function setTrackEmails(bool $trackEmails): Message
    {
        $this->trackEmails = $trackEmails;
        return $this;
    }

    /**
     * Function used to serialize object
     *
     * @return array
     */
    public function jsonSerialize(): array
    {

        // Créer le tableau avec les données
        $json = array();

        // Ajouter les options
        if (!empty($this->trackingLogin)) {
            $json["Options"]["TrackingAccountId"] = $this->trackingLogin;
        }
        if (!empty($this->campaignName)) {
            $json["Options"]["CampaignName"] = $this->campaignName;
        }
        $json["Options"]["TrackEmails"] = $this->trackEmails;
        $json["Options"]["AllowDuplicates"] = $this->allowDuplicates;

        // Scheduled Date
        if (!is_null($this->scheduledDateTime)) {
            $json["Options"]["ScheduledDateTime"] = $this->scheduledDateTime->format(DateTimeInterface::RFC3339);
        }

        // Les CC et BCC
        if (!empty($this->cc)) {
            $json["Options"]["CC"] = implode(";", $this->cc);
        }
        if (!empty($this->bcc)) {
            $json["Options"]["BCC"] = implode(";", $this->bcc);
        }

        // Ajouter le message
        $json["Message"] = [
            "From" => $this->getSender(),
            "FromName" => $this->getSenderName(),
            "Format" => $this->getFormat(),
            "HTML" => $this->getHtmlMessage(),
            "Text" => $this->getTxtMessage(),
            "Subject" => $this->getSubject(),
        ];

        // Headers
        $json["Message"]["Headers"] = array();
        foreach ($this->getCustomHeaders() as $header) {
            $json["Message"]["Headers"][] = ["Name" => $header->getName(), "Value" => $header->getValue()];
        }

        // Attachments
        $json["Message"]["Attachments"] = array();
        foreach ($this->getAttachments() as $attachment) {

            $b64 = base64_encode(file_get_contents($attachment->getFilePath()));
            $json["Message"]["Attachments"][] = [
                "ContentType" => $attachment->getFileType(),
                "FileName" => $attachment->getFileName(),
                "B64Content" => $b64
            ];

        }

        // Attachments
        $json["Message"]["InlineAttachments"] = array();
        foreach ($this->getInlineAttachments() as $attachment) {

            $b64 = base64_encode(file_get_contents($attachment->getFilePath()));
            $json["Message"]["InlineAttachments"][] = [
                "ContentType" => $attachment->getFileType(),
                "FileName" => $attachment->getFileName(),
                "CID" => $attachment->getCID(),
                "B64Content" => $b64
            ];

        }

        // Recipients
        $json["Recipients"] = array();
        foreach ($this->recipients as $recipient) {

            $r["Email"] = $recipient->getEmail();
            if (!empty($recipient->getName())) {
                $r["Name"] = $recipient->getName();
            }
            if (!empty($recipient->getMetaData())) $r["MetaData "] = $recipient->getMetaData();
            if (!empty($recipient->getToken())) $r["Token"] = $recipient->getToken();
            $json["Recipients"][] = $r;

        }

        return $json;

    }
}
