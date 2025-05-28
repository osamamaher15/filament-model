<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployee extends EditRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

     public function getSavedNotification(): \Filament\Notifications\Notification|null{
        return \Filament\Notifications\Notification::make()
            ->success()
            ->title($this->getSavedNotificationTitle())
            ->body('Employee updated successfully.');
    }
}
