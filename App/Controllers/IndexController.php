<?php

namespace App\Controllers;

use Config\Controller\Action;

class IndexController extends Action
{

    protected $data = null;

    public function index()
    {
        $this->data = array('Fonte1', 'Mouse2', 'Teclado3');
        $this->render("Index/index.phtml", "defaultLayout1");
    }

    public function default()
    {
        $this->render("Error/index.phtml", "none");
    }
}
