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
    public function test()
    {
        return $this->_model->getAll()->get();
    }
    public function Find($id)
    {
        return $this->_model->find($id);
    }
}
