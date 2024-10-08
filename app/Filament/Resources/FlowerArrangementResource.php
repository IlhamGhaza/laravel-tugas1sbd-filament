<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FlowerArrangementResource\Pages;
use App\Models\FlowerArrangement;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class FlowerArrangementResource extends Resource
{
    protected static ?string $model = FlowerArrangement::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Warehouse';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //'name', 'type', 'description', 'size', 'price'
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->minLength(3),
                FileUpload::make('image')
                    ->image()
                    ->disk('public'),
                // ->directory('flower_arrangements')
                // ->required()
                TextInput::make('type')
                    ->required()
                    ->maxLength(255)
                    ->minLength(3),
                TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->minLength(10),
                Select::make('size')
                    ->options([
                        'small' => 'Small',
                        'medium' => 'Medium',
                        'large' => 'Large',
                        'extra large' => 'Extra Large',
                    ])
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()->placeholder('min : 1000')
                    // ->maxValue()
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
                //image
                ImageColumn::make('image')
                    ->disk('public')
                    ->square(),
                TextColumn::make('type')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('description')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('size')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('price')
                    ->searchable()
                    ->currency('idr', 'IDR')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                //flower size 'small', 'medium','extra large'
                // SelectFilter::make('size')
                //     ->options([
                //         'small' => 'Small',
                //         'medium' => 'Medium',
                //         'large' => 'Large',
                //         'extra large' => 'Extra Large',
                //     ]),
                // //price
                // SelectFilter::make('price')
                // ->query(fn (Builder $query): Builder => $query->where('price', '>=', 10000))
                //     ->options([
                //         '10000' => '10000',
                //         '20000' => '20000',
                //         '30000' => '30000',
                //         '40000' => '40000',
                //     ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->title('Flower Arrangement Deleted')
                            ->body('Flower Arrangement has been deleted successfully.')
                            ->success()
                    ),
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
