<?php

namespace Iris\Storage;

use League\Flysystem\AdapterInterface;
use League\Flysystem\Config;

class Storage implements StorageInterface
{

    /**
     * @var AdapterInterface
     */
    protected $storageAdapter;

    /**
     * Storage constructor.
     * @param AdapterInterface $storageAdapter
     */
    public function __construct($storageAdapter)
    {
        $this->storageAdapter = $storageAdapter;
    }

    /**
     * @inheritdoc
     */
    public function getFileStream($sysName)
    {
        $file = $this->storageAdapter->readStream($sysName);
        if ($file['stream'] === false) {
            throw new StorageException(_('Запрашиваемый файл был удален'));
        }

        return $file['stream'];
    }

    /**
     * @inheritdoc
     */
    public function sendFile($sysName, $fileName)
    {
        // Get file extension
        $fileExt = null;
        $fileNameParts = explode('.', $fileName);
        if (count($fileNameParts) > 1) {
            $fileExt = $fileNameParts[count($fileNameParts) - 1];
        }

        $stream = $this->getFileStream($sysName);

        header("Content-Type: application/download");
        if ($fileExt) {
            header('Content-Type: application/' . $fileExt);
        }
        header('content-disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . fstat($stream)['size']);

        fpassthru($stream);
    }

    /**
     * @inheritdoc
     */
    public function storeFile($sysName, $fileName)
    {
        $config = new Config();
        $stream = fopen($fileName, 'r+');
        $this->storageAdapter->writeStream($sysName, $stream, $config);
    }

    /**
     * @inheritdoc
     */
    public function storeUploadedFiles($files)
    {
        $res = null;

        foreach ($files as $key => $file) {
            $sysName = create_guid();
            $this->storeFile($sysName, $file['tmp_name']);

            $res[UtfEncode($key)] = [
                'sysname' => $sysName,
                'name' => $file['name'],
            ];
        }

        return $res;
    }

    /**
     * @inheritdoc
     */
    public function deleteFile($sysName)
    {
        return $this->storageAdapter->delete($sysName);
    }

}
