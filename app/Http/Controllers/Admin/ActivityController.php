<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ActivityController extends Controller
{
    /**
     * Display a listing of activities
     */
    public function index(Request $request)
    {
        $query = Activity::with('user')->orderBy('created_at', 'desc');

        // Filter by action
        if ($request->filled('action') && $request->action !== 'all') {
            $query->where('action', $request->action);
        }

        // Filter by model type
        if ($request->filled('model_type') && $request->model_type !== 'all') {
            $query->where('model_type', $request->model_type);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by description
        if ($request->filled('search')) {
            $query->where('description', 'like', '%' . $request->search . '%');
        }

        // Paginate results
        $activities = $query->paginate(50)->withQueryString();

        // Get unique model types for filter
        $modelTypes = Activity::select('model_type')
            ->distinct()
            ->whereNotNull('model_type')
            ->pluck('model_type')
            ->sort();

        // Get available actions
        $actions = ['created', 'updated', 'deleted', 'logged_in', 'logged_out'];

        // Get statistics
        $stats = [
            'today' => Activity::whereDate('created_at', Carbon::today())->count(),
            'this_week' => Activity::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
            'this_month' => Activity::whereMonth('created_at', Carbon::now()->month)->count(),
            'total' => Activity::count(),
        ];

        return view('admin.activity', compact('activities', 'modelTypes', 'actions', 'stats'));
    }

    /**
     * Clear old activities
     */
    public function clear(Request $request)
    {
        $days = $request->input('days', 30);
        
        $deleted = Activity::where('created_at', '<', Carbon::now()->subDays($days))->delete();

        return redirect()->route('admin.activity.index')
            ->with('success', "Deleted {$deleted} activities older than {$days} days.");
    }

    /**
     * Delete a specific activity
     */
    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return redirect()->route('admin.activity.index')
            ->with('success', 'Activity deleted successfully.');
    }
}
