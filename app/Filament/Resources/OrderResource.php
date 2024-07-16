<?php

namespace App\Filament\Resources;

use App\Filament\Exports\OrderExporter;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Resources\OrderResource\RelationManagers\OrderDetailsRelationManager;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\ExportAction;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ExportBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Actions\ExportAction as ActionsExportAction;
use Filament\Tables\Columns\DateColumn;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Order';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('order_number')->required(),
            Select::make('customer_id')
                ->relationship('customer', 'name')
                // ->searchable()
                ->required(),
            DatePicker::make('order_date')->required(),
            TextInput::make('total_price')->numeric()->required(),
            TextInput::make('discount')->numeric()->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')->sortable()->searchable(),
                TextColumn::make('customer.name')->sortable()->searchable(),
                TextColumn::make('order_date')->sortable(),
                // ->DateColumn(),
                TextColumn::make('total_price')->sortable()->formatStateUsing(fn(string $state): string => number_format($state, 2)),
                TextColumn::make('discount')->sortable()->formatStateUsing(fn(string $state): string => number_format($state, 2)),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // ActionsExportAction::make()->exporter(OrderExporter::class),
                \Filament\Tables\Actions\ExportAction::make()->exporter(OrderExporter::class),
            ])
            ->actions([
                Tables\Actions\Action::make('pdf')
                    ->label('PDF')
                    ->color('success')
                    // ->icon('heroicon-arrow-down-tray')
                    ->action(function (Model $record) {
                        $customer = $record->customer;
                        return response()->streamDownload(function () use ($record, $customer) {
                            echo Pdf::loadHtml(Blade::render('pdf', ['record' => $record, 'customer' => $customer]))->stream();
                        }, $record->order_number . '.pdf');
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()]), ExportBulkAction::make()->exporter(OrderExporter::class)]);
    }

    public static function getRelations(): array
    {
        return [
                //
                // OrderDetailsRelationManager::class
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
