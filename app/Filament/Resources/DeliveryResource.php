<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeliveryResource\Pages;
use App\Filament\Resources\DeliveryResource\RelationManagers;
use App\Models\Delivery;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class DeliveryResource extends Resource
{
    protected static ?string $model = Delivery::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //order_id', 'delivery_address', 'delivery_date', 'courier_id
                Select::make('order_id')
                    ->relationship('order', 'order_number')
                    ->required(),
                TextInput::make('delivery_address')
                    ->required()
                    ->maxLength(255)
                    ->minLength(10),
                DatePicker::make('delivery_date')
                    ->required()
                    // ->maxDate(now()->addDays(7))
                    ->minDate(now()),
                Select::make('courier_id')
                    ->relationship('courier', 'name')
                    ->required()
                    ->searchable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //order_id', 'delivery_address', 'delivery_date', 'courier_id
                TextColumn::make('order.order_number')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('delivery_address')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('delivery_date')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('courier.name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
