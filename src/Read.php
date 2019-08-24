<?php


namespace Specialist\System;


class Read
{
    /**
     * Чтение директории
     * @param string $folder
     * @return array
     */
    public static function folder(string $folder): array
    {
        $file = [];
        $dir  = [];

        $data = scandir($_SERVER["DOCUMENT_ROOT"].'/'.$folder);
        $data = array_splice($data, 2, count($data) - 2);

        foreach ($data as $value)
        {
            if(is_file($_SERVER["DOCUMENT_ROOT"].'/'.$folder."/".$value))
            {
                array_push($file, $value);
            }
            else{
                array_push($dir, $value);
            }
        }

        return ['folder' => $dir, 'file' => $file];
    }
}
