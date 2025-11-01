<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Message;
use App\Models\Appointment;
use App\Models\Quote;
use App\Models\Activity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard
     */
    public function index()
    {
        // Key Statistics
        $stats = [
            'total_products' => Product::where('is_active', 1)->count(),
            'total_categories' => Category::count(),
            'total_customers' => Customer::count(),
            'total_users' => User::count(),
            'unread_messages' => Message::where('read_status', 0)->count(),
            'upcoming_appointments' => Appointment::where('date', '>=', Carbon::today())->count(),
            'pending_quotes' => Quote::where('status', 'pending')->count(),
            'total_activities' => Activity::count(),
        ];

        // Today's Activity
        $todayStats = [
            'new_customers' => Customer::whereDate('created_at', Carbon::today())->count(),
            'new_messages' => Message::whereDate('created_at', Carbon::today())->count(),
            'new_appointments' => Appointment::whereDate('created_at', Carbon::today())->count(),
            'new_quotes' => Quote::whereDate('created_at', Carbon::today())->count(),
        ];

        // Recent Activities (Last 10)
        $recentActivities = Activity::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Recent Messages (Last 5)
        $recentMessages = Message::with('customer')
            ->where('read_status', 0)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Upcoming Appointments (Next 5)
        $upcomingAppointments = Appointment::with('customer')
            ->where('date', '>=', Carbon::today())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->limit(5)
            ->get();

        // Chart Data - Last 7 days
        $chartData = $this->getChartData();

        return view('admin.dashboard', compact(
            'stats',
            'todayStats',
            'recentActivities',
            'recentMessages',
            'upcomingAppointments',
            'chartData'
        ));
    }

    /**
     * Get chart data for the last 7 days
     */
    private function getChartData()
    {
        $days = [];
        $customersData = [];
        $messagesData = [];
        $appointmentsData = [];
        $quotesData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $days[] = $date->format('M d');
            $dateStr = $date->format('Y-m-d');

            $customersData[] = Customer::whereBetween('created_at', [$dateStr . ' 00:00:00', $dateStr . ' 23:59:59'])->count();
            $messagesData[] = Message::whereBetween('created_at', [$dateStr . ' 00:00:00', $dateStr . ' 23:59:59'])->count();
            $appointmentsData[] = Appointment::whereBetween('created_at', [$dateStr . ' 00:00:00', $dateStr . ' 23:59:59'])->count();
            $quotesData[] = Quote::whereBetween('created_at', [$dateStr . ' 00:00:00', $dateStr . ' 23:59:59'])->count();
        }

        return [
            'labels' => $days,
            'customers' => $customersData,
            'messages' => $messagesData,
            'appointments' => $appointmentsData,
            'quotes' => $quotesData,
        ];
    }
}
