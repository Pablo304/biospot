<?php

namespace App\Providers;

use App\Services\Complaint\Contracts\DiscardComplaintServiceContract;
use App\Services\Complaint\DiscardComplaintService;
use App\Services\Plague\Contracts\ListPlagueStatusServiceContract;
use App\Services\Plague\Contracts\ListPlagueTypesServiceContract;
use App\Services\Plague\ListPlagueStatusService;
use App\Services\Plague\ListPlagueTypesService;
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
        $this->bootStatus();
        $this->bootPlague();
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
        $this->app->bind(DiscardComplaintServiceContract::class, DiscardComplaintService::class);
        $this->app->bind(
            'App\Services\Auth\Contract\LoginServiceContract',
            'App\Services\Auth\LoginService'
        );
    }

    /**
     * @return void
     */
    private function bootStatus(): void
    {
        $this->app->bind(ListStatusServiceContract::class, ListStatusService::class);
        $this->app->bind(ListPlagueStatusServiceContract::class, ListPlagueStatusService::class);
    }

    /**
     * @return void
     */
    private function bootPlague(): void
    {
        $this->app->bind(ListPlagueTypesServiceContract::class, ListPlagueTypesService::class);
    }
}
