<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class LeftAsideCell extends Cell
{
    public function mount()  {

    }
    public function render(): string
    {
        return view('App\Views\partials\left-aside', [
            'data' => null,
        ]);
    }
}
