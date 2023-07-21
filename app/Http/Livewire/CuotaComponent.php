<?php

namespace App\Http\Livewire;

use App\Models\Cuota;
use Livewire\Component;
use Livewire\WithPagination;

class CuotaComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $cuotas = Cuota::paginate(6);
        return view('livewire.cuota-component',compact('cuotas'));
    }
}
