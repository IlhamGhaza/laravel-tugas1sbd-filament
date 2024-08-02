<?php

namespace App\Filament\Resources\CourierResource\Pages;

use App\Filament\Resources\CourierResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;


class CreateCourier extends CreateRecord
{
    protected static string $resource = CourierResource::class;
    protected function getCreatedNotification(): Notification|null
    {
        return Notification::make()
            ->success()
            ->title('Courier Created')
            ->body('Courier has been created successfully.');
    }
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
