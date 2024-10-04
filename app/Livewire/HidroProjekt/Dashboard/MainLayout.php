<?php

namespace App\Livewire\HidroProjekt\Dashboard;

use Livewire\Component;

class MainLayout extends Component
{
    public $config = [
        'r1' => [
            'height' => 300,
            'col' => [
                'c1' =>[
                    'title' => 'TEST01'
                ],
                'c2' =>[
                    'title' => 'TEST02'
                ],
                'c3' =>[
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
                    'comp_name' => 'to-do-list'
                ],
                'c2' =>[
                    'title' => NULL
                ]
            ]
        ]
            ];

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.main-layout');
    }
}
