<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination;

    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field 
            ? $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';
            
        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.admin.user-list', [
            'users' => User::search($this->search)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(10)
        ]);
    }

    public function viewUserDetails($userId)
{
  $this->emitTo('admin.user-details-modal', 'showUserDetails', $userId);
}

}
