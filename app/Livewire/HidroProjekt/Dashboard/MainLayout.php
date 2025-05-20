<?php

namespace App\Livewire\HidroProjekt\Dashboard;

use Livewire\Component;
use App\Models\DashboardTemplate;

class MainLayout extends Component
{
    public $config = [
        'r1' => [
            'height' => 300,
            'col' => [
                'c1' =>[
                    'title' => ''
                ],
                'c2' =>[
                    'title' => 'vremenska prognoza',
                    'comp_name' => 'weather-forecast',
                    'center' => TRUE,
                ],
            ]
        ],
        'r2' => [
            'height' => 500,
            'col' => [
                'c1' =>[
                    'title' => 'Moji zadaci',
                    'comp_name' => 'to-do-list',
                    'btn_comp' => 'add-new-task-modal'
                ],
                'c2' =>[
                    'title' => 'obavjesti',
                    'comp_name' => 'system-notifications',
                    'btn_comp' => null
                ]
            ]
        ]
    ];

    public $layout = [
        'r1' => [
            'height' => NULL,
            'col' => [
                'c1' =>[
                    'title' => NULL,
                    'comp_name' => NULL,
                    'center' => NULL,
                    'btn' => NULL,
                ],
                'c2' =>[
                    'title' => NULL,
                    'comp_name' => NULL,
                    'center' => NULL,
                    'btn' => NULL,
                ],
                'c3' =>[
                    'title' => NULL,
                    'comp_name' => NULL,
                    'center' => NULL,
                    'btn' => NULL,
                ],
            ]
        ],
        'r2' => [
            'height' => NULL,
            'col' => [
                'c1' =>[
                    'title' => NULL,
                    'comp_name' => NULL,
                    'center' => NULL,
                    'btn' => NULL,
                ],
                'c2' =>[
                    'title' => NULL,
                    'comp_name' => NULL,
                    'center' => NULL,
                    'btn' => NULL,
                ]
            ]
        ]
    ];

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.main-layout');
    }
}
