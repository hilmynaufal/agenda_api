<?php

namespace App\Filament\Resources\MPendampingResource\Pages;

use App\Filament\Resources\MPendampingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMPendampings extends ListRecords
{
    protected static string $resource = MPendampingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
