<?php

namespace App\Http\Controllers;

use App\Repositories\CustomerRepository;
use http\Env\Response;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerRepository;
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }
    public function index()
    {
        //        dd(12);
        $customer = $this->customerRepository->getAllCustomer();
        //        dd('return');
        return response()->json($customer);
    }
    public function findCustomer(Request $request)
    {
        $id = $request->input('id');
        if ($id) {
            $customer = $this->customerRepository->findCustomer($id);
            return response()->json($customer);
        }
        return response()->json(['message' => 'customer not found'], 404);
    }
    // public function store(Request $request)
    // {
    //     $id = $request->input('id');
    //     $name = $request->input('name');
    //     $phone = $request->input('phone');
    //     $email = $request->input('email');
    //     $address = $request->input('address');

    //     $data = [
    //         'name' => $name,
    //         'phone' => $phone,
    //         'email' => $email,
    //         'address' => $address
    //     ];
    //     if ($id) {
    //         $customer = $this->customerRepository->update($id, $data);
    //         return response()->json(['message' => 'update successfully', 'customer' => $customer], 201);
    //         goto next;
    //     }
    //     $customer = $this->customerRepository->create($data);
    //     next:
    //     return response()->json($customer, 201);
    // }
    public function edit($id)
    {
        $customer = $this->customerRepository->find($id);
        return response()->json($customer);
    }
    public function deleted($id)
    {
        $customer = $this->customerRepository->find($id);

        if ($customer) {
            $result = $this->customerRepository->delete($id);
            return response()->json(['message' => 'Xóa thành công'], 201);
        }

        return response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
    }

    public function createCustomer(Request $request)
    {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $address = $request->input('address');

        $data = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address
        ];

        $customer = $this->customerRepository->create($data);

        return response()->json(['message' => 'Create successfully', 'customer' => $customer], 201);
    }

    public function updateCustomer (Request $request, $id) {
        $customer = $this->customerRepository->findCustomer($id);

        if(!$customer) {
            return response()->json(['message' => 'Khong tim thay customer']);
        }

        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $address = $request->input('address');

        $data = [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'address' => $address
        ];

        $updateCustomer = $this->customerRepository->update($id, $data);

        return response()->json(['message' => 'update successfully']);
    }
}
