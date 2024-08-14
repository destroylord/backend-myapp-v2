<?php

namespace App\Filament\Resources\PortfolioResource\Pages;

use App\Filament\Resources\PortfolioResource;
use App\Models\Portfolio;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditPortfolio extends EditRecord
{
    protected static string $resource = PortfolioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->label('Delete Portfolio')
            ->after(function (Portfolio $record) {
                if ($record->thumbnail) {
                    foreach ($record->thumbnail as $ph) {
                        Storage::delete($ph);
                    }
                }
            }),
        ];
    }
}
