<?php

namespace App\Filament\Resources\FlowerArrangementResource\Pages;

use App\Filament\Resources\FlowerArrangementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;


class CreateFlowerArrangement extends CreateRecord
{
    protected static string $resource = FlowerArrangementResource::class;
    protected function getCreatedNotification(): Notification|null
    {
        return Notification::make()
            ->success()
            ->title('Flower Arrangement Created')
            ->body('Flower Arrangement Created Successfully');
    }
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
