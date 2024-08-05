<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\SelectFilter;
use Filament\Notifications\Notification;


class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'User Manajement';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')
                    ->required()->password()->revealable(),
                Select::make('role')->options([
                    'admin' => 'admin',
                    'staff'=>'staff',
                    'user'=>'user'
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(isIndividual:true, isGlobal:true)
                    // ->toggleable()
                    ->sortable(),


                TextColumn::make('email')
                    ->searchable(isIndividual:true, isGlobal:true)
                    ->sortable(),

                TextColumn::make('role')
                    ->searchable(isIndividual:true, isGlobal:true)
                    ->badge()
                    ->color(function (string $state): string{
                        return match($state){
                            'admin' => 'danger', //red
                            'staff' => 'warning',
                            'user' => 'info',
                            // default => 'gray',
                        };
                    })
                    ->sortable(),
            ])
            ->filters([
                //role admin,staff,user
                // SelectFilter::make('role')->options([
                //     'admin' => 'admin',
                //     'staff'=>'staff',
                //     'user'=>'user'
                // ]),
            ])
            ->actions([
                // Tables\Actions\ExportAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                        ->title('User Deleted')
                        ->body('User has been deleted successfully.')
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
