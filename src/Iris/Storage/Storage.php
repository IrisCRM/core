<?php

namespace Iris\Storage;

use Iris\Iris;
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
    public function sendFile($sysName, $fileName)
    {
        // Get file extension
        $fileExt = null;
        $fileNameParts = explode('.', $fileName);
        if (count($fileNameParts) > 1) {
            $fileExt = $fileNameParts[count($fileNameParts) - 1];
        }

        $file = $this->storageAdapter->readStream($sysName);
        $realFilePath = $this->storageAdapter->applyPathPrefix($file['path']);
        if (!file_exists($realFilePath)) {
            // Support for legacy storage in single folder
            $realFilePath = Iris::$app->getRootDir() . 'files/' . $file['path'];
            if (!file_exists($realFilePath)) {
                throw new StorageException(_('Запрашиваемый файл был удален'));
            }
        }

        header("Content-Type: application/download");
        if ($fileExt) {
            header('Content-Type: application/' . $fileExt);
        }
        header('content-disposition: attachment; filename="' . $fileName . '"');
        header('Content-Length: ' . filesize($realFilePath));

        fpassthru($file['stream']);
    }

    /**
     * @inheritdoc
     */
    public function storeUploadedFiles($files)
    {
        $res = null;
        $config = new Config();

        foreach ($_FILES as $key => $file) {
            $sysName = create_guid();
            $stream = fopen($file['tmp_name'], 'r+');
            $this->storageAdapter->writeStream($sysName, $stream, $config);

            $res[UtfEncode($key)] = [
                'sysname' => $sysName,
                'name' => $file['name'],
            ];
        }

        return $res;
    }
}
