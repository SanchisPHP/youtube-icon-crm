<?php


namespace Solar\Panels;

use Dotenv\Dotenv;

/**
 * Выборка конфигурации ресурса
 * Class Config
 * @package Solar\Panels
 */
class Config
{
    /**
     * Загрузка env
     * Config constructor.
     */
    public function __construct()
    {
        $env = Dotenv::create($_SERVER["DOCUMENT_ROOT"]);
        $env->load();
    }

    /**
     * Выбор параметра файла конфигурации
     * @param string $param
     * @return array|false|string
     */
    public function env(string $param)
    {
        return getenv($param);
    }

    /**
     * Выбор параметра конфигурации
     * @return Config
     */
    public static function get(): Config
    {
        return new self();
    }
}