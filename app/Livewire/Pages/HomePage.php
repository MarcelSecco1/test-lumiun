<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class HomePage extends Component
{

    public function mount()
    {
        auth()->check() ? redirect()->route('dashboard') : '';
    }

    public function render()
    {
        return view('livewire.pages.home-page')->layout('layouts.app');
    }
}
