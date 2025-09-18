<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Log the incoming request data
            Log::info('Appointment request data:', $request->all());

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone' => 'required|string',
                'date' => 'required|date',
                'time' => 'required|date_format:H:i',
                'remarks' => 'nullable|string',
                'status' => 'nullable|in:pending,scheduled,complete'
            ]);

            // Get the authenticated customer
            $customer = auth()->guard('customer')->user();
            
            if (!$customer) {
                throw new \Exception('Customer not authenticated');
            }

            // Create the appointment
            $appointment = Appointment::create([
                'customer_id' => $customer->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'date' => $validated['date'],
                'time' => $validated['time'],
                'remarks' => $validated['remarks'] ?? null,
                'status' => $validated['status'] ?? 'pending',
            ]);

            // Log successful creation
            Log::info('Appointment created:', ['appointment_id' => $appointment->id]);

            return response()->json([
                'success' => true,
                'message' => 'Appointment booked successfully',
                'appointment' => $appointment
            ]);

        } catch (\Exception $e) {
            // Log the error
            Log::error('Appointment booking error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to book appointment: ' . $e->getMessage()
            ], 422);
        }
    }

    public function index()
    {
        try {
            $customer = auth()->guard('customer')->user();
            $appointments = Appointment::where('customer_id', $customer->id)
                ->orderBy('date', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'appointments' => $appointments
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch appointments'
            ], 500);
        }
    }
} 