<?php

namespace App\Filament\Resources\MAgendaResource\Pages;

use App\Filament\Resources\MAgendaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMAgenda extends EditRecord
{
    protected static string $resource = MAgendaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
