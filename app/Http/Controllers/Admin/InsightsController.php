<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Appointment;
use App\Models\Quote;
use App\Models\Customer;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InsightsController extends Controller
{
    /**
     * Display the insights dashboard
     */
    public function index(Request $request)
    {
        // Date range filter
        $dateFrom = $request->input('date_from', Carbon::now()->subDays(30)->format('Y-m-d'));
        $dateTo = $request->input('date_to', Carbon::now()->format('Y-m-d'));

        // Statistics
        $stats = [
            'total_customers' => Customer::count(),
            'total_messages' => Message::count(),
            'unread_messages' => Message::where('read_status', 0)->count(),
            'total_appointments' => Appointment::count(),
            'pending_appointments' => Appointment::where('date', '>=', Carbon::today())->count(),
            'total_quotes' => Quote::count(),
            'pending_quotes' => Quote::where('status', 'pending')->count(),
        ];

        // Recent activity with date range
        $recentMessages = Message::with('customer')
            ->whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $recentAppointments = Appointment::with('customer')
            ->whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $recentQuotes = Quote::with(['customer', 'items'])
            ->whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Chart data - Last 7 days
        $chartData = $this->getChartData();

        return view('admin.insights', compact(
            'stats',
            'recentMessages',
            'recentAppointments',
            'recentQuotes',
            'chartData',
            'dateFrom',
            'dateTo'
        ));
    }

    /**
     * Get chart data for the last 7 days
     */
    private function getChartData()
    {
        $days = [];
        $messagesData = [];
        $appointmentsData = [];
        $quotesData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $days[] = $date->format('M d');

            $dateStr = $date->format('Y-m-d');
            $messagesData[] = Message::whereBetween('created_at', [$dateStr . ' 00:00:00', $dateStr . ' 23:59:59'])->count();
            $appointmentsData[] = Appointment::whereBetween('created_at', [$dateStr . ' 00:00:00', $dateStr . ' 23:59:59'])->count();
            $quotesData[] = Quote::whereBetween('created_at', [$dateStr . ' 00:00:00', $dateStr . ' 23:59:59'])->count();
        }

        return [
            'labels' => $days,
            'messages' => $messagesData,
            'appointments' => $appointmentsData,
            'quotes' => $quotesData,
        ];
    }

    /**
     * Show message details
     */
    public function showMessage($id)
    {
        $message = Message::with('customer')->findOrFail($id);
        return view('admin.insights.message', compact('message'));
    }

    /**
     * Show appointment details
     */
    public function showAppointment($id)
    {
        $appointment = Appointment::with('customer')->findOrFail($id);
        return view('admin.insights.appointment', compact('appointment'));
    }

    /**
     * Update appointment (reschedule or add notes)
     */
    public function updateAppointment(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $validated = $request->validate([
            'date' => 'nullable|date',
            'time' => 'nullable',
            'admin_notes' => 'nullable|string',
            'status' => 'nullable|in:pending,confirmed,completed,cancelled',
        ]);

        $appointment->update($validated);

        return redirect()->route('admin.insights.appointment', $id)
            ->with('success', 'Appointment updated successfully');
    }

    /**
     * Show quote details
     */
    public function showQuote($id)
    {
        $quote = Quote::with(['customer', 'items.product'])->findOrFail($id);
        return view('admin.insights.quote', compact('quote'));
    }

    /**
     * List all messages
     */
    public function listMessages(Request $request)
    {
        $query = Message::with('customer')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('subject', 'like', '%' . $request->search . '%')
                  ->orWhere('message', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('read_status', $request->status);
        }

        $messages = $query->paginate(20);
        return view('admin.insights.messages', compact('messages'));
    }

    /**
     * List all appointments
     */
    public function listAppointments(Request $request)
    {
        $query = Appointment::with('customer')->orderBy('date', 'desc');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }

        $appointments = $query->paginate(20);
        return view('admin.insights.appointments', compact('appointments'));
    }

    /**
     * List all quotes
     */
    public function listQuotes(Request $request)
    {
        $query = Quote::with(['customer', 'items'])->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $query->where('code', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $quotes = $query->paginate(20);
        return view('admin.insights.quotes', compact('quotes'));
    }

    /**
     * Reply to message
     */
    public function replyToMessage(Request $request, $id)
    {
        $message = Message::findOrFail($id);

        $validated = $request->validate([
            'admin_reply' => 'required|string',
        ]);

        $message->update([
            'admin_reply' => $validated['admin_reply'],
            'replied_at' => now(),
            'read_status' => 1, // Mark as read when replying
        ]);

        return redirect()->route('admin.insights.message', $id)
            ->with('success', 'Reply sent successfully');
    }

    /**
     * Mark message as read
     */
    public function markMessageAsRead($id)
    {
        $message = Message::findOrFail($id);
        $message->update(['read_status' => 1]);

        return redirect()->route('admin.insights.message', $id)
            ->with('success', 'Message marked as read');
    }
}
