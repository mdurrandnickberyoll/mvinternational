<?php

namespace App\Http\Livewire;

use App\Models\UserRole;
use Livewire\Component;
use Livewire\WithPagination;

class ListUserRoles extends Component
{
    use WithPagination;

    public $src_val;
    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }
    public function render()
    {

        return view('livewire.list-user-roles', [
            'datas' => UserRole::join('roles', 'user_roles.role_id', '=', 'roles.id')
                ->select('user_roles.*', 'roles.libelle')
                ->where('user_roles.user_id',$this->user->id)
                ->where(function ($query) {
                    $query
                    ->where('roles.libelle', 'LIKE', "%{$this->src_val}%")
                    ->orwhere('roles.created_at', 'LIKE', "%{$this->src_val}%");
                })->paginate(10)
        ]);
    }
}
