<?php

namespace Iris\Storage;

interface StorageInterface
{

    /**
     * Send file to client with headers
     * @param string $sysName File name with relative path, example: '000e927c-3b48-f266-07f0-86288b2ead42'
     * @param string $fileName File name for humans
     * @return array
     */
    public function sendFile($sysName, $fileName);

    /**
     * @param array $files
     * @return File[]
     */
    public function storeUploadedFiles($files);

    /**
     * @param string $sysName
     * @return boolean
     */
    public function deleteFile($sysName);
}
