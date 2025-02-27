<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the user's notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->get();
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

            // Find all the notifications
            $notifications = \App\Models\Notification::whereIn('id', $notification_ids)->get();
            
            foreach ($notifications as $notification) {
                // Get current viewed_by array or initialize an empty array
                $viewedBy = json_decode($notification->viewed_by ?? '[]', true);
                
                // Add user if not already in the array
                if (!in_array($user_id, $viewedBy)) {
                    $viewedBy[] = $user_id;
                    $notification->viewed_by = json_encode($viewedBy);
                    $notification->save();
                }
            }
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Illuminate\Support\Facades\Log::error('Error marking notifications as viewed: ' . $e->getMessage());
            \Illuminate\Support\Facades\Log::error($e->getTraceAsString());
            
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
            'type' => 'nullable|string|in:info,warning,danger',
        ]);

        $notification = Notification::create([
            'title' => $validated['title'],
            'message' => $validated['message'],
            'type' => $validated['type'] ?? 'info',
            'user_id' => Auth::id(), // Set the creator of the notification
        ]);

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
}