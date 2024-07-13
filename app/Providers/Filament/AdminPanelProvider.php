<?php

namespace App\Providers\Filament;

use App\Filament\Resources\CourierResource;
use App\Filament\Resources\CustomerResource;
use App\Filament\Resources\DeliveryResource;
use App\Filament\Resources\FlowerArrangementResource;
use App\Filament\Resources\OrderDetailResource;
use App\Filament\Resources\OrderResource;
use App\Filament\Resources\PaymentResource;
use App\Filament\Resources\UserResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Green, //change the color
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
            // ->navigationGroups($this->getNavigationGroups()); // use navigationGroups
    }

    // public function getNavigationGroups(): array
    // {
    //     return [
    //         // Group: Dashboard
    //         NavigationGroup::make('Dashboard')
    //             ->items([
    //                 Pages\Dashboard::class, // add Dashboard ke navigation
    //             ]),

    //         // Group 1: Customers and Users
    //         NavigationGroup::make('Customers and Users')
    //             ->items([
    //                 UserResource::getNavigation(),
    //                 CustomerResource::getNavigation(),
    //                 CourierResource::getNavigation(),
    //             ]),

    //         // Group 2: Flowers
    //         NavigationGroup::make('Flowers')
    //             ->items([
    //                 FlowerArrangementResource::getNavigation(),
    //             ]),

    //         // Group 3: Orders and Deliveries
    //         NavigationGroup::make('Orders and Deliveries')
    //             ->items([
    //                 OrderResource::getNavigation(),
    //                 OrderDetailResource::getNavigation(),
    //                 PaymentResource::getNavigation(),
    //                 DeliveryResource::getNavigation(),
    //             ]),
    //     ];
    //}
}
