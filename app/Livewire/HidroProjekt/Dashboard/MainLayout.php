<?php

namespace App\Livewire\HidroProjekt\Dashboard;

use Livewire\Component;

class MainLayout extends Component
{
    public $config = [
        'r1' => [
            'height' => 200,
            'col' => [
                'c1' =>[
                    'title' => 'TEST01'
                ],
                'c2' =>[
                    'title' => 'TEST02'
                ],
                'c3' =>[
                    'title' => 'Livewire test',
                    'livewire' => 'test'
                ],
            ]
        ],
        'r2' => [
            'height' => 600,
            'col' => [
                'c1' =>[
                    'title' => 'TEST03'
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
