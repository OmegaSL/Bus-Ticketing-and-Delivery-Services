<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

	protected function mutateFormDataBeforeSave(array $data): array
	{
		$getUser = User::where('email', $data['email'])->first();
		if ($getUser) {
			if (empty($data['password'])) {
				$data['password'] = $getUser->password;
			}
		}
		return $data;
	}

	protected function getRedirectUrl(): string
	{
		return $this->getResource()::getUrl('index');
	}
}