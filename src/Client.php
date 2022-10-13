<?php

namespace Filko;

use Exception;
use Filko\Enum\Ftp;
use FTP\Connection;

class Client
{
    private static ?Client $instance = null;
    private ?Connection $connection = null;

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
    public function connect()
    {
        $ftp_server = Ftp::HOSTNAME;
        $this->connection = ftp_connect($ftp_server);

        if (!ftp_login($this->connection, Ftp::USER, Ftp::PASSWORD)) {
            throw new Exception("Error connecting to FTP server");
        }

    }

    /**
     * Get list of files
     */
    public function getFiles(string $folder = Ftp::DEFAULT_FOLDER): array|bool
    {
        return ftp_nlist($this->connection, $folder);
    }

    /**
     * Deletes file or directory
     * @param string $filename
     * @return bool
     */
    public function deleteFile(string $filename): bool
    {
        if (count(explode('.', $filename)) > 1) {
            return ftp_rmdir($this->connection, $filename);
        }
        return ftp_delete($this->connection, $filename);
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
     * @param string $command
     * @return bool
     */
    public function uploadFile(string $command): bool
    {
        return ftp_put(
            $this->connection,
            Ftp::DEFAULT_FOLDER."/test",
            "C:/Users/vidbu/Documents/filko/src/test",
            FTP_ASCII
        );
    }

}