<?php

namespace Oxemis\OxiMailing\Objects;

class Recipient
{

    /** @var string Recipient Email */
    private string $email;

    /** @var null|array (Optional) Meta Data of the recipient (used for mapping)
     * Optional and additional information about the recipient.
     * These information can be used in the message.
     * For example, in your message you can use {{CustomerName}} if you have a meta data 'CustomerName'.
     * */
    private ?array $metaData = null;

    /** @var null|string (Optional) Recipient Name */
    private ?string $name = null;

    /** @var string|null (Optional) External ID of the recipient (your reference) */
    private ?string $token = null;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getMetaData(): ?array
    {
        return $this->metaData;
    }

    public function setMetaData(?array $metaData): void
    {
        $this->metaData = $metaData;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

}
