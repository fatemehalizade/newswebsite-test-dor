<?php

namespace App\Providers;

use App\Repositories\ActivityLogRepository\ActivityLogRepository;
use App\Repositories\ActivityLogRepository\InterfaceActivityLogRepository;
use App\Repositories\BaseRepository;
use App\Repositories\CategoryRepository\CategoryRepository;
use App\Repositories\CategoryRepository\InterfaceCategoryRepository;
use App\Repositories\CityRepository\CityRepository;
use App\Repositories\CityRepository\InterfaceCityRepository;
use App\Repositories\CommentRepository\CommentRepository;
use App\Repositories\CommentRepository\InterfaceCommentRepository;
use App\Repositories\FavoriteRepository\FavoriteRepository;
use App\Repositories\FavoriteRepository\InterfaceFavoriteRepository;
use App\Repositories\InterfaceBaseRepository;
use App\Repositories\NewsRepository\InterfaceNewsRepository;
use App\Repositories\NewsRepository\NewsRepository;
use App\Repositories\PermissionRepository\InterfacePermissionRepository;
use App\Repositories\PermissionRepository\PermissionRepository;
use App\Repositories\ProvinceRepository\InterfaceProvinceRepository;
use App\Repositories\ProvinceRepository\ProvinceRepository;
use App\Repositories\UserRepository\InterfaceUserRepository;
use App\Repositories\UserRepository\UserRepository;
use App\Repositories\VisitRepository\InterfaceVisitRepository;
use App\Repositories\VisitRepository\VisitRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(InterfaceBaseRepository::class,BaseRepository::class);
        $this->app->bind(InterfaceProvinceRepository::class,ProvinceRepository::class);
        $this->app->bind(InterfaceCityRepository::class,CityRepository::class);
        $this->app->bind(InterfaceCategoryRepository::class,CategoryRepository::class);
        $this->app->bind(InterfaceUserRepository::class,UserRepository::class);
        $this->app->bind(InterfacePermissionRepository::class,PermissionRepository::class);
        $this->app->bind(InterfaceNewsRepository::class,NewsRepository::class);
        $this->app->bind(InterfaceActivityLogRepository::class,ActivityLogRepository::class);
        $this->app->bind(InterfaceVisitRepository::class,VisitRepository::class);
        $this->app->bind(InterfaceCommentRepository::class,CommentRepository::class);
        $this->app->bind(InterfaceFavoriteRepository::class,FavoriteRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
