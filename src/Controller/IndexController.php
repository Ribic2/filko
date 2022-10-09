<?php

namespace Filko\Controller;

use Filko\Render\View;

class IndexController extends Controller
{
    public function index(): void
    {
        View::render("index.phtml", ["hello" => "burek"]);
    }
}