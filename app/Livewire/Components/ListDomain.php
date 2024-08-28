<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\View\View;
use App\Models\Domain;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class ListDomain extends Component
{
    use WithPagination;

    const PAGINATION = 15;

    public $filter = [];

    public $showDeleteModal = false;
    public $domainIdToDelete = null;

    #[Url('dashboard')]
    public $url;

    #[On('filterDomains')]
    public function filterDomains($filter)
    {
        $this->filter = $filter;
        $this->resetPage();
    }

    public function toggleDeleteModal($domainId = null)
    {
        $this->showDeleteModal = !$this->showDeleteModal;
        $this->domainIdToDelete = $domainId;
    }

    public function deleteDomain()
    {
        if ($this->domainIdToDelete) {
            $domain = Domain::find($this->domainIdToDelete);
            if ($domain) {
                $domain->delete();
            }
            $this->reset(['domainIdToDelete', 'showDeleteModal']);
            $this->resetPage();
        }
    }

    private function getDomains()
    {
        $query = Domain::query();

        if (isset($this->filter['role'])) {
            $query->where('is_blocked', $this->filter['role']);
        }

        if (isset($this->filter['status'])) {
            $query->where('status', $this->filter['status']);
        }

        if (isset($this->filter['priority'])) {
            $query->where('priority', $this->filter['priority']);
        }

        return $query->paginate(self::PAGINATION);
    }



    public function render(): View
    {
        $domains = $this->getDomains();

        return view('livewire.components.list-domain', compact('domains'));
    }
}
