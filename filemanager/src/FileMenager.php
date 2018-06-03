<?php

namespace Patryk\FileManagerProvider\Src;

use Illuminate\Http\Request;

class FileMenager extends AbstractFileMenager {

    private static $rootPath = null;
    public static $currentDir = '';
    public static $big = '';

    public function __construct() {
        self::$rootPath = config('filemanager.disks.userfiles');
    }

    /**
     * załadowanie wisoku testowego
     * @return type
     */
    public function view() {
        return view('admin.upload');
    }

    /**
     * TODO upload duzych plików nie działa
     * upload plików poki co nie działa za duzych plików 30mb nie wiecej
     * @param Request $request
     */
    public function upload(Request $request) {
        $data = $request->all();
        $dir = $request->has('path') ? $request->input('path') : '/';
        if ($request->hasFile('file')) {
            $name = $request->file->getClientOriginalName();
            $path = self::$rootPath . $dir . $name;
            $name = DirectorInfo::getInstance()->getUniqueName($path);
            $request->file->move(self::$rootPath . $dir, $name);
        }
    }

    /**
     * pobieranie zawartości katalogów wraz z informacjami o plikach 
     * icon, size
     * @param type $path
     * @return type
     */
    public static function getContent($path) {
        $files = scandir($path);
        $files = array_filter($files, function($file) {
            if (!in_array($file, ['.', '..'])) {
                return $file;
            }
        });
        return $files;
    }

    public static function contentInfo($path) {
        $path = str_replace(array("..", "../", "//"), array('', '', "/"), $path);
        if (is_dir($path)) {
            $all = self::getContent($path);
            $files = array_map(function($file)use($path) {
                return ContentInfo::getInstance()->info($path . $file);
            }, $all);

            return $files;
        } else {
            return [];
        }
    }

}
