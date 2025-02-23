<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Celebrant;
use Livewire\WithPagination;

class CelebrantsList extends Component
{
    use WithPagination;

    public $search = '';
    public $filterType = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortField === $field 
            ? $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc'
            : 'asc';
            
        $this->sortField = $field;
    }

    public function render()
    {
        $celebrants = auth()->user()->celebrants()
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            })
            ->when($this->filterType, function($query) {
                if($this->filterType === 'birthday') {
                    $query->whereNotNull('birthday');
                } elseif($this->filterType === 'wedding') {
                    $query->whereNotNull('wedding');
                }
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(10);

        return view('livewire.celebrants-list', [
            'celebrants' => $celebrants
        ]);
    }
}
