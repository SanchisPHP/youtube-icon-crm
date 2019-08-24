<?php


namespace Specialist\System;

/**
 * Объект контента приложения
 * Class Content
 * @package Specialist\System
 */
class Content
{
    /**
     * Контент
     * @var array
     */
    public static $content = [];

    /**
     * Добавить заголовок
     * @param string $title
     */
    public function addTitle(string $title): void
    {
        static::$content["title"] = $title;
    }

    /**
     * Добавить описание
     * @param string $desc
     */
    public function addDesc(string $desc): void
    {
        static::$content["description"] = $desc;
    }

    /**
     * Добавить ключевые слова
     * @param string $keywords
     */
    public function addKeywords(string $keywords): void
    {
        array_push(static::$content["keywords"], $keywords);
    }

    /**
     * Добавить контент
     * @param string $content
     */
    public function addContent(string $content): void
    {
        array_push(static::$content["content"], $content);
    }

    /**
     * Добавить свой ключь и значение
     * @param string $key
     * @param $value
     */
    public function addOther(string $key, $value): void
    {
        if(empty(static::$content[$key]))
        {
            static::$content["$key"] = $value;
        }
    }
}