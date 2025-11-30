<?php

namespace App\Providers;

use App\Interfaces\ICategoryRepository;
use App\Interfaces\IColorRepository;
use App\Interfaces\IFindRoute;
use App\Interfaces\IImageRepository;
use App\Interfaces\IOrderRepository;
use App\Interfaces\IPatientImageRepository;
use App\Interfaces\IPatientRepository;
use App\Interfaces\IProductImageRepository;
use App\Interfaces\IProductRepository;
use App\Interfaces\IProposalPriceRepository;
use App\Interfaces\IProposalProthesisRepository;
use App\Interfaces\IUserRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ColorRepository;
use App\Repositories\ImageRepository;
use App\Repositories\OrderRepository;
use App\Repositories\PatientImageRepository;
use App\Repositories\PatientRepository;
use App\Repositories\ProductImageRepository;
use App\Repositories\ProductRepository;
use App\Repositories\ProposalPriceRepository;
use App\Repositories\ProposalProthesisRepository;
use App\Repositories\UserRepository;
use App\Service\FindRouteService;
use Illuminate\Support\ServiceProvider;

class InterfaceProvider extends ServiceProvider
{
    /** Register services. */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IProposalPriceRepository::class, ProposalPriceRepository::class);
        $this->app->bind(IProposalProthesisRepository::class, ProposalProthesisRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IColorRepository::class, ColorRepository::class);
        $this->app->bind(IFindRoute::class, FindRouteService::class);
        $this->app->bind(IPatientRepository::class, PatientRepository::class);
        $this->app->bind(IImageRepository::class, ImageRepository::class);
        $this->app->bind(IPatientImageRepository::class, PatientImageRepository::class);
        $this->app->bind(IProductRepository::class, ProductRepository::class);
        $this->app->bind(IProductImageRepository::class, ProductImageRepository::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
    }

    /** Bootstrap services. */
    public function boot(): void
    {
        //
    }
}
