<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends EloquentRepository
{
    /**
     * get model
     * @return string
     */
    public function getModel(): string
    {
        return User::class;
    }

    /**
     * Get 5 posts hot in a month the last
     * @return mixed
     */
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
    public function updatePassword(User $user, $newPassword)
    {
        $user->password = bcrypt($newPassword);
//        return $this->_model->update($user,$newPassword);
        $user->save();
    }

}
