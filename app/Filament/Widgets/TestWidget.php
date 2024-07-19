<?php

namespace App\Filament\Widgets;

use App\Models\Customer;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            // Stat::make('New Customer',Customer::count() )
            //     ->description('New Customer has joined')
            //     ->descriptionIcon('heroicon-o-user-group', IconPosition::Before)
            //     ->color('success')
            //     ->chart([
            //         Customer::all()
            //         ->groupBy(fn($customer) => $customer->created_at->format('M'))
            //             ->map(fn($customers) => $customers->count())
            //             ->toArray(

            //         )]
            //     )

            Stat::make('New Customer', Customer::query()->where('created_at', 'deleted_at')->count())
                ->description('New Customer has joined')
                ->descriptionIcon('heroicon-o-user-group', IconPosition::Before)
                ->color('success'),

            //  Stat::make('New Customer', Customer::query()->where('created_at', 'deleted_at')->count())
            //     ->description('New Customer has joined')
            //     ->descriptionIcon('heroicon-o-user-group', IconPosition::Before)
            //     ->color('success'),

        ];
    }
}
