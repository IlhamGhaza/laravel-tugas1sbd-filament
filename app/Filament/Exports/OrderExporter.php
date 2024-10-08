<?php

namespace App\Filament\Exports;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class OrderExporter extends Exporter
{
    protected static ?string $model = Order::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('order_number'),
            ExportColumn::make('customer.name'),
            ExportColumn::make('order_date'),
            ExportColumn::make('total_price'),
            ExportColumn::make('discount'),
            ExportColumn::make('orderDetails.arrangement.name'),
            ExportColumn::make('orderDetails.quantity'),
            ExportColumn::make('orderDetails.unit_price'),
            ExportColumn::make('orderDetails.sub_total'),
            ExportColumn::make('payments.payment_date'),
            ExportColumn::make('payments.total_payment'),
            ExportColumn::make('payments.payment_method'),
            ExportColumn::make('payments.payment_status'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your order export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
