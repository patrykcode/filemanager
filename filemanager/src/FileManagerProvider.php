<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Patryk\FileManager\Src;
use Illuminate\Support\ServiceProvider;
/**
 * Description of FileManagerProvider
 *
 * @author Patryk
 */
class FileManagerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FileManager::class, function () {
            return new FileManager();
        });
        $this->app->alias(FileManager::class, 'FileManager');
    }
}