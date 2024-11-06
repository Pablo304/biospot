<?php

namespace App\Providers;

use App\Services\Status\Contracts\ListStatusServiceContract;
use App\Services\Status\ListStatusService;
use Illuminate\Support\ServiceProvider;

class ServiceLayerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->bootComplaint();
        $this->bootStatus();
    }

    /**
     * @return void
     */
    private function bootComplaint(): void
    {
        $this->app->bind(
            'App\Services\Complaint\Contracts\ListComplaintsServiceContract',
            'App\Services\Complaint\ListComplaintsService'
        );
    }

    /**
     * @return void
     */
    private function bootStatus(): void
    {
        $this->app->bind(ListStatusServiceContract::class, ListStatusService::class);
    }
}
