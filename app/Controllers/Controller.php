<?php
namespace Kourtis\Controllers;

use Twig_Environment;
use Twig_Loader_Filesystem;

class Controller
{
    protected $twig;
    protected $post;
    protected $sector;
    protected $data;

    public function __construct($data=null)
    {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../Views/');
        $this->twig = new Twig_Environment($loader);

        $this->data = $data;
        $this->sector = $data[1];
        isset($data[2]) ? $this->post=$data[2] : $this->post=null;
    }
}