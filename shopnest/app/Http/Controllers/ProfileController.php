<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopkeeperProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            'store_name' => 'required|string|max:255',
            'store_description' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'pincode' => 'nullable|string|max:10',
            'delivery_radius' => 'nullable|numeric|min:1|max:50',
            'delivery_fee' => 'nullable|numeric|min:0|max:1000',
            'opening_time' => 'nullable|string',
            'closing_time' => 'nullable|string',
            'working_days' => 'nullable|array',
            'notifications_enabled' => 'nullable|in:0,1',
            'email_notifications' => 'nullable|in:0,1',
            'sms_notifications' => 'nullable|in:0,1',
            'store_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'store_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();
        $profile = $user->shopkeeperProfile ?? new ShopkeeperProfile(['user_id' => $user->id]);

        // Handle file uploads
        if ($request->hasFile('store_logo')) {
            if ($profile->store_logo) {
                Storage::disk('public')->delete($profile->store_logo);
            }
            $profile->store_logo = $request->file('store_logo')->store('store_logos', 'public');
        }

        if ($request->hasFile('store_banner')) {
            if ($profile->store_banner) {
                Storage::disk('public')->delete($profile->store_banner);
            }
            $profile->store_banner = $request->file('store_banner')->store('store_banners', 'public');
        }

        // Update profile data
        $profile->fill($request->except(['store_logo', 'store_banner']));
        $profile->working_days = $request->working_days ?? ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        
        // Convert boolean strings to actual booleans
        $profile->notifications_enabled = $request->notifications_enabled === '1';
        $profile->email_notifications = $request->email_notifications === '1';
        $profile->sms_notifications = $request->sms_notifications === '1';
        
        $profile->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
            'profile' => $profile
        ]);
    }

    public function getProfile()
    {
        $user = Auth::user();
        $profile = $user->shopkeeperProfile;

        if (!$profile) {
            $profile = ShopkeeperProfile::create([
                'user_id' => $user->id,
                'store_name' => $user->name . "'s Store",
            ]);
        }

        return response()->json([
            'success' => true,
            'profile' => $profile
        ]);
    }
}
