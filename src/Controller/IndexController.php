<?php

namespace Filko\Controller;

use Exception;
use Filko\Client;
use Filko\Render\View;

class IndexController extends Controller
{
    /**
     * @throws Exception
     */
    public function index(): void
    {
        $client = Client::getInstance();
        View::render("index.phtml", ["data" => $client->getFiles()]);
    }

    public function about()
    {
        $name = $this->getPayload('name');
        View::JSON([
            "hello" => $name
        ]);
    }

    public function xd()
    {

        View::JSON([
            "files" => Client::getInstance()->getFiles()
        ]);
    }

    /**
     * @throws Exception
     */
    public function delete()
    {
        $fileName = $this->getPayload('filename');

        $client = Client::getInstance();

        if (!$client->deleteFile($fileName)) {
            throw new Exception("Error deleting the file!");
        }

        View::JSON([
            "reponse" => "File was deleted!"
        ]);
    }

    public function execute()
    {
        $command = $this->getPayload('command');

        $client = Client::getInstance();


        View::JSON([
            "reponse" => $client->uploadFile($command)
        ]);
    }
}