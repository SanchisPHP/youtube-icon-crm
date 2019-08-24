<?php


namespace Specialist\System\Controllers;


use Specialist\System\Config;
use Specialist\System\Connect;
use Specialist\System\Content;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

/**
 * Главный контроллер
 * Class Controller
 * @package Specialist\System\Controllers
 */
class Controller
{
    /**
     * Экземпляр одключения к базе данных
     * @var \Illuminate\Database\Capsule\Manager|null
     */
    protected $connect = null;

    public function __construct()
    {
        $this->connect = Connect::getInstance();
    }

    /**
     * Вывод в шаблон
     * @param string $file
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(string $file): void
    {
        $designFolder = $_SERVER["DOCUMENT_ROOT"]."/design/".Config::get()->db("design");
        $cache        = [];
        $loader       = new FilesystemLoader($designFolder);

        if(Config::get()->db("cache") == 1)
        {
            array_push($cache, $_SERVER["DOCUMENT_ROOT"]."/src/cache");
        }

        $twig = new Environment($loader, $cache);

        if(!is_file($designFolder."/".$file))
        {
            $file = "index.tpl";
        }

        echo $twig->render($file, Content::$content);
    }
}