@extends('shopkeeper.layout')

@section('title', 'Profile Settings')
@section('page-title', 'Profile Settings')
@section('page-subtitle', 'Manage your store information and preferences')

@section('content')
<form id="profile-form" enctype="multipart/form-data">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Store Information -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-5 border border-white/20 shadow-lg">
            <h3 class="text-white text-lg font-bold mb-3"><i class="fas fa-store mr-2 text-green-400"></i>Store Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Store Name *</label>
                    <input type="text" name="store_name" id="store_name" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary" placeholder="Enter store name" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Store Description</label>
                    <textarea name="store_description" id="store_description" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary h-24" placeholder="Describe your store"></textarea>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Phone Number</label>
                    <input type="tel" name="phone" id="phone" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary" placeholder="+91 9876543210">
                </div>
            </div>
        </div>
        
        <!-- Address Information -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-5 border border-white/20 shadow-lg">
            <h3 class="text-white text-lg font-bold mb-3"><i class="fas fa-map-marker-alt mr-2 text-blue-400"></i>Address Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Full Address</label>
                    <textarea name="address" id="address" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary h-20" placeholder="Enter complete address"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">City</label>
                        <input type="text" name="city" id="city" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary" placeholder="City">
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">State</label>
                        <input type="text" name="state" id="state" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary" placeholder="State">
                    </div>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Pincode</label>
                    <input type="text" name="pincode" id="pincode" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary" placeholder="123456">
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Delivery Settings -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-5 border border-white/20 shadow-lg">
            <h3 class="text-white text-lg font-bold mb-3"><i class="fas fa-truck mr-2 text-orange-400"></i>Delivery Settings</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Delivery Radius (km)</label>
                    <input type="number" name="delivery_radius" id="delivery_radius" min="1" max="50" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary" placeholder="5">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Delivery Fee (₹)</label>
                    <input type="number" name="delivery_fee" id="delivery_fee" min="0" max="1000" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary" placeholder="50">
                </div>
            </div>
        </div>
        
        <!-- Business Hours -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-5 border border-white/20 shadow-lg">
            <h3 class="text-white text-lg font-bold mb-3"><i class="fas fa-clock mr-2 text-purple-400"></i>Business Hours</h3>
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">Opening Time</label>
                        <input type="time" name="opening_time" id="opening_time" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-vsn-secondary" value="09:00">
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">Closing Time</label>
                        <input type="time" name="closing_time" id="closing_time" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-vsn-secondary" value="21:00">
                    </div>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Working Days</label>
                    <div class="grid grid-cols-4 gap-2">
                        <label class="flex items-center space-x-2 text-sm text-gray-300">
                            <input type="checkbox" name="working_days[]" value="monday" class="rounded bg-white/10 border-white/20 text-vsn-secondary focus:ring-vsn-secondary" checked>
                            <span>Mon</span>
                        </label>
                        <label class="flex items-center space-x-2 text-sm text-gray-300">
                            <input type="checkbox" name="working_days[]" value="tuesday" class="rounded bg-white/10 border-white/20 text-vsn-secondary focus:ring-vsn-secondary" checked>
                            <span>Tue</span>
                        </label>
                        <label class="flex items-center space-x-2 text-sm text-gray-300">
                            <input type="checkbox" name="working_days[]" value="wednesday" class="rounded bg-white/10 border-white/20 text-vsn-secondary focus:ring-vsn-secondary" checked>
                            <span>Wed</span>
                        </label>
                        <label class="flex items-center space-x-2 text-sm text-gray-300">
                            <input type="checkbox" name="working_days[]" value="thursday" class="rounded bg-white/10 border-white/20 text-vsn-secondary focus:ring-vsn-secondary" checked>
                            <span>Thu</span>
                        </label>
                        <label class="flex items-center space-x-2 text-sm text-gray-300">
                            <input type="checkbox" name="working_days[]" value="friday" class="rounded bg-white/10 border-white/20 text-vsn-secondary focus:ring-vsn-secondary" checked>
                            <span>Fri</span>
                        </label>
                        <label class="flex items-center space-x-2 text-sm text-gray-300">
                            <input type="checkbox" name="working_days[]" value="saturday" class="rounded bg-white/10 border-white/20 text-vsn-secondary focus:ring-vsn-secondary" checked>
                            <span>Sat</span>
                        </label>
                        <label class="flex items-center space-x-2 text-sm text-gray-300">
                            <input type="checkbox" name="working_days[]" value="sunday" class="rounded bg-white/10 border-white/20 text-vsn-secondary focus:ring-vsn-secondary" checked>
                            <span>Sun</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Notification Settings -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-5 border border-white/20 shadow-lg">
            <h3 class="text-white text-lg font-bold mb-3"><i class="fas fa-bell mr-2 text-yellow-400"></i>Notification Settings</h3>
            <div class="space-y-4">
                <label class="flex items-center space-x-3">
                    <input type="checkbox" name="notifications_enabled" id="notifications_enabled" class="rounded bg-white/10 border-white/20 text-vsn-secondary focus:ring-vsn-secondary" checked>
                    <span class="text-gray-300">Enable Notifications</span>
                </label>
                <label class="flex items-center space-x-3">
                    <input type="checkbox" name="email_notifications" id="email_notifications" class="rounded bg-white/10 border-white/20 text-vsn-secondary focus:ring-vsn-secondary" checked>
                    <span class="text-gray-300">Email Notifications</span>
                </label>
                <label class="flex items-center space-x-3">
                    <input type="checkbox" name="sms_notifications" id="sms_notifications" class="rounded bg-white/10 border-white/20 text-vsn-secondary focus:ring-vsn-secondary">
                    <span class="text-gray-300">SMS Notifications</span>
                </label>
            </div>
        </div>
        
        <!-- Store Images -->
        <div class="bg-white/10 backdrop-blur-lg rounded-xl p-5 border border-white/20 shadow-lg">
            <h3 class="text-white text-lg font-bold mb-3"><i class="fas fa-images mr-2 text-pink-400"></i>Store Images</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Store Logo</label>
                    <input type="file" name="store_logo" id="store_logo" accept="image/*" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-vsn-secondary">
                    <p class="text-gray-400 text-xs mt-1">Max size: 2MB (JPEG, PNG, JPG, GIF)</p>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-medium mb-2">Store Banner</label>
                    <input type="file" name="store_banner" id="store_banner" accept="image/*" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-vsn-secondary">
                    <p class="text-gray-400 text-xs mt-1">Max size: 2MB (JPEG, PNG, JPG, GIF)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div class="flex justify-center space-x-4 mt-6">
        <button type="button" id="edit-profile-btn" class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2">
            <i class="fas fa-edit"></i>
            <span>Edit Profile</span>
        </button>
        <button type="submit" id="save-profile-btn" class="bg-gradient-to-r from-vsn-secondary to-emerald-600 text-white px-8 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-2 hidden">
            <i class="fas fa-save"></i>
            <span>Save Profile Settings</span>
        </button>
    </div>
</form>

<script>
// Profile form functionality
document.addEventListener('DOMContentLoaded', function() {
    const editBtn = document.getElementById('edit-profile-btn');
    const saveBtn = document.getElementById('save-profile-btn');
    const form = document.getElementById('profile-form');
    const inputs = form.querySelectorAll('input, textarea, select');

    // Initially disable all inputs
    inputs.forEach(input => {
        input.disabled = true;
    });

    // Edit button functionality
    editBtn.addEventListener('click', function() {
        inputs.forEach(input => {
            input.disabled = false;
        });
        editBtn.classList.add('hidden');
        saveBtn.classList.remove('hidden');
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading state
        saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
        saveBtn.disabled = true;

        // Simulate API call
        setTimeout(() => {
            // Reset form state
            inputs.forEach(input => {
                input.disabled = true;
            });
            editBtn.classList.remove('hidden');
            saveBtn.classList.add('hidden');
            saveBtn.innerHTML = '<i class="fas fa-save"></i><span>Save Profile Settings</span>';
            saveBtn.disabled = false;

            // Show success message
            showNotification('Profile updated successfully!', 'success');
        }, 2000);
    });
});

// Notification function
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white font-medium z-50 transform transition-all duration-300 ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}
</script>
@endsection
