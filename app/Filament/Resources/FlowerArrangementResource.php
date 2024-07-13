<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlowerArrangementResource\Pages;
use App\Filament\Resources\FlowerArrangementResource\RelationManagers;
use App\Models\FlowerArrangement;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FlowerArrangementResource extends Resource
{
    protected static ?string $model = FlowerArrangement::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //'name', 'type', 'description', 'size', 'price'
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->minLength(3),
                TextInput::make('type')
                    ->required()
                    ->maxLength(255)
                    ->minLength(3),
                TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->minLength(10),
                FileUpload::make('image')
                    ->image(),
                TextInput::make('size')
                    ->required()
                    ->minLength(1),
                TextInput::make('price')
                    ->required()
                    ->minLength(1)
                    ->numeric()
                    ->minValue(1000),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //'name', 'type', 'description', 'size', 'price'
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('type')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('description')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                //image
                ImageColumn::make('image')
                    ->searchable(),
                TextColumn::make('size')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('price')
                    ->searchable()
                    ->sortable()
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
            'index' => Pages\ListFlowerArrangements::route('/'),
            'create' => Pages\CreateFlowerArrangement::route('/create'),
            'edit' => Pages\EditFlowerArrangement::route('/{record}/edit'),
        ];
    }
}
