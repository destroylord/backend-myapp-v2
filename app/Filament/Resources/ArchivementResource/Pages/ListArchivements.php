<?php

namespace App\Filament\Resources\ArchivementResource\Pages;

use App\Filament\Resources\ArchivementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArchivements extends ListRecords
{
    protected static string $resource = ArchivementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
