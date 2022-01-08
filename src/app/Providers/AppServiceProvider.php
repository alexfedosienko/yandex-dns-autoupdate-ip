<?php

namespace App\Providers;

use App\Services\MyIpService;
use App\Services\YandexDnsService;
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
    $this->app->bind(YandexDnsService::class, function () {
      return new YandexDnsService();
    });
    $this->app->bind(MyIpService::class, function () {
      return new MyIpService();
    });
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
