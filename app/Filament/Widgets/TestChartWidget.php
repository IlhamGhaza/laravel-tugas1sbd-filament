<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Carbon\Carbon;

class TestChartWidget extends ChartWidget
{
    // Order of the widget in a dashboard or layout
    protected static ?int $sort = 3;

    // Heading to display for the widget
    protected static ?string $heading = 'Orders per month';
    protected $dateFormat = 'M Y';

    /**
     * Get the data for the chart.
     *
     * @return array The data to be used by the chart.
     */
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
                    'backgroundColor' => 'rgba(75, 192, 192, 0.2)', // Light blue background color
                    'borderColor' => 'rgba(75, 192, 192, 1)',       // Blue border color
                    'borderWidth' => 1,                              // Border width
                ],
            ],
            'labels' => $data->map(function (TrendValue $value) {
                return $value->date instanceof \DateTime
                    ? $value->date->format('M Y')
                    : $value->date;
            })->toArray(),

        ];
    }

    /**
     * Get the type of the chart.
     *
     * @return string The type of the chart.
     */
    protected function getType(): string
    {
        return 'line';
    }

    /**
     * Get the chart options to customize its appearance.
     *
     * @return array The chart options.
     */
    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'title' => [
                        'display' => true,
                        'text' => 'Number of Orders',
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Month',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
                'title' => [
                    'display' => true,
                    'text' => 'Orders per Month',
                ],
            ],
        ];
    }
}
