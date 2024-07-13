<?php

namespace App\Filament\Resources\FlowerArrangementResource\Pages;

use App\Filament\Resources\FlowerArrangementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFlowerArrangements extends ListRecords
{
    protected static string $resource = FlowerArrangementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
