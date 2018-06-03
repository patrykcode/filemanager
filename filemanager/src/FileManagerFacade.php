<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Patrykcode\FileManager\Src;

use Illuminate\Support\Facades\Facade;

/**
 * Description of FileManagerFacade
 *
 * @author Patryk
 */
class FileManagerFacade extends Facade {

    protected static function getFacadeAccessor() {
        return 'FileManager';
    }

}
