<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //order_id', 'payment_date', 'total_payment', 'payment_method
                Select::make('order_id')
                    ->relationship('order', 'order_number')
                    ->required(),
                DatePicker::make('payment_date')
                    ->required()
                    ->maxDate(now()->addDays(7))
                    ->minDate(now()),
                TextInput::make('total_payment')
                    ->required()
                    ->minValue(1)
                    ->numeric(),
                Select::make('payment_method')
                    ->options([
                        'Cash' => 'Cash',
                        'Transfer' => 'Transfer',
                        'Credit Card' => 'Credit Card',
                        'Debit Card' => 'Debit Card',
                        'E-Wallet' => 'E-Wallet',
                        'Others' => 'Others',
                        'Cheque' => 'Cheque',
                        'Mobile Banking' => 'Mobile Banking',
                        'Bank Transfer' => 'Bank Transfer',
                        'Paypal' => 'Paypal',
                        'Cash On Delivery' => 'Cash On Delivery',
                        'Other' => 'Other',
                    ])
                    ->required()
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //order_id', 'payment_date', 'total_payment', 'payment_method
                TextColumn::make('order.order_number')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('payment_date')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('total_payment')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('payment_method')
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}
