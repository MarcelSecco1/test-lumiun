<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class DashboardPage extends Component
{

    public $modalCreateDomain = false;

    public $role;
    public $status;

    public function defineFilter()
    {
        if ($this->role == 'all') {
            $this->role = null;
        }
        if ($this->status == 'all') {
            $this->status = null;
        }


        $this->dispatch('filterDomains', [
            'role' => $this->role,
            'status' => $this->status,
        ]);
    }

    public function resetFilter()
    {
        $this->role = null;
        $this->status = null;

        $this->defineFilter();
    }


    public function render()
    {
        return view('livewire.pages.dashboard-page')->layout('layouts.app');
    }
}
