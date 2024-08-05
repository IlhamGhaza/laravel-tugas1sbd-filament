<?php

namespace App\Filament\Resources;

use App\Filament\Exports\DeliveryExporter;
use App\Filament\Resources\DeliveryResource\Pages;
use App\Models\Courier;
use App\Models\Delivery;
use Filament\Tables\Filters\Filter;
use App\Models\Customer;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Filament\Notifications\Notification;


class DeliveryResource extends Resource
{
    protected static ?string $model = Delivery::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Delivery';

    protected static ?int $navigationSort = 8;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Select::make('order_id')->relationship('order', 'order_number')->required(),
            Select::make('customer_id')->relationship('customer', 'name'),
            TextInput::make('delivery_name')->maxLength(255)->minLength(3),
            TextInput::make('delivery_address')->maxLength(255)->minLength(10),
            DatePicker::make('delivery_date')->default(now())->required(),
            Select::make('courier_id')->relationship('courier', 'name')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //order_id', 'delivery_address', 'delivery_date', 'courier_id
                TextColumn::make('order.order_number')->sortable()->searchable()->toggleable(),
                TextColumn::make('customer.name')->sortable()->searchable()->toggleable(),
                TextColumn::make('customer.address')->sortable()->searchable()->toggleable(),
                TextColumn::make('delivery_name')->sortable()->searchable()->toggleable(),
                TextColumn::make('delivery_address')->sortable()->searchable()->toggleable(),
                TextColumn::make('delivery_date')->sortable()->searchable()->toggleable(),
                TextColumn::make('courier.name')->sortable()->searchable()->toggleable(),
            ])
            ->filters([
                //
                Filter::make('delivery_date')
                ->form([
                    DatePicker::make('from')
                        ->label('From Date'),
                    DatePicker::make('to')
                        ->label('To Date'),
                ])
                ->query(function ($query, $data) {
                    return $query
                        ->when($data['from'], fn ($query) => $query->where('delivery_date', '>=', $data['from']))
                        ->when($data['to'], fn ($query) => $query->where('delivery_date', '<=', $data['to']));
                }),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(DeliveryExporter::class),
            ])
            ->actions([
                Tables\Actions\Action::make('pdf')
                    ->label('PDF')
                    ->color('success')
                    ->action(function (Model $record) {
                        $customer = $record->customer;
                        $courier = $record->courier;
                        $order = $record->orders;

                        return response()->streamDownload(function () use ($record, $customer,$courier, $order) {
                            // Load the PDF content using Blade template
                            echo Pdf::loadHtml(
                                Blade::render('pdf2', [
                                    'record' => $record,
                                    'customer' => $record,
                                    'courier' => $courier,
                                    'order' => $order,
                                ]),
                            )->stream();
                        },  $record->order->order_number.'-Delivery-detail.pdf');
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                 ->successNotification(
                    Notification::make()
                        ->title('Delivery Deleted')
                        ->body('Delivery has been deleted successfully.')
                        ->success()
                ),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make()]),
                ExportBulkAction::make()->exporter(DeliveryExporter::class)
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeliveries::route('/'),
            'create' => Pages\CreateDelivery::route('/create'),
            'edit' => Pages\EditDelivery::route('/{record}/edit'),
        ];
    }
}
