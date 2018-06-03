<?php

namespace Patryk\Src;

class ContentInfo extends AbstractFileMenager {

    private $extensionFiles = array(
        'pdf' => 'file-pdf-o',
        'txt' => 'file-text-o',
        'default' => 'file-o',
        'currentDir' => 'folder-open-o',
        'dir' => 'folder-o',
        'png' => 'picture-o',
        'jpg' => 'picture-o',
        'gif' => 'picture-o',
        'odt' => 'file-word-o',
        'docx' => 'file-word-o',
        'doc' => 'file-word-o',
        'xls' => 'file-excel-o',
        'code' => 'file-code-o',
        'css' => 'css3',
        'html' => 'css3',
        'php' => 'file-code-o'
    );

    /**
     * rozmiar, path info, icona
     * @param type $path
     * @return type
     */
    public function info($path) {
        $path = str_replace(array("..", "../", "//"), array('', '', "/"), $path);
      
        if (realpath($path)) {
            $file = pathinfo($path);
            $size = filesize($path);
            if (is_dir($path)) {
                $icon = $this->extensionFiles['dir'];
                $size = $this->getSize($this->dirSize($path));
            } else {
                $icon = isset($file['extension']) && isset($this->extensionFiles[$file['extension']]) ? $this->extensionFiles[$file['extension']] : $this->extensionFiles['default'];
                $size = $this->getSize($size);
            }

            return compact('file', 'size', 'icon');
        }
        return false;
    }

    /**
     * konwertowanie rozmiarów do końcówek
     * pobrane z neta
     * @param type $size
     * @return type
     */
    private function getSize($size) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }

    /**
     * zliczanie wagi katalogu
     * @param type $dir
     * @return type
     */
    public function dirSize($dir) {
        $size = 0;
        foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
            $size += is_file($each) ? filesize($each) : $this->dirSize($each);
        }
        return $size;
    }

}
