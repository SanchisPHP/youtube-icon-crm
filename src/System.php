<?php


namespace Specialist\System;

use Specialist\System\Plugins\test\Main;

/**
 * Автозагрузчик модулей и плагинов
 * Class System
 * @package Specialist\System
 */
class System
{
    /**
     * Создание экземпляра загрузки
     * @return System
     */
    public static function load(): self
    {
        return new self();
    }

    /**
     * Автозагрузка плагинов
     */
    public function plugins(): void
    {
        $read = Read::folder("src/Plugins");

        foreach ($read["folder"] as $value)
        {
            $class = "Specialist\\System\\Plugins\\".$value."\\Main";
            $plugIn = new $class();
            $plugIn->init();
        }
    }

    /**
     * Автозагрузка модулей
     */
    public function modules(): void
    {
        $read = Read::folder("src/Modules");

        foreach ($read["folder"] as $value)
        {
            $class = "Specialist\\System\\Modules\\".$value."\\Main";
            new $class();
        }
    }
}