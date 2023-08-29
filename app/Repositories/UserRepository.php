<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\EloquentRepository;

class UserRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
    public function getAll()
    {
        return $this->_model->all();
    }
    public function Find($id)
    {
        return $this->_model->find($id);
    }
    public function filerUser($email, $name)
    {
        $query = $this->_model->select();
        if ($email) {
            $query->where(User::_EMAIL, 'like', '%' . $email . '%');
        }
        if ($name) {
            $query->where(User::_NAME, 'like', '%' . $name . '%');
        }
        return $query->get();
    }
}
