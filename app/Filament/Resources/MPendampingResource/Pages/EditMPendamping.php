<?php

namespace App\Filament\Resources\MPendampingResource\Pages;

use App\Filament\Resources\MPendampingResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMPendamping extends EditRecord
{
    protected static string $resource = MPendampingResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
