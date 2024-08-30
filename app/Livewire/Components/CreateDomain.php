<?php

namespace App\Livewire\Components;

use App\Services\DomainService;
use DomainException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use TallStackUi\Traits\Interactions;
use Livewire\Attributes\On;

class CreateDomain extends Component
{
    use Interactions;

    #[Validate('required|max:255|url')]
    public $domain;

    #[Validate('required|max:1|in:0,1')]
    public $role;

    #[Validate('required|max:1|in:0,1')]
    public $status;

    #[Validate('required|integer|max:100')]
    public $priority;

    public $description;

    protected $domainService;

    public function __construct()
    {
        $this->domainService = new DomainService();
    }

    // #[On('createDomainSubmit')]
    public function createDomainSubmit()
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
            $this->domainService->createDomain($data);
            $this->reset(['domain', 'role', 'status', 'priority', 'description']);
            $this->dispatch('closeModal');
            $this->dispatch('filterDomains', []);
            $this->toast()->success('Domain has created!!')->send();
        } catch (\Exception $e) {
            $this->addError('domain', $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.components.create-domain');
    }
}
