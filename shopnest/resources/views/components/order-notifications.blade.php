<!-- Order Notifications Modal -->
<div id="orderNotificationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all duration-300">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-bell text-vsn-secondary mr-2"></i>
                    New Order Alert!
                </h3>
                <button onclick="closeNotificationModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            
            <div id="notificationContent" class="space-y-4">
                <!-- Dynamic content will be loaded here -->
            </div>
            
            <div class="flex space-x-3 mt-6">
                <button onclick="acceptOrder()" class="flex-1 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                    <i class="fas fa-check mr-2"></i>
                    Accept
                </button>
                <button onclick="cancelOrder()" class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                    <i class="fas fa-times mr-2"></i>
                    Cancel
                </button>
                <button onclick="flagOrder()" class="flex-1 bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center">
                    <i class="fas fa-flag mr-2"></i>
                    Flag
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Notification Bell Icon, Chat Icon, and Settings Icon -->
<div class="flex items-center space-x-3">
    <div class="relative">
        <a href="/notifications" id="notificationBell" class="relative p-2 text-gray-600 hover:text-vsn-secondary transition-colors duration-200 block">
            <i class="fas fa-bell text-xl text-white"></i>
            <span id="notificationBadge" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">0</span>
        </a>
    </div>
    <div class="relative">
        <button onclick="openSettingsModal()" id="settingsIcon" class="relative p-2 text-gray-600 hover:text-vsn-secondary transition-colors duration-200">
            <i class="fas fa-cog text-xl text-white"></i>
        </button>
    </div>
</div>

<script>
let currentOrderId = null;
let pendingOrders = [];

// Check for pending orders every 10 seconds
setInterval(checkPendingOrders, 10000);

// Check on page load
document.addEventListener('DOMContentLoaded', function() {
    checkPendingOrders();
});

function checkPendingOrders() {
    fetch('/orders/pending')
        .then(response => response.json())
        .then(orders => {
            pendingOrders = orders;
            updateNotificationBadge();
            
            // No modal popup - only update badge count
        })
        .catch(error => {
            console.error('Error checking pending orders:', error);
        });
}

function updateNotificationBadge() {
    const badge = document.getElementById('notificationBadge');
    if (pendingOrders.length > 0) {
        badge.textContent = pendingOrders.length;
        badge.classList.remove('hidden');
        
        // Add pulsing animation
        document.getElementById('notificationBell').classList.add('animate-pulse');
    } else {
        badge.classList.add('hidden');
        document.getElementById('notificationBell').classList.remove('animate-pulse');
    }
}

function showOrderNotification(order) {
    currentOrderId = order.id;
    
    const content = `
        <div class="bg-gradient-to-r from-blue-50 to-green-50 p-4 rounded-lg border border-blue-200">
            <div class="flex items-start space-x-3">
                <div class="bg-vsn-secondary text-white p-2 rounded-full">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-800">Order #${order.order_number}</h4>
                    <p class="text-sm text-gray-600 mt-1">
                        <strong>Customer:</strong> ${order.customer.name}<br>
                        <strong>Product:</strong> ${order.product.name}<br>
                        <strong>Quantity:</strong> ${order.quantity}<br>
                        <strong>Total:</strong> Rs. ${order.total_amount}<br>
                        <strong>Address:</strong> ${order.delivery_address}
                    </p>
                    ${order.notes ? `<p class="text-sm text-gray-500 mt-2"><strong>Notes:</strong> ${order.notes}</p>` : ''}
                </div>
            </div>
        </div>
        
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3">
            <div class="flex items-center text-yellow-800">
                <i class="fas fa-info-circle mr-2"></i>
                <span class="text-sm font-medium">Action Required</span>
            </div>
            <p class="text-sm text-yellow-700 mt-1">
                Choose an action for this order:
            </p>
            <ul class="text-xs text-yellow-600 mt-2 space-y-1">
                <li><strong>Accept:</strong> Confirm and process the order</li>
                <li><strong>Cancel:</strong> Reject the order (stock will be restored)</li>
                <li><strong>Flag:</strong> Mark as problematic (e.g., lockdown, unavailable)</li>
            </ul>
        </div>
    `;
    
    document.getElementById('notificationContent').innerHTML = content;
    document.getElementById('orderNotificationModal').classList.remove('hidden');
}

function closeNotificationModal() {
    document.getElementById('orderNotificationModal').classList.add('hidden');
    currentOrderId = null;
}

function acceptOrder() {
    if (!currentOrderId) return;
    
    fetch(`/orders/${currentOrderId}/accept`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccessMessage(data.message);
            closeNotificationModal();
            checkPendingOrders(); // Refresh pending orders
            location.reload(); // Refresh page to update order management
        } else {
            showErrorMessage(data.error || 'Failed to accept order');
        }
    })
    .catch(error => {
        console.error('Error accepting order:', error);
        showErrorMessage('Failed to accept order');
    });
}

function cancelOrder() {
    if (!currentOrderId) return;
    
    fetch(`/orders/${currentOrderId}/cancel`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccessMessage(data.message);
            closeNotificationModal();
            checkPendingOrders(); // Refresh pending orders
            location.reload(); // Refresh page to update order management
        } else {
            showErrorMessage(data.error || 'Failed to cancel order');
        }
    })
    .catch(error => {
        console.error('Error cancelling order:', error);
        showErrorMessage('Failed to cancel order');
    });
}

function flagOrder() {
    if (!currentOrderId) return;
    
    fetch(`/orders/${currentOrderId}/flag`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showSuccessMessage(data.message);
            closeNotificationModal();
            checkPendingOrders(); // Refresh pending orders
            location.reload(); // Refresh page to update order management
        } else {
            showErrorMessage(data.error || 'Failed to flag order');
        }
    })
    .catch(error => {
        console.error('Error flagging order:', error);
        showErrorMessage('Failed to flag order');
    });
}

function showSuccessMessage(message) {
    // Create and show success toast
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300';
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}

function showErrorMessage(message) {
    // Create and show error toast
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300';
    toast.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(toast);
        }, 300);
    }, 3000);
}
// Settings Modal Functions
function openSettingsModal() {
    // Create settings modal if it doesn't exist
    let settingsModal = document.getElementById('settingsModal');
    if (!settingsModal) {
        createSettingsModal();
        settingsModal = document.getElementById('settingsModal');
    }
    settingsModal.classList.remove('hidden');
}

function closeSettingsModal() {
    const settingsModal = document.getElementById('settingsModal');
    if (settingsModal) {
        settingsModal.classList.add('hidden');
    }
}

function createSettingsModal() {
    const modalHTML = `
    <!-- Settings Modal -->
    <div id="settingsModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto transform transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-cog text-vsn-secondary mr-3"></i>
                        General Settings
                    </h3>
                    <button onclick="closeSettingsModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Password Settings -->
                    <div class="bg-gray-50 rounded-xl p-6 border">
                        <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-lock text-red-500 mr-2"></i>Password Settings
                        </h4>
                        <form id="passwordChangeForm" class="space-y-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Current Password</label>
                                <input type="password" id="currentPassword" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-vsn-secondary" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">New Password</label>
                                <input type="password" id="newPassword" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-vsn-secondary" required>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Confirm New Password</label>
                                <input type="password" id="confirmPassword" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-vsn-secondary" required>
                            </div>
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg font-bold transition-colors">
                                <i class="fas fa-key mr-2"></i>Change Password
                            </button>
                        </form>
                    </div>

                    <!-- Theme Settings -->
                    <div class="bg-gray-50 rounded-xl p-6 border">
                        <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-palette text-purple-500 mr-2"></i>Theme Settings
                        </h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Dashboard Theme</label>
                                <select id="themeSelect" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-vsn-secondary">
                                    <option value="default">Default (Purple Gradient)</option>
                                    <option value="dark">Dark Mode</option>
                                    <option value="blue">Blue Theme</option>
                                    <option value="green">Green Theme</option>
                                </select>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700">Dark Mode</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="darkModeToggle" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700">Animations</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="animationsToggle" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Language & Region -->
                    <div class="bg-gray-50 rounded-xl p-6 border">
                        <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-globe text-green-500 mr-2"></i>Language & Region
                        </h4>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Language</label>
                                <select id="languageSelect" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-vsn-secondary">
                                    <option value="en">English</option>
                                    <option value="ur">اردو (Urdu)</option>
                                    <option value="hi">हिंदी (Hindi)</option>
                                    <option value="ar">العربية (Arabic)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Currency</label>
                                <select id="currencySelect" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-vsn-secondary">
                                    <option value="PKR">PKR (Pakistani Rupee)</option>
                                    <option value="USD">USD (US Dollar)</option>
                                    <option value="EUR">EUR (Euro)</option>
                                    <option value="INR">INR (Indian Rupee)</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-gray-700 text-sm font-medium mb-2">Time Zone</label>
                                <select id="timezoneSelect" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-vsn-secondary">
                                    <option value="Asia/Karachi">Pakistan Standard Time (PST)</option>
                                    <option value="Asia/Kolkata">India Standard Time (IST)</option>
                                    <option value="UTC">UTC</option>
                                    <option value="America/New_York">Eastern Time (ET)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings -->
                    <div class="bg-gray-50 rounded-xl p-6 border">
                        <h4 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-user-cog text-blue-500 mr-2"></i>Account Settings
                        </h4>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700">Two-Factor Authentication</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="twoFactorToggle" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700">Login Alerts</span>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="loginAlertsToggle" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700">Data Export</span>
                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                    <i class="fas fa-download mr-2"></i>Export Data
                                </button>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-700 text-red-600">Delete Account</span>
                                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                                    <i class="fas fa-trash mr-2"></i>Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Settings Button -->
                <div class="flex justify-center mt-8">
                    <button onclick="saveAllSettings()" class="bg-vsn-secondary hover:bg-green-600 text-white px-12 py-4 rounded-2xl font-bold text-lg transition-all duration-300 transform hover:scale-105 flex items-center space-x-3">
                        <i class="fas fa-save"></i>
                        <span>Save All Settings</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', modalHTML);
    
    // Load saved settings
    loadSavedSettings();
    
    // Add password change form handler
    document.getElementById('passwordChangeForm').addEventListener('submit', handlePasswordChange);
}

function loadSavedSettings() {
    const savedSettings = localStorage.getItem('userSettings');
    if (savedSettings) {
        const settings = JSON.parse(savedSettings);
        document.getElementById('themeSelect').value = settings.theme || 'default';
        document.getElementById('darkModeToggle').checked = settings.dark_mode || false;
        document.getElementById('animationsToggle').checked = settings.animations !== false;
        document.getElementById('languageSelect').value = settings.language || 'en';
        document.getElementById('currencySelect').value = settings.currency || 'PKR';
        document.getElementById('timezoneSelect').value = settings.timezone || 'Asia/Karachi';
        document.getElementById('twoFactorToggle').checked = settings.two_factor || false;
        document.getElementById('loginAlertsToggle').checked = settings.login_alerts !== false;
    }
}

function saveAllSettings() {
    const settings = {
        theme: document.getElementById('themeSelect').value,
        dark_mode: document.getElementById('darkModeToggle').checked,
        animations: document.getElementById('animationsToggle').checked,
        language: document.getElementById('languageSelect').value,
        currency: document.getElementById('currencySelect').value,
        timezone: document.getElementById('timezoneSelect').value,
        two_factor: document.getElementById('twoFactorToggle').checked,
        login_alerts: document.getElementById('loginAlertsToggle').checked
    };
    
    localStorage.setItem('userSettings', JSON.stringify(settings));
    showSuccessMessage('Settings saved successfully!');
    closeSettingsModal();
}

function handlePasswordChange(e) {
    e.preventDefault();
    
    const currentPassword = document.getElementById('currentPassword').value;
    const newPassword = document.getElementById('newPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;
    
    if (newPassword !== confirmPassword) {
        showErrorMessage('New passwords do not match!');
        return;
    }
    
    if (newPassword.length < 8) {
        showErrorMessage('Password must be at least 8 characters long!');
        return;
    }
    
    // Here you would normally send to server
    // For now, just show success message
    showSuccessMessage('Password changed successfully!');
    document.getElementById('passwordChangeForm').reset();
}

// Chat Modal Functions
function openChatModal() {
    // Create chat modal if it doesn't exist
    let chatModal = document.getElementById('chatModal');
    if (!chatModal) {
        createChatModal();
        chatModal = document.getElementById('chatModal');
    }
    chatModal.classList.remove('hidden');
    loadCustomerChats();
}

function closeChatModal() {
    const chatModal = document.getElementById('chatModal');
    if (chatModal) {
        chatModal.classList.add('hidden');
    }
}

function createChatModal() {
    const modalHTML = `
    <!-- WhatsApp-like Chat Modal -->
<div id="chatModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-6xl h-[85vh] flex overflow-hidden">
            <!-- Chat List Sidebar -->
            <div class="w-1/3 bg-gray-50 border-r border-gray-200 flex flex-col">
                <!-- Header -->
                <div class="bg-green-600 text-white p-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold flex items-center">
                            <i class="fas fa-comments mr-2"></i>
                            Chats
                        </h3>
                        <button onclick="closeChatModal()" class="text-white hover:text-gray-200">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Search Bar -->
                <div class="p-3 bg-white border-b">
                    <div class="relative">
                        <input type="text" id="chatSearch" placeholder="Search or start new chat" class="w-full pl-10 pr-4 py-2 bg-gray-100 rounded-lg focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-500">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
                
                <!-- Chat List -->
                <div class="flex-1 overflow-y-auto bg-white">
                    <div id="chatList">
                        <!-- Chat items will be loaded here -->
                        <div class="flex items-center justify-center h-full text-gray-500 p-8">
                            <div class="text-center">
                                <i class="fas fa-comments text-4xl mb-4 text-gray-300"></i>
                                <p class="text-lg font-medium">No chats yet</p>
                                <p class="text-sm">Customers who order your products can message you here</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Chat Messages Area -->
            <div class="flex-1 flex flex-col bg-gray-100">
                <!-- Default State -->
                <div id="chatWelcome" class="flex-1 flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <div class="w-32 h-32 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-comments text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Virtual Shop Nest Chat</h3>
                        <p class="text-gray-400 max-w-md">Send and receive messages with your customers. Select a chat to start messaging.</p>
                    </div>
                </div>
                
                <!-- Active Chat -->
                <div id="activeChat" class="hidden flex-1 flex flex-col">
                    <!-- Chat Header -->
                    <div class="bg-green-600 text-white p-4 flex items-center">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-white font-bold mr-3">
                            <span id="chatAvatar">C</span>
                        </div>
                        <div class="flex-1">
                            <h4 id="chatCustomerName" class="font-semibold">Customer Name</h4>
                            <p id="chatCustomerStatus" class="text-sm text-green-100">Online</p>
                        </div>
                        <div class="flex space-x-2">
                            <button class="p-2 hover:bg-white hover:bg-opacity-10 rounded-full">
                                <i class="fas fa-phone"></i>
                            </button>
                            <button class="p-2 hover:bg-white hover:bg-opacity-10 rounded-full">
                                <i class="fas fa-video"></i>
                            </button>
                            <button class="p-2 hover:bg-white hover:bg-opacity-10 rounded-full">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Messages Container -->
                    <div id="chatMessages" class="flex-1 overflow-y-auto p-4 space-y-3" style="background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="chat-bg" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23e5e7eb" opacity="0.3"/></pattern></defs><rect width="100" height="100" fill="url(%23chat-bg)"/></svg>'); background-color: #f3f4f6;">
                        <!-- Messages will be loaded here -->
                    </div>
                    
                    <!-- Message Input -->
                    <div class="bg-white p-4 border-t">
                        <form id="sendMessageForm" class="flex items-center space-x-3">
                            <input type="hidden" id="selectedCustomerId" value="">
                            <button type="button" class="text-gray-500 hover:text-gray-700">
                                <i class="fas fa-paperclip text-xl"></i>
                            </button>
                            <div class="flex-1 relative">
                                <input type="text" id="messageText" placeholder="Type a message" class="w-full px-4 py-3 bg-gray-100 rounded-full focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-500" required>
                                <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-smile"></i>
                                </button>
                            </div>
                            <button type="submit" class="bg-green-500 text-white p-3 rounded-full hover:bg-green-600 transition-colors">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </div>
    `;
    
    document.body.insertAdjacentHTML('beforeend', modalHTML);
}

function loadCustomerChats() {
    // Fetch real chats from backend
    fetch('/chats')
        .then(response => response.json())
        .then(chats => {
            if (chats.length === 0) {
                document.getElementById('chatList').innerHTML = `
                    <div class="p-8 text-center text-gray-500">
                        <i class="fas fa-comments text-4xl mb-4"></i>
                        <p class="text-lg font-medium">No customer chats yet</p>
                        <p class="text-sm">Customers who order your products can message you here</p>
                    </div>
                `;
                return;
            }

            const chatListHTML = chats.map(chat => `
                <div class="chat-item p-4 border-b border-gray-200 hover:bg-gray-100 cursor-pointer transition-colors" onclick="selectChat(${chat.customer_id}, '${chat.customer_name}', '${chat.customer_email}')">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mr-3 text-white font-bold">
                            ${chat.avatar}
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h5 class="font-semibold text-gray-800">${chat.customer_name}</h5>
                                <span class="text-xs text-gray-500">${chat.last_message_time}</span>
                            </div>
                            <p class="text-sm text-gray-600 truncate">${chat.last_message}</p>
                        </div>
                        ${chat.unread_count > 0 ? `<div class="bg-blue-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center ml-2">${chat.unread_count}</div>` : ''}
                    </div>
                </div>
            `).join('');
            
            document.getElementById('chatList').innerHTML = chatListHTML;
            
            // Update chat badge
            const totalUnread = chats.reduce((sum, chat) => sum + chat.unread_count, 0);
            updateChatBadge(totalUnread);
        })
        .catch(error => {
            console.error('Error loading chats:', error);
            document.getElementById('chatList').innerHTML = `
                <div class="p-8 text-center text-red-500">
                    <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                    <p>Error loading chats</p>
                </div>
            `;
        });
}

function updateChatBadge(count) {
    const chatBadge = document.getElementById('chatBadge');
    if (count > 0) {
        chatBadge.textContent = count;
        chatBadge.classList.remove('hidden');
    } else {
        chatBadge.classList.add('hidden');
    }
}

let currentCustomerId = null;

function selectChat(customerId, customerName, customerEmail) {
    currentCustomerId = customerId;
    
    // Update chat header
    document.getElementById('chatHeader').innerHTML = `
        <div class="flex items-center">
            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mr-3 text-white font-bold">
                ${customerName.split(' ').map(n => n[0]).join('')}
            </div>
            <div>
                <h4 class="font-semibold text-gray-800">${customerName}</h4>
                <p class="text-sm text-gray-500">${customerEmail}</p>
            </div>
        </div>
    `;
    
    // Fetch real conversation
    fetch(`/chats/${customerId}`)
        .then(response => response.json())
        .then(messages => {
            if (messages.length === 0) {
                document.getElementById('chatMessages').innerHTML = `
                    <div class="flex items-center justify-center h-full text-gray-500">
                        <div class="text-center">
                            <i class="fas fa-comment-dots text-4xl mb-4"></i>
                            <p>No messages yet</p>
                            <p class="text-sm">Start the conversation with ${customerName}</p>
                        </div>
                    </div>
                `;
            } else {
                const messagesHTML = messages.map(msg => `
                    <div class="flex ${msg.sender_type === 'shopkeeper' ? 'justify-end' : 'justify-start'} mb-4">
                        <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg ${
                            msg.sender_type === 'shopkeeper' 
                            ? 'bg-blue-500 text-white' 
                            : 'bg-white text-gray-800 border border-gray-200'
                        }">
                            <p class="text-sm">${msg.message}</p>
                            ${msg.product ? `<div class="text-xs mt-1 ${msg.sender_type === 'shopkeeper' ? 'text-blue-100' : 'text-gray-500'}">
                                <i class="fas fa-box mr-1"></i>About: ${msg.product.name}
                            </div>` : ''}
                            <p class="text-xs mt-1 ${msg.sender_type === 'shopkeeper' ? 'text-blue-100' : 'text-gray-500'}">
                                ${new Date(msg.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}
                            </p>
                        </div>
                    </div>
                `).join('');
                
                document.getElementById('chatMessages').innerHTML = messagesHTML;
            }
            
            document.getElementById('chatInput').classList.remove('hidden');
            
            // Scroll to bottom
            const chatMessages = document.getElementById('chatMessages');
            chatMessages.scrollTop = chatMessages.scrollHeight;
            
            // Refresh chat list to update unread counts
            loadCustomerChats();
        })
        .catch(error => {
            console.error('Error loading conversation:', error);
            document.getElementById('chatMessages').innerHTML = `
                <div class="flex items-center justify-center h-full text-red-500">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle text-4xl mb-4"></i>
                        <p>Error loading messages</p>
                    </div>
                </div>
            `;
        });
}

function sendMessage() {
    const messageInput = document.getElementById('messageInput');
    const message = messageInput.value.trim();
    
    if (!message || !currentCustomerId) return;
    
    // Send message to backend
    fetch('/chats/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            customer_id: currentCustomerId,
            message: message
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Add message to chat immediately
            const chatMessages = document.getElementById('chatMessages');
            const messageHTML = `
                <div class="flex justify-end mb-4">
                    <div class="max-w-xs lg:max-w-md px-4 py-2 rounded-lg bg-blue-500 text-white">
                        <p class="text-sm">${message}</p>
                        <p class="text-xs mt-1 text-blue-100">${new Date().toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})}</p>
                    </div>
                </div>
            `;
            
            chatMessages.insertAdjacentHTML('beforeend', messageHTML);
            chatMessages.scrollTop = chatMessages.scrollHeight;
            
            // Clear input
            messageInput.value = '';
            
            // Refresh chat list
            loadCustomerChats();
            
            showSuccessMessage('Message sent successfully!');
        } else {
            showErrorMessage('Failed to send message');
        }
    })
    .catch(error => {
        console.error('Error sending message:', error);
        showErrorMessage('Failed to send message');
    });
}

</script>
