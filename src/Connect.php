<?php


namespace Specialist\System;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;


/**
 * Подключение к базе данных
 * Class Connect
 * @package Solar\Panels
 */
class Connect
{
    private static $instance = null;

    public static function getInstance()
    {
        if(is_null(self::$instance))
        {
            self::$instance = new Capsule;

            self::$instance->addConnection([
                'driver'    => Config::get()->env("DB_DRIVER"),
                'host'      => Config::get()->env("DB_HOST"),
                'database'  => Config::get()->env("DATABASE"),
                'username'  => Config::get()->env("DB_USER"),
                'password'  => Config::get()->env("DB_PASSWORD"),
                'charset'   => Config::get()->env("DB_ENCODING"),
                'collation' => Config::get()->env("DB_COLLATE"),
                'prefix'    => Config::get()->env("DB_PREFIX"),
                'port'      => Config::get()->env("DB_PORT")
            ]);

            self::$instance->setAsGlobal();
            self::$instance->bootEloquent();
        }

        return self::$instance;
    }

    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}
}
