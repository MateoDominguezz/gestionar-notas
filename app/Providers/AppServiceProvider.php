<?php

namespace App\Providers;

use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
// Esto le dice a Livewire: "Mis archivos están en esta subcarpeta"
    Livewire::setScriptRoute(function ($handle) {
        return Route::get('/gestion-notas/public/livewire/livewire.js', $handle);
    });

    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/gestion-notas/public/livewire/update', $handle);
    });
    }
}
