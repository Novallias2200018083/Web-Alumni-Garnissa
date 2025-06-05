<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';  // Menetapkan konstanta HOME sebagai /home (bisa diubah sesuai kebutuhan)

    /**
     * Method untuk menentukan halaman utama berdasarkan peran pengguna.
     *
     * @return string
     */
    public static function home()
    {
        // Cek apakah pengguna sudah login
        if (auth()->check()) {
            // Jika peran pengguna admin, arahkan ke dashboard admin
            return auth()->user()->role === 'admin' ? '/dashboard/admin' : '/dashboard/alumni';
        }
        // Jika belum login, arahkan ke halaman beranda umum
        return '/';
    }

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
