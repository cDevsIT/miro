<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
                    'phone' => $customer->phone,
                    'profession' => $customer->profession,
                    'address' => $customer->address,
                    'avatar' => $customer->avatar ? Storage::url($customer->avatar) : null,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error fetching customer data'
            ], 500);
        }
    }

    public function update(Request $request)
    {
        $customer = Auth::guard('customer')->user();
        if (!$customer) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $data = $request->validate([
            'first_name' => 'nullable|string|max:100',
            'last_name' => 'nullable|string|max:100',
            'profession' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:500',
            'avatar' => 'nullable|image|max:2048',
        ]);

        // Merge first/last into name if provided
        if (!empty($data['first_name']) || !empty($data['last_name'])) {
            $first = $data['first_name'] ?? '';
            $last = $data['last_name'] ?? '';
            $customer->name = trim($first . ' ' . $last) ?: $customer->name;
        }

        if (isset($data['profession'])) $customer->profession = $data['profession'];
        if (isset($data['phone'])) $customer->phone = $data['phone'];
        if (isset($data['email'])) $customer->email = $data['email'];
        if (isset($data['address'])) $customer->address = $data['address'];

        if ($request->hasFile('avatar')) {
            // delete old
            if ($customer->avatar) {
                Storage::disk('public')->delete($customer->avatar);
            }
            $path = $request->file('avatar')->store('customers/avatars', 'public');
            $customer->avatar = $path;
        }

        $customer->save();

        return response()->json(['message' => 'Profile updated', 'customer' => $customer]);
    }
} 