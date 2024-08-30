<?php

namespace App\Livewire\Components;

use App\Models\Domain;
use App\Services\DomainService;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;

class EditDomain extends Component
{
    use Interactions;

    protected DomainService $domainService;

    public Domain $domainEdit;

    #[Validate('required|max:255|url')]
    public $domain;

    #[Validate('required|max:1|in:0,1')]
    public $role;

    #[Validate('required|max:1|in:0,1')]
    public $status;

    #[Validate('required|integer')]
    public $priority;

    public $description;


    public function __construct()
    {
        $this->domainService = new DomainService();
    }


    #[On('defineDomain')]
    public function defineDomain($id)
    {
        $domain = $this->domainService->getById($id);

        if (!$domain) {
            $this->toast()->error('Domain not found!!')->send();
            return;
        }
        $this->domainEdit = $domain;
        $this->domain = $domain->domain;
        $this->role = $domain->is_blocked;
        $this->status = $domain->status;
        $this->priority = $domain->priority;
        $this->description = $domain->description;
    }


    public function editDomainSubmit()
    {
        $this->validate();

        if ($this->priority < 0 || $this->priority > 100) {
            $this->addError('priority', 'Priority must be between 0 and 100');
            return;
        }

        $data = [
            'domain' => $this->domain,
            'is_blocked' => $this->role,
            'status' => $this->status,
            'priority' => $this->priority,
            'description' => $this->description,
            'user_id' => auth()->id(),
        ];

        try {
            $this->domainService->updateDomain($data, $this->domainEdit);

            $this->dispatch('closeEditModal');
            $this->dispatch('filterDomains', []);
            $this->toast()->success('Domain has updated!!')->send();
        } catch (\Exception $e) {
            $this->addError('domain', $e->getMessage());
        }
    }

    #[On('closeEditModal')]
    public function resetFields()
    {
        $this->reset(['domain', 'role', 'status', 'priority', 'description']);
    }

    public function render()
    {
        return view('livewire.components.edit-domain');
    }
}
