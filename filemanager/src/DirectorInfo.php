<?php

namespace Patryk\FileManager\Src;

class DirectorInfo extends AbstractFileMenager {

    public static function getUniqueName($file) {
        $info = pathinfo($file);
        $name = $info["basename"];
        if (is_dir($file)) {
            $name = self::notUniqueName($info['basename']);
        }
        if (is_file($file)) {
            $name = self::notUniqueName($info['basename'], '.' . $info['basename']);
        }
        return $name;
    }

    private static function notUniqueName($name, $extension = '') {
        $i = count(glob($name . '*'));
        $newName = $name . ($i ? '(' . ($i + 1) . ')' : '') . $extension;
        return $newName;
    }

    public static function prevDir($path) {
        return dirname($path);
    }

}
