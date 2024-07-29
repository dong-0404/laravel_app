<?php
namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\EloquentRepository;

class CustomerRepository extends EloquentRepository
{
    public function getModel()
    {
        return Customer::class;
    }
    public function getAllCustomer()
    {
        return $this->_model->all();
    }
    public function findCustomer($id)
    {
        return $this->_model->find($id);
    }

    public function getAndDeletedById($id)
    {
        $customer = $this->find($id);
        if($customer){
            return $this->delete($id);
        }
    }
}
