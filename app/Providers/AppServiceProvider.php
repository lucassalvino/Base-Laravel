<?php

namespace App\Providers;

use App\Models\CMS\SEO;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(env('FORCE_HTTPS',false)) {
            URL::forceScheme('https');
        }

        $seo = [];
        try{
            $seo = SEO::ObtemSeo();
        }catch(Exception $erro){
            //para novos ambientes o banco de dados não existe
        }
        View::share("data_seo", $seo);

        $mainPath = database_path('migrations');
        $directories = glob($mainPath . '/*' , GLOB_ONLYDIR);
        $paths = array_merge([$mainPath], $directories);
        $this->loadMigrationsFrom($paths);
    }
}
