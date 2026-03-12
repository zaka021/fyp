@extends('shopkeeper.layout')

@section('title', 'Products Management')
@section('page-title', 'My Products')
@section('page-subtitle', 'Manage your product inventory and listings')

@section('content')
<div class="flex items-center justify-between mb-8">
    <h2 class="text-3xl font-bold text-white">My Products</h2>
    <button onclick="showAddProductForm()" class="bg-gradient-to-r from-vsn-secondary to-emerald-600 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
        <i class="fas fa-plus mr-2"></i>Add Product
    </button>
</div>

<!-- Add Product Form -->
<div id="add-product-form" class="hidden mb-6">
    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-5 border border-white/20 shadow-lg">
        <h3 class="text-white text-lg font-bold mb-3">Add New Product</h3>
        <form method="POST" action="/products" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @csrf
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Product Name</label>
                <input type="text" name="name" required class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary">
            </div>
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Price (Rs)</label>
                <input type="number" name="price" step="0.01" required class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary">
            </div>
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Category</label>
                <select name="category" required class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-vsn-secondary">
                    <option value="" class="bg-gray-800">Select Category</option>
                    <option value="food" class="bg-gray-800">🍽️ Food & Dining</option>
                    <option value="grocery" class="bg-gray-800">🛒 Grocery & Essentials</option>
                    <option value="fashion" class="bg-gray-800">👕 Fashion & Clothing</option>
                    <option value="electronics" class="bg-gray-800">📱 Electronics & Gadgets</option>
                    <option value="pharmacy" class="bg-gray-800">💊 Pharmacy & Health</option>
                    <option value="gifts" class="bg-gray-800">🎁 Gifts & Flowers</option>
                    <option value="taxi" class="bg-gray-800">🚗 Taxi & Transportation</option>
                    <option value="beauty" class="bg-gray-800">💄 Beauty & Personal Care</option>
                    <option value="home" class="bg-gray-800">🏠 Home & Garden</option>
                    <option value="sports" class="bg-gray-800">⚽ Sports & Fitness</option>
                    <option value="books" class="bg-gray-800">📚 Books & Stationery</option>
                    <option value="pets" class="bg-gray-800">🐕 Pet Supplies</option>
                    <option value="automotive" class="bg-gray-800">🔧 Automotive & Parts</option>
                    <option value="services" class="bg-gray-800">🛠️ Professional Services</option>
                    <option value="education" class="bg-gray-800">🎓 Education & Training</option>
                    <option value="travel" class="bg-gray-800">✈️ Travel & Tourism</option>
                    <option value="entertainment" class="bg-gray-800">🎬 Entertainment & Events</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-300 text-sm font-medium mb-2">Stock Quantity</label>
                <input type="number" name="stock_quantity" required class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary">
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-300 text-sm font-medium mb-2">Description</label>
                <textarea name="description" required class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary h-24"></textarea>
            </div>
            <div class="md:col-span-2">
                <label class="block text-gray-300 text-sm font-medium mb-2">Product Image</label>
                <div class="space-y-3">
                    <!-- Image Upload Area -->
                    <div id="image-upload-area" class="border-2 border-dashed border-white/30 rounded-xl p-6 text-center hover:border-white/50 transition-colors cursor-pointer" onclick="document.getElementById('image-input').click()">
                        <div id="upload-placeholder" class="space-y-3">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                            <div>
                                <p class="text-white font-medium">Click to upload product image</p>
                                <p class="text-gray-400 text-sm">PNG, JPG, GIF up to 5MB</p>
                            </div>
                        </div>
                        <div id="image-preview" class="hidden">
                            <img id="preview-img" class="max-w-full h-32 object-cover rounded-lg mx-auto" alt="Preview">
                            <p class="text-green-400 text-sm mt-2">✓ Image selected</p>
                        </div>
                    </div>
                    <input type="file" id="image-input" name="product_image" accept="image/*" class="hidden" onchange="previewImage(this)">
                    
                    <!-- Alternative: Image URL -->
                    <div class="text-center">
                        <span class="text-gray-400 text-sm">OR</span>
                    </div>
                    <div>
                        <label class="block text-gray-300 text-sm font-medium mb-2">Image URL (alternative)</label>
                        <input type="url" name="image_url" placeholder="https://example.com/image.jpg" class="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-vsn-secondary">
                    </div>
                </div>
            </div>
            <div class="md:col-span-2 flex space-x-4">
                <button type="submit" class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-6 py-3 rounded-xl font-semibold hover:shadow-lg transition-all duration-300">
                    <i class="fas fa-save mr-2"></i>Save Product
                </button>
                <button type="button" onclick="hideAddProductForm()" class="bg-gray-500 text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-600 transition-colors">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6">
    @forelse($products as $product)
    <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 border border-white/20 shadow-lg hover-lift transform transition-all duration-300 hover:scale-105">
        @if($product->image_url)
            <div class="relative overflow-hidden rounded-xl mb-4">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover transition-transform duration-300 hover:scale-110">
                <div class="absolute top-3 right-3">
                    <span class="bg-{{ $product->is_active ? 'green' : 'red' }}-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
        @else
            <div class="w-full h-48 bg-gradient-to-br from-gray-600 via-gray-700 to-gray-800 rounded-xl mb-4 flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-purple-500/20"></div>
                <i class="fas fa-image text-gray-300 text-4xl relative z-10"></i>
                <div class="absolute top-3 right-3">
                    <span class="bg-{{ $product->is_active ? 'green' : 'red' }}-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                        {{ $product->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
        @endif
        
        <div class="space-y-3">
            <div>
                <h3 class="text-white font-bold text-lg mb-1 line-clamp-2">{{ $product->name }}</h3>
                <p class="text-gray-300 text-sm leading-relaxed">{{ Str::limit($product->description, 60) }}</p>
            </div>
            
            <div class="bg-white/5 rounded-xl p-3 space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-sm font-medium">Price</span>
                    <span class="text-green-400 font-bold text-xl">Rs {{ number_format($product->price) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-sm font-medium">Stock</span>
                    <div class="flex items-center space-x-2">
                        <span class="text-white font-semibold">{{ $product->stock_quantity ?? 0 }}</span>
                        <span class="bg-{{ ($product->stock_quantity ?? 0) > 10 ? 'green' : (($product->stock_quantity ?? 0) > 0 ? 'yellow' : 'red') }}-500/20 text-{{ ($product->stock_quantity ?? 0) > 10 ? 'green' : (($product->stock_quantity ?? 0) > 0 ? 'yellow' : 'red') }}-400 px-2 py-1 rounded-full text-xs">
                            {{ ($product->stock_quantity ?? 0) > 10 ? 'In Stock' : (($product->stock_quantity ?? 0) > 0 ? 'Low Stock' : 'Out of Stock') }}
                        </span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-sm font-medium">Category</span>
                    <span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full text-xs font-medium">
                        {{ ucfirst($product->category ?? 'General') }}
                    </span>
                </div>
            </div>
            
            <div class="flex space-x-2 pt-2">
                <button class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-2 rounded-lg font-medium hover:from-blue-600 hover:to-blue-700 transition-all duration-300 text-sm">
                    <i class="fas fa-edit mr-1"></i>Edit
                </button>
                <form method="POST" action="/products/{{ $product->id }}" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this product?')" class="w-full bg-gradient-to-r from-red-500 to-red-600 text-white px-3 py-2 rounded-lg font-medium hover:from-red-600 hover:to-red-700 transition-all duration-300 text-sm">
                        <i class="fas fa-trash mr-1"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="md:col-span-2 lg:col-span-3 text-center py-12">
        <i class="fas fa-box-open text-gray-500 text-6xl mb-4"></i>
        <h3 class="text-white text-xl font-bold mb-2">No Products Yet</h3>
        <p class="text-gray-400 mb-6">Start by adding your first product to begin selling!</p>
        <button onclick="showAddProductForm()" class="bg-gradient-to-r from-vsn-secondary to-emerald-600 text-white px-8 py-4 rounded-xl font-semibold hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <i class="fas fa-plus mr-2"></i>Add Your First Product
        </button>
    </div>
    @endforelse
</div>
@endsection

@section('scripts')
<script>
function showAddProductForm() {
    document.getElementById('add-product-form').classList.remove('hidden');
}

function hideAddProductForm() {
    document.getElementById('add-product-form').classList.add('hidden');
    // Reset form and preview
    document.querySelector('form').reset();
    resetImagePreview();
}

function previewImage(input) {
    const file = input.files[0];
    if (file) {
        // Check file size (5MB limit)
        if (file.size > 5 * 1024 * 1024) {
            alert('File size must be less than 5MB');
            input.value = '';
            return;
        }
        
        // Check file type
        if (!file.type.startsWith('image/')) {
            alert('Please select a valid image file');
            input.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('upload-placeholder').classList.add('hidden');
            document.getElementById('image-preview').classList.remove('hidden');
            document.getElementById('preview-img').src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        resetImagePreview();
    }
}

function resetImagePreview() {
    document.getElementById('upload-placeholder').classList.remove('hidden');
    document.getElementById('image-preview').classList.add('hidden');
    document.getElementById('preview-img').src = '';
}

// Add drag and drop functionality
document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('image-upload-area');
    const imageInput = document.getElementById('image-input');
    
    // Prevent default drag behaviors
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, preventDefaults, false);
        document.body.addEventListener(eventName, preventDefaults, false);
    });
    
    // Highlight drop area when item is dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        uploadArea.addEventListener(eventName, highlight, false);
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        uploadArea.addEventListener(eventName, unhighlight, false);
    });
    
    // Handle dropped files
    uploadArea.addEventListener('drop', handleDrop, false);
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    function highlight(e) {
        uploadArea.classList.add('border-blue-400', 'bg-blue-500/10');
    }
    
    function unhighlight(e) {
        uploadArea.classList.remove('border-blue-400', 'bg-blue-500/10');
    }
    
    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        
        if (files.length > 0) {
            imageInput.files = files;
            previewImage(imageInput);
        }
    }
});
</script>
@endsection
