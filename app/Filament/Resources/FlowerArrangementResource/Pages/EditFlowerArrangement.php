<?php

namespace App\Filament\Resources\FlowerArrangementResource\Pages;

use App\Filament\Resources\FlowerArrangementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

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
}
