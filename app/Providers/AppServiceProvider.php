<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $barangays_global = [
            'Baghari',
            'Bahuyan',
            'Beri',
            'Biga-a',
            'Binangbang',
            'Binangbang Centro',
            'Binanuan',
            'Cadiao',
            'Caladapan',
            'Capoyuan',
            'Cubay',
            'Embrangga-an',
            'Esparar',
            'Gua',
            'Idao',
            'Igpalge',
            'Igtunarum',
            'Integasan',
            'Ipil',
            'Jinalinan',
            'Lanas',
            'Langcaon',
            'Lisub',
            'Lombuyan',
            'Mablad',
            'Magtulis',
            'Marigne',
            'Mayabay',
            'Mayos',
            'Nalusdan',
            'Narirong',
            'Palma',
            'Poblacion',
            'San Antonio',
            'San Ramon',
            'Soligao',
            'Tabongtabong',
            'Tig-alaran',
            'Yapo'
        ];

        View::share('barangays_global', $barangays_global);
    }
}
