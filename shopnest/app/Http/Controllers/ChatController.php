<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getChatsForShopkeeper()
    {
        $shopkeeperId = Auth::id();
        
        // Get customers who have ordered from this shopkeeper
        $customers = User::whereHas('orders', function($query) use ($shopkeeperId) {
            $query->where('shopkeeper_id', $shopkeeperId);
        })->with(['orders' => function($query) use ($shopkeeperId) {
            $query->where('shopkeeper_id', $shopkeeperId)->latest()->take(1);
        }])->get();

        $chats = [];
        foreach ($customers as $customer) {
            // Get latest chat message
            $latestChat = Chat::where('customer_id', $customer->id)
                ->where('shopkeeper_id', $shopkeeperId)
                ->latest()
                ->first();

            // Get unread count
            $unreadCount = Chat::where('customer_id', $customer->id)
                ->where('shopkeeper_id', $shopkeeperId)
                ->where('sender_type', 'customer')
                ->where('is_read', false)
                ->count();

            $chats[] = [
                'customer_id' => $customer->id,
                'customer_name' => $customer->name,
                'customer_email' => $customer->email,
                'last_message' => $latestChat ? $latestChat->message : 'No messages yet',
                'last_message_time' => $latestChat ? $latestChat->created_at->diffForHumans() : '',
                'unread_count' => $unreadCount,
                'avatar' => strtoupper(substr($customer->name, 0, 1) . (strpos($customer->name, ' ') ? substr($customer->name, strpos($customer->name, ' ') + 1, 1) : ''))
            ];
        }

        return response()->json($chats);
    }

    public function getConversation($customerId)
    {
        $shopkeeperId = Auth::id();
        
        $messages = Chat::getConversation($customerId, $shopkeeperId);
        
        // Mark messages as read
        Chat::where('customer_id', $customerId)
            ->where('shopkeeper_id', $shopkeeperId)
            ->where('sender_type', 'customer')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000',
            'product_id' => 'nullable|exists:products,id'
        ]);

        $chat = Chat::create([
            'customer_id' => $request->customer_id,
            'shopkeeper_id' => Auth::id(),
            'product_id' => $request->product_id,
            'message' => $request->message,
            'sender_type' => 'shopkeeper',
            'is_read' => false
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Message sent successfully',
            'chat' => $chat->load(['customer', 'shopkeeper', 'product'])
        ]);
    }

    public function sendMessageFromCustomer(Request $request)
    {
        try {
            $request->validate([
                'shopkeeper_id' => 'required|exists:users,id',
                'message' => 'required|string|max:1000',
                'product_id' => 'nullable|exists:products,id'
            ]);

            $chat = Chat::create([
                'customer_id' => Auth::id(),
                'shopkeeper_id' => $request->shopkeeper_id,
                'product_id' => $request->product_id,
                'message' => trim($request->message),
                'sender_type' => 'customer',
                'is_read' => false
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully',
                'chat' => [
                    'id' => $chat->id,
                    'message' => $chat->message,
                    'created_at' => $chat->created_at->format('Y-m-d H:i:s'),
                    'sender_type' => $chat->sender_type
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send message: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getUnreadCount()
    {
        $shopkeeperId = Auth::id();
        $count = Chat::getUnreadCountForShopkeeper($shopkeeperId);
        
        return response()->json(['count' => $count]);
    }
}
