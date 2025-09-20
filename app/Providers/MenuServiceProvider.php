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
      // Default role
      $role = 'guest';

      if (Auth::check()) {
        $role = Auth::user()->account_role;
      }
      switch ($role) {
        case 'admin':
          $menuFile = base_path('resources/menu/adminMenu.json');
          break;
        case 'user':
          $menuFile = base_path('resources/menu/organizationMenu.json');
          break;
        case 'faculty':
          $menuFile = base_path('resources/menu/facultyMenu.json');
          break;
        default:
          $menuFile = base_path('resources/menu/verticalMenu.json');
          break;
      }

      $menuJson = file_get_contents($menuFile);
      $menuData = json_decode($menuJson);

      foreach ($menuData->menu as &$menuItem) {
        if (isset($menuItem->slug) && $menuItem->slug === 'dashboard') {
          $menuItem->url = $role . '/dashboard';
        }
      }

      $view->with('menuData', [$menuData]);
    });
  }
}
