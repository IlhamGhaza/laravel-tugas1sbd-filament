<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TextFilter;
use Filament\Tables\Filters\DateRangeFilter;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'User Manajement';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
               TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('address')
                    ->required()
                    ->maxLength(255),
               TextInput::make('phone')
                    ->required()
                    ->maxLength(255)
                    ->tel(),
                Select::make('status')
                    ->options([
                        'regular' => 'Regular',
                        'non-regular' => 'Non-regular',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),

                TextColumn::make('address')
                    ->searchable()->sortable()->toggleable(),

                TextColumn::make('phone')
                ->searchable()->toggleable()->sortable(),

                TextColumn::make('status')
                ->searchable()->toggleable()->sortable()
                ->badge()
                ->color(function (string $state): string{
                    return match($state){
                        'regular' => 'success', //green
                        'non-regular' => 'info',
                        // default => 'gray',
                    };
                }),
            ])
            ->filters([
                SelectFilter::make('status')
                ->options([
                    'regular' => 'Regular',
                    'non-regular' => 'Non-Regular',
                ])
                ->label('Status Pelanggan'),

                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->label('From Date'),
                        DatePicker::make('created_until')
                            ->label('To Date'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when($data['created_from'], function ($query, $date) {
                            $query->whereDate('created_at', '>=', $date);
                        })->when($data['created_until'], function ($query, $date) {
                            $query->whereDate('created_at', '<=', $date);
                        });
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->success()
                        ->title('Customer Deleted')
                        ->body('Customer deleted successfully')
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
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
