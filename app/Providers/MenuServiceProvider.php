<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  public function register(): void {}

  public function boot(): void
  {
    View::composer('*', function ($view) {
      $verticalMenuJson = file_get_contents(base_path('resources/menu/verticalMenu.json'));
      $verticalMenuData = json_decode($verticalMenuJson);

      // Default role
      $role = 'guest';

      if (Auth::check()) {
        $role = Auth::user()->account_role; // now it should detect "admin"
      }

      // Adjust dashboard link
      foreach ($verticalMenuData->menu as &$menuItem) {
        if (isset($menuItem->slug) && $menuItem->slug === 'dashboard') {
          $menuItem->url = $role . '/dashboard';
        }
      }

      $view->with('menuData', [$verticalMenuData]);
    });
  }
}
