<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    /**
     * Display a listing of the user's notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = $user->notifications()
            ->orderBy('notifications.created_at', 'desc')
            ->get();
            
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark a single notification as read.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        $notification->read_at = now();
        $notification->save();

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAllAsRead(Request $request)
    {
        $notification_ids = $request->notification_ids;
        
        Notification::whereIn('id', $notification_ids)
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    /**
     * Mark notifications as viewed by a specific user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function markViewedByUser(Request $request)
    {
        try {
            $user_id = $request->input('user_id');
            $notification_ids = $request->input('notification_ids', []);
            
            if (empty($notification_ids)) {
                return response()->json(['success' => false, 'message' => 'No notification IDs provided'], 400);
            }

            // Update the pivot table with viewed_at timestamp
            Auth::user()->notifications()
                ->whereIn('notifications.id', $notification_ids)
                ->wherePivotNull('viewed_at')
                ->update(['notification_user.viewed_at' => now()]);
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Error marking notifications as viewed: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return response()->json(['success' => false, 'message' => 'Server error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Create a new notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'nullable|string|in:warning,danger,success,deleted',
        ]);

        $notification = Notification::create([
            'title' => $validated['title'],
            'message' => $validated['message'],
            'type' => $validated['type'] ?? 'success',
            'reference_id' => $request->reference_id
        ]);

        // Attach the notification to specified users or all users
        $userIds = $request->input('user_ids', [Auth::id()]);
        $notification->users()->attach($userIds);

        return redirect()->back()->with('success', 'Notification created successfully');
    }

    /**
     * Delete a notification.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        
        return redirect()->back()->with('success', 'Notification deleted successfully');
    }

    /**
     * Clear all notifications for the current user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function clearAll(Request $request)
    {
        try {
            $user = Auth::user();
            
            // Delete all entries from notification_user table for the current user
            DB::table('notification_user')
                ->where('user_id', $user->id)
                ->delete();
                
            return response()->json([
                'success' => true,
                'message' => 'All notifications cleared successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error clearing notifications: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error clearing notifications'
            ], 500);
        }
    }

    /**
     * Get notifications for the current user.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotifications()
    {
        $user = Auth::user();
        
        // Get notifications with pivot data
        $notifications = $user->notifications()
            ->withPivot('viewed_at')
            ->orderBy('notifications.created_at', 'desc')
            ->get();
        
        return view('components.navbar', compact('notifications'));
    }

    public function markAsViewed(Request $request)
    {
        try {
            $user = Auth::user();
            $notificationIds = $request->input('notification_ids', []);

            // Update through the pivot table
            foreach ($notificationIds as $notificationId) {
                DB::table('notification_user')
                    ->where('user_id', $user->id)
                    ->where('notification_id', $notificationId)
                    ->whereNull('viewed_at')
                    ->update(['viewed_at' => now()]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error marking notifications as viewed: ' . $e->getMessage());
            return response()->json([
                'success' => false, 
                'message' => 'Error updating notifications'
            ], 500);
        }
    }
}