<?php
namespace App\Repositories\User;
use App\Models\User;
use DB;

class UserRepository{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function all()
    {
        return $this->user;

    }

    public function findById($userId): object
    {
        return $this->user->where('users.id',$userId);
    }


    function store($data)
    {
        return $this->user->create($data);
    }





}
