<?php

namespace App\Filament\Resources\DeliveryResource\Pages;

use App\Filament\Resources\DeliveryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;


class CreateDelivery extends CreateRecord
{
    protected static string $resource = DeliveryResource::class;
    protected function getCreatedNotification(): Notification|null
    {
        return Notification::make()
            ->success()
            ->title('Delivery Created')
            ->body('Delivery has been created successfully.');
    }
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
