<?php

namespace Oxemis\OxiMailing\Objects;

/** Represents a Inline Attachment
 *  An inline attachment is like an attachment but it can be used directly in the message.
 *  For example, if you want to display an image in the HTML Message you can add it
 *  as an inline attachment and use it like this :
 *  <img src="cid:YOUR_CID"/>
 */
class InlineAttachment extends Attachment
{

    /** @var string The content-id used in the message, it MUST be unique for each inline attachment */
    private string $CID;

    public function __construct(string $filePath, string $fileName = null, string $fileType = null, string $CID = null)
    {
        if (empty($CID)) {
            $CID = uniqid();
        }
        $this->CID = $CID;
        parent::__construct($filePath, $fileName, $fileType);
    }

    public function getCID(): string
    {
        return $this->CID;
    }

}
