<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use App\Models\Order;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget\Card;


class TestWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        return [
           Stat::make('Total Customers', Customer::count())
                ->description('All registered customers')
                ->descriptionIcon('heroicon-o-users'),
            Stat::make('Total Orders', Order::count())
                ->description('All orders placed')
                ->descriptionIcon('heroicon-o-shopping-cart'),
            Stat::make('Total Revenue', Order::sum('total_price'))
                ->description('Total revenue generated')
                ->descriptionIcon('heroicon-o-currency-dollar'),
        ];
    }
}
