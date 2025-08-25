<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function getCustomerData()
    {
        try {
            $customer = Auth::guard('customer')->user();
            
            if (!$customer) {
                return response()->json([
                    'error' => 'Customer not found'
                ], 404);
            }

            return response()->json([
                'customer' => [
                    'name' => $customer->name,
                    'email' => $customer->email,
                    'phone' => $customer->phone
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching customer data'
            ], 500);
        }
    }
} 