<?php


namespace Solar\Panels;

use Dotenv\Dotenv;
use Solar\Panels\Models\OptionsModel;

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
     * Выбор параметра из базы данных
     * @param string $option
     * @return string
     */
    public function db(string $option): string
    {
        $modelOBJ = OptionsModel::where("options_name", $option);

        if($modelOBJ->count() != 0)
        {
            return $modelOBJ->get()[0]->options_value;
        }
        exit("This parameter does not exist.");
    }

    /**
     * Создание параметра в базе данных
     * @param string $name
     * @param string $value
     * @return bool
     */
    public static function create(string $name, string $value): bool
    {
        if(OptionsModel::where("options_name", $name)->count() != 0)
        {
            return false;
        }

        $model                = new OptionsModel();
        $model->options_name  = $name;
        $model->options_value = $value;

        if($model->save())
        {
            return true;
        }

        return false;
    }

    /**
     * Обновление параметра в базе данных
     * @param string $name
     * @param string $value
     * @return bool
     */
    public static function update(string $name, string $value): bool
    {
        $modelOBJ = OptionsModel::where("options_name", $name);
        $model    = $modelOBJ->get();

        if($modelOBJ->count() == 0)
        {
            return false;
        }

        $model[0]->options_value = $value;

        if($model[0]->save())
        {
            return true;
        }
        return false;
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