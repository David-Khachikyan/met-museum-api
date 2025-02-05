<?php

namespace App\Providers;

use App\Contracts\MetMuseum\MetMuseumServiceInterface;
use App\Services\ExternalResources\MetMuseum\MetMuseumService;
use App\Validators\CustomValidator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MetMuseumServiceInterface::class, MetMuseumService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $validator = app('validator');
        $validator->resolver(function ($translator, $data, $rules, $messages, $attributes) {
            return new CustomValidator($translator, $data, $rules, $messages, $attributes);
        });

        Http::macro('metMuseum', function () {
            return Http::baseUrl(config('metmuseum.api_base_url'));
        });
    }
}
