<?php
/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 11/10/17
 * Time: 10:19
 */

namespace WildTrombi\Controller;


class Controller
{
    protected $twig;

    public function __construct ()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../View');
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => false,
        ));
    }
}