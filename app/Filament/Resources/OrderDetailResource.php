<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderDetailResource\Pages;
use App\Filament\Resources\OrderDetailResource\RelationManagers;
use App\Models\OrderDetail;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderDetailResource extends Resource
{
    protected static ?string $model = OrderDetail::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Order';
    protected static ?int $navigationSort = 6;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //'order_id', 'arrangement_id', 'quantity', 'unit_price', 'sub_total
                Select::make('order_id')
                    ->relationship('order', 'order_number')
                    ->required()
                    ->searchable(),
                Select::make('arrangement_id')
                    ->relationship('arrangement', 'name')
                    ->multiple()
                    ->required()
                    ->searchable(),
                TextInput::make('quantity')
                    ->required()
                    ->minValue(1),
                TextInput::make('unit_price')
                    ->required()
                    ->minValue(1)
                    ->numeric(),
                TextInput::make('sub_total')
                    ->required()
                    ->minValue(1)
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //'order_id', 'arrangement_id', 'quantity', 'unit_price', 'sub_total
                TextColumn::make('order.order_number')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('arrangement.name')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('quantity')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('unit_price')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('sub_total')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListOrderDetails::route('/'),
            'create' => Pages\CreateOrderDetail::route('/create'),
            'edit' => Pages\EditOrderDetail::route('/{record}/edit'),
        ];
    }
}
