<?php

namespace App\Filament\Resources\AdminResource\Widgets;

use Filament\Widgets\ChartWidget;

class EmployeeChart extends ChartWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Employees Chart';

    protected static string $color = 'info';



    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Employees',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
