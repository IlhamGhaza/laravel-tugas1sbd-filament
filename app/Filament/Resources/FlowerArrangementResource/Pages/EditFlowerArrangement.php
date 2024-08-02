<?php

namespace App\Filament\Resources\FlowerArrangementResource\Pages;

use App\Filament\Resources\FlowerArrangementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;


class EditFlowerArrangement extends EditRecord
{
    protected static string $resource = FlowerArrangementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotification(): Notification|null
    {
        return Notification::make()
            ->success()
            ->title('Flower Arrangement Updated')
            ->body('The Flower Arrangement has been updated successfully.');
    }
}
