<?php

namespace App\Providers;

use App\Models\Campaign;
use App\Models\Category;
use App\Models\Product;
use App\Models\Config;
use App\Observers\CampaignObserver;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('*',function($view){
            $categoriesIndex = Category::query()
                ->select('id', 'name', 'slug')
                ->whereNull('parent_id')
                ->with(['children' => function($q){
                    $q->select('id', 'name', 'slug', 'parent_id');
                }])
                ->get();
            $campaignIndex = Campaign::query()
                ->select('id', 'name', 'slug')
                ->where('type', 2)
                ->where('status', 1)
                ->take(3)
                ->get();
            $configIndex = Config::query()->first();
            $data = [
                'categoriesIndex' => $categoriesIndex,
                'campaignIndex' => $campaignIndex,
                'configIndex' => $configIndex,
            ];
            $view->with($data);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Category::observe(CategoryObserver::class);
        Product::observe(ProductObserver::class);
        Campaign::observe(CampaignObserver::class);
        Paginator::useBootstrap();
    }
}
