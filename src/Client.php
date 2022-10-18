<?php

namespace Filko;

use Exception;
use Filko\Enum\Ftp;
use Filko\Router\Paths;
use FTP\Connection;

class Client
{
    private static ?Client $instance = null;
    private ?Connection $connection = null;
    public array $items = [];

    /**
     * @return Client
     * @throws Exception
     */
    public static function getInstance(): Client
    {
        if (is_null(self::$instance)) {
            self::$instance = new Client();
        }
        self::$instance->connect();
        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function connect(): void
    {
        $ftp_server = Ftp::HOSTNAME;

        if (!ftp_connect($ftp_server)) {
            throw new Exception("Can't connect to server!");
        }

        $this->connection = ftp_connect($ftp_server);

        if (!ftp_login($this->connection, Ftp::USER, Ftp::PASSWORD)) {
            throw new Exception("Error connecting to FTP server");
        }

        ftp_pasv($this->connection, true);

    }

    /**
     * Get list of files
     */
    public function getFiles(string $folder = Ftp::DEFAULT_FOLDER): array|bool
    {
        $files = ftp_nlist($this->connection, $folder);

        if(count($files) == 0){
            $this->items[] = $folder;
            return -1;
        }

        foreach ($files as $file) {
            if ($this->isDir($file)) {
                $this->getFiles($file);
            } else {
                $this->items[] = $file;
            }
        }

        return $this->items;
    }


    protected function isDir(string $dir): bool
    {
        return count(explode(".", $dir)) === 1;
    }

    /**
     * Deletes file or directory
     * @param string $filename
     * @return bool
     */
    public function deleteFile(string $filename): bool
    {
        if (count(explode('.', $filename)) > 1) {
            return ftp_delete($this->connection, $filename);
        }
        return ftp_rmdir($this->connection, $filename);
    }

    /**
     * Closes FTP connection
     * @return bool
     */
    public function close(): bool
    {
        return ftp_close($this->connection);
    }

    /**
     * Executes given command
     * @return bool
     */
    public function uploadFile(): bool
    {
        $fileName = "test.txt";
        return ftp_put(
            $this->connection,
            sprintf("%s/%s", Ftp::DEFAULT_FOLDER, $fileName),
            sprintf("%s/%s", Ftp::DEFAULT_FOLDER, $fileName),
            FTP_ASCII
        );
    }

    /**
     * @return false|string
     */
    public function getCurrentDirectory(): bool|string
    {
        return ftp_pwd($this->connection);
    }

}