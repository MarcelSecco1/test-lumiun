<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\View\View;
use App\Models\Domain;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;
use App\Services\DomainService;
use TallStackUi\Traits\Interactions;

class ListDomain extends Component
{
    use WithPagination, Interactions;

    const PAGINATION = 15;

    public $filter = [];

    public $showEditModal = false;
    public $showDeleteModal = false;
    public $domainIdToDelete = null;

    protected $domainService;

    public function __construct()
    {
        $this->domainService = new DomainService();
    }

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

    #[On('closeEditModal')]
    public function toggleEditModal($domainId = null)
    {
        $this->showEditModal = !$this->showEditModal;
        if ($domainId) {
            $this->dispatch('defineDomain', $domainId);
        }
    }

    public function deleteDomain()
    {
        if ($this->domainIdToDelete) {
            $this->domainService->deleteDomain($this->domainIdToDelete);
            $this->reset(['domainIdToDelete', 'showDeleteModal']);
            $this->toast()->success('Domain has deleted!!')->send();
            $this->resetPage();
        }
    }

    private function getDomains()
    {

        $domains = $this->domainService->filterDomains($this->filter, auth()->id());

        return $domains->paginate(self::PAGINATION);
    }



    public function render(): View
    {
        $domains = $this->getDomains();

        return view('livewire.components.list-domain', compact('domains'));
    }
}
