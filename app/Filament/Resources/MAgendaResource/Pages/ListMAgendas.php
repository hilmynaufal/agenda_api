<?php

namespace App\Filament\Resources\MAgendaResource\Pages;

use App\Filament\Resources\MAgendaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMAgendas extends ListRecords
{
    protected static string $resource = MAgendaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
