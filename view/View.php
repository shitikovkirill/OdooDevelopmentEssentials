<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 30.03.16
 * Time: 21:11
 */

namespace Calendar\View;


class View
{
    private $twig;

    public function __construct(){
        $templates = __DIR__.'/templates';
        $cache = __DIR__.'/compilation_cache';
        \Twig_Autoloader::register();
        $loader = new \Twig_Loader_Filesystem($templates);
        $this->twig = new \Twig_Environment($loader, array(
            'debug' => true,
            'cache'       => $cache,
            'auto_reload' => true
        ));
        $this->twig->addExtension(new \Twig_Extension_Debug());
    }
    public function mainPage(){

        $res = $this->twig->render('main.twig',
            array(

            ));
        return $res;
    }

}