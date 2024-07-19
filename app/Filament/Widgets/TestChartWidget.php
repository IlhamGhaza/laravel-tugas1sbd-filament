<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class TestChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Orders per month';

    protected function getData(): array
    {
        $data = Trend::model(Order::class)
        ->between(
            start: now()->subMonths(6),
            end: now(),
        )
        ->perYear()
        ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Orders',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
        
    }

    protected function getType(): string
    {
        return 'line';
    }
}
