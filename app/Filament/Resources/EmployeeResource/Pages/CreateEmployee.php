<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEmployee extends CreateRecord
{
    protected static string $resource = EmployeeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): string|null
    {
        return 'Employee Created';
    }

    public function getCreatedNotification(): \Filament\Notifications\Notification|null{
        return \Filament\Notifications\Notification::make()
            ->success()
            ->title($this->getCreatedNotificationTitle())
            ->body('Employee created successfully.');
    }
}
