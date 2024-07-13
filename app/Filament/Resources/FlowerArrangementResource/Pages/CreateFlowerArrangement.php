<?php

namespace App\Filament\Resources\FlowerArrangementResource\Pages;

use App\Filament\Resources\FlowerArrangementResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFlowerArrangement extends CreateRecord
{
    protected static string $resource = FlowerArrangementResource::class;
    public function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
