<?php

namespace Oxemis\OxiMailing\Objects;

use Exception;

class Attachment
{

    /** @var string the file name (myfile.txt) */
    private string $fileName;

    /** @var string the file path (used to get the content) */
    private string $filePath;

    /** @var string the MIME file type (text/plain) */
    private string $fileType;

    /**
     * @throws Exception
     */
    public function __construct(string $filePath, string $fileName = null, string $fileType = null)
    {
        if (file_exists($filePath)) {

            $this->filePath = $filePath;

            // Get the file name from path if not specified
            if (empty($fileName)) {
                $fileName = basename($filePath);
            }
            $this->fileName = $fileName;

            // Try to detect fileType if empty
            if (empty($fileType)) {
                $fileType = mime_content_type($filePath);
                if (!$fileType) {
                    throw new Exception("Can't detect file type. Please specify it.");
                }
            }

            $this->fileType = $fileType;

        } else {

            throw new Exception("File doesn't exist : $filePath");

        }
    }

    public function getFileName(): string
    {
        return $this->fileName;
    }

    public function getFilePath(): string
    {
        return $this->filePath;
    }

    public function getFileType(): string
    {
        return $this->fileType;
    }

}
