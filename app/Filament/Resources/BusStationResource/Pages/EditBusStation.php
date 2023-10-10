<?php

namespace App\Filament\Resources\BusStationResource\Pages;

use App\Filament\Resources\BusStationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusStation extends EditRecord
{
    protected static string $resource = BusStationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

	protected function getRedirectUrl(): string
	{
		return $this->getResource()::getUrl('index');
	}
}
