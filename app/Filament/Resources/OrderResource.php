<?php

namespace App\Filament\Resources;

use App\Filament\Exports\OrderExporter;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportAction as ActionsExportAction;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Columns\DateColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Tables\Actions\ExportAction;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ViewAction;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Order';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
       ->schema([

            Forms\Components\Section::make('Order')
                ->description('Put the Order')
                ->schema([
                    TextInput::make('order_number')->required(),
                    Select::make('customer_id')->relationship('customer', 'name')->searchable()->preload()->required(),
                    DatePicker::make('order_date')->default(now())
                    ->native(false)
                    ->displayFormat('d/m/Y')
                    ->required(),
                    TextInput::make('total_price')->numeric()->default(0)->required()->disabled(),
                    // ->disabled(),
                    TextInput::make('discount')->numeric()->default(0)->disabled(),
                    // ->disabled(),
                ])
                ->columns(2),

            Forms\Components\Section::make('Order Detail')
                ->description('Put the Detail Order')
                ->schema([
                    Forms\Components\HasManyRepeater::make('orderDetails')
                        ->relationship('orderDetails')
                        ->schema([
                            Select::make('arrangement_id')
                            ->relationship('arrangement', 'name')
                            ->multiple()
                            ->searchable()->preload()
                            ->required(),
                            TextInput::make('quantity')->required(),
                            TextInput::make('unit_price')->default(0)->required()->disabled(),
                            TextInput::make('sub_total')->default(0)->required()->disabled(),
                        ])
                        ->columns(2)
                        ->columnSpan('full')
                        ->collapsed(false)
                        ->maxItems(1)
                ])
                ->columns(1),

            Forms\Components\Section::make('Payment')
                ->description('Put the Payment')
                ->schema([
                    Forms\Components\HasManyRepeater::make('payments')
                        ->relationship('payments')
                        ->schema([
                            DatePicker::make('payment_date')->default(now())->native(false)->displayFormat('d/m/Y')->required(),
                            TextInput::make('total_payment')->default(0)->required()->disabled(),
                            Select::make('payment_method')
                                ->options([
                                    'Cash' => 'Cash',
                                    'Transfer' => 'Transfer',
                                    'Debit Card' => 'Debit Card',
                                    'Credit Card' => 'Credit Card',
                                    'Other' => 'Other',
                                ])
                                ->searchable()->preload()
                                ->required(),
                            Select::make('payment_status')
                                ->options([
                                    'Paid' => 'Paid',
                                    'Unpaid' => 'Unpaid',
                                ])
                                ->required(),
                        ])
                        ->columns(2)
                        ->columnSpan('full')
                        ->collapsed(false)
                        ->maxItems(1)
                ])
                ->columns(1),

            Forms\Components\Section::make('Delivery')
                ->description('Put the Detail Delivery')
                ->schema([
                    Forms\Components\HasManyRepeater::make('deliveries')
                        ->relationship('deliveries')
                        ->schema([
                            Select::make('customer_id')->relationship('customer', 'name')->searchable()->preload(),
                            TextInput::make('delivery_name')->maxLength(255)->minLength(3),
                            TextInput::make('delivery_address')->maxLength(255)->minLength(10),
                            DatePicker::make('delivery_date')->default(now())->native(false)->displayFormat('d/m/Y')->required(),
                            Select::make('courier_id')->relationship('courier', 'name')->required()->searchable()->preload(),
                        ])
                        ->columns(2)
                        ->columnSpan('full')
                        ->collapsed(false)
                        ->maxItems(1)
                ])
                ->columns(1)
        ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([TextColumn::make('order_number')->sortable()->searchable()->toggleable(),
            TextColumn::make('customer.name')->sortable()->searchable()->toggleable(),
            TextColumn::make('order_date')->sortable()->toggleable(),
            TextColumn::make('total_price')->toggleable()->sortable()->formatStateUsing(fn(string $state): string => number_format($state, 2)),
            TextColumn::make('discount')->toggleable()->sortable()->formatStateUsing(fn(string $state): string => number_format($state, 2))])
            ->filters([
                //
            ])
            ->headerActions([ExportAction::make()->exporter(OrderExporter::class)])
            ->actions([

                Tables\Actions\Action::make('pdf')
                    ->label('PDF')
                    ->color('success')
                    ->action(function (Model $record) {
                        $customer = $record->customer;
                        $orderDetails = $record->orderDetails()->with('arrangement')->get();
                        $payments = $record->payments()->get();

                        return response()->streamDownload(function () use ($record, $customer, $orderDetails, $payments) {
                            echo Pdf::loadHtml(
                                Blade::render('pdf', [
                                    'record' => $record,
                                    'customer' => $customer,
                                    'orderDetails' => $orderDetails,
                                    'payments' => $payments,
                                ]),
                            )->stream();
                        }, $record->order_number . '-order.pdf');
                    }),
                ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                 ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Customer Deleted')
                        ->body('Customer deleted successfully')
                ),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]), ExportBulkAction::make()->exporter(OrderExporter::class)]);
    }

    public static function getRelations(): array
    {
        return [
                //
                // RelationManagers\OrderDetailsRelationManager::class,
                // RelationManagers\PaymentsRelationManager::class,
            ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
