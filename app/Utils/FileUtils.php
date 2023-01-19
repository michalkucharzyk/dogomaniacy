<?php

namespace App\Utils;

class FileUtils
{
    /**
     * @param $file
     * @return string
     */
    public static function createNameFile($file): string
    {
        return time().uniqid().'.'.$file->getClientOriginalExtension();
    }
}