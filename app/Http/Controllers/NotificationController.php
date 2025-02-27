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
        $user_id = $request->user_id;
        $notification_ids = $request->notification_ids;
        
        // Find all the notifications
        $notifications = Notification::whereIn('id', $notification_ids)->get();
        
        foreach ($notifications as $notification) {
            // Add current user to viewed_by if not already there
            if (is_null($notification->viewed_by)) {
                $notification->viewed_by = json_encode([$user_id]);
            } else {
                $viewed_by = json_decode($notification->viewed_by, true) ?: [];
                if (!in_array($user_id, $viewed_by)) {
                    $viewed_by[] = $user_id;
                    $notification->viewed_by = json_encode($viewed_by);
                }
            }
            
            // If this is the first time anyone has viewed it, set read_at
            if (is_null($notification->read_at)) {
                $notification->read_at = now();
            }
            
            $notification->save();
        }
        
        return response()->json(['success' => true]);
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