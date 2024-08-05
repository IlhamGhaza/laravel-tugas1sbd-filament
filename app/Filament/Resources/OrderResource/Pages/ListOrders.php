<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'All' => Tab::make('All'),
            'Today' => Tab::make('Today')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at',
                    '>=', now()->subDay())),
            'This week' => Tab::make('This week')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at',
                    '>=', now()->subWeek()
                )),
           'Last week' => Tab::make('Last week')
                ->modifyQueryUsing(function (Builder $query) {
                    return $query->where('created_at', '>=', now()->subWeek()->startOfDay());
                }),
            'This month' => Tab::make('This month')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at',
                    '>=', now()->subMonth())
                ),
            'This quarter' => Tab::make('This quarter')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at',
                    '>=', now()->subQuarter())
                ),
            'This year' => Tab::make('This year')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('created_at',
                    '>=', now()->subYear())
                ),

        ];
    }
}
