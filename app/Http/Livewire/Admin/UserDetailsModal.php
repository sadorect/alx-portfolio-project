<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class UserDetailsModal extends Component
{
    public $user;
    public $showModal = false;

    protected $listeners = ['showUserDetails' => 'showDetails'];

    public function showDetails(User $user)
    {
        $this->user = $user->load(['celebrants', 'activities']);
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.admin.user-details-modal');
    }
}
