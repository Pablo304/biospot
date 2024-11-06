<?php

namespace App\Providers;

use App\Services\Address\Contracts\CreateAddressServiceContract;
use App\Services\Address\CreateAddressService;
use App\Services\Complaint\ConfirmComplaintService;
use App\Services\Complaint\Contracts\ConfirmComplaintServiceContract;
use App\Services\Complaint\Contracts\DiscardComplaintServiceContract;
use App\Services\Complaint\Contracts\StoreCompliantServiceContract;
use App\Services\Complaint\DiscardComplaintService;
use App\Services\Plague\Contracts\CreatePlagueServiceContract;
use App\Services\Complaint\StoreCompliantService;
use App\Services\Plague\Contracts\ListPlagueServiceContract;
use App\Services\Plague\Contracts\ListPlagueStatusServiceContract;
use App\Services\Plague\Contracts\ListPlagueTypesServiceContract;
use App\Services\Plague\Contracts\ResolvePlagueServiceContract;
use App\Services\Plague\CreatePlagueService;
use App\Services\Plague\ListPlagueService;
use App\Services\Plague\ListPlagueStatusService;
use App\Services\Plague\ListPlagueTypesService;
use App\Services\Plague\ResolvePlagueService;
use App\Services\ProcessInfo\Contracts\CreateProcessInfoServiceContract;
use App\Services\ProcessInfo\CreateProcessInfoService;
use App\Services\Status\Contracts\ListStatusServiceContract;
use App\Services\Status\ListStatusService;
use App\Services\Suspect\ConfirmSuspectService;
use App\Services\Suspect\Contracts\ConfirmSuspectServiceContract;
use App\Services\Suspect\Contracts\CreateSuspectServiceContract;
use App\Services\Suspect\Contracts\DiscardSuspectServiceContract;
use App\Services\Suspect\Contracts\ListSuspectServiceContract;
use App\Services\Suspect\CreateSuspectService;
use App\Services\Suspect\DiscardSuspectService;
use App\Services\Suspect\ListSuspectService;
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
        $this->bootSuspect();
        $this->bootAddress();
        $this->bootProcessInfo();
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
        $this->app->bind(ConfirmComplaintServiceContract::class, ConfirmComplaintService::class);
        $this->app->bind(StoreCompliantServiceContract::class, StoreCompliantService::class);
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
        $this->app->bind(CreatePlagueServiceContract::class, CreatePlagueService::class);
        $this->app->bind(ListPlagueServiceContract::class, ListPlagueService::class);
        $this->app->bind(ResolvePlagueServiceContract::class, ResolvePlagueService::class);
    }

    /**
     * @return void
     */
    private function bootSuspect(): void
    {
        $this->app->bind(CreateSuspectServiceContract::class, CreateSuspectService::class);
        $this->app->bind(ConfirmSuspectServiceContract::class, ConfirmSuspectService::class);
        $this->app->bind(DiscardSuspectServiceContract::class, DiscardSuspectService::class);
        $this->app->bind(ListSuspectServiceContract::class, ListSuspectService::class);
    }

    /**
     * @return void
     */
    private function bootAddress(): void
    {
        $this->app->bind(CreateAddressServiceContract::class, CreateAddressService::class);
    }

    /**
     * @return void
     */
    private function bootProcessInfo(): void
    {
        $this->app->bind(CreateProcessInfoServiceContract::class, CreateProcessInfoService::class);
    }
}
