<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowMeme extends Component
{
    // public $currentMeme;

    // public function mount($currentMeme) {
    //     $this->currentMeme = $currentMeme;
    // }

    public function render()
    {
        return view('livewire.show-meme');
    }
}
