{{-- ============================================
    EtalaseKU - Product Form View
    Generated from Figma Design
    File: KELOMPOK-5 (Z6lPYasLGmve1Tb1TqJxv5)
=========================================== --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add/Edit Product - EtalaseKU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

    <div class="flex min-h-screen">
        <!-- Sidebar (reuse from dashboard.blade.php) -->
        <aside class="w-56 bg-white border-r border-gray-200 flex flex-col fixed h-full">
            <div class="p-5 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">E</span>
                    </div>
                    <span class="text-lg font-semibold text-gray-900">EtalaseKU</span>
                </div>
            </div>
            <nav class="flex-1 py-4">
                <ul class="space-y-1">
                    <li>
                        <a href="#" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            <i class="fas fa-home w-5"></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            <i class="fas fa-chart-line w-5"></i>
                            <span class="font-medium">Overview</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="fas fa-link w-5"></i>
                            <span class="font-medium">Link/Catalog Editor</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            <i class="fas fa-boxes-stacked w-5"></i>
                            <span class="font-medium">Product Inventory</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            <i class="fas fa-chart-bar w-5"></i>
                            <span class="font-medium">Analytics</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            <i class="fas fa-universal-access w-5"></i>
                            <span class="font-medium">Accessibility Settings</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-56">
            <header class="bg-white border-b border-gray-200 sticky top-0 z-40">
                <div class="flex items-center justify-between px-6 py-4">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900">Link/Catalog Editor</h1>
                        <p class="text-sm text-gray-500">Create and manage your digital catalog</p>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <!-- ============================================
                     FORM SECTION
                     Node ID: 3:983
                ============================================ -->
                <div class="max-w-4xl mx-auto">
                    <!-- Form Header -->
                    <div class="bg-white rounded-xl border border-gray-200 p-8 mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">Add New Product</h2>
                        <p class="text-gray-600">Fill in the details below to add a new product to your catalog</p>
                    </div>

                    <!-- Form Fields -->
                    <form class="bg-white rounded-xl border border-gray-200 p-8">
                        <!-- Row 1: Product Name & SKU -->
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Product Name <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    placeholder="Enter product name"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                                >
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    SKU / Product Code
                                </label>
                                <input
                                    type="text"
                                    placeholder="e.g., KUE-001"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                                >
                                <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate</p>
                            </div>
                        </div>

                        <!-- Row 2: Category & Tags -->
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Category <span class="text-red-500">*</span>
                                </label>
                                <div class="flex flex-wrap gap-2">
                                    <button type="button" class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded-lg text-sm font-medium">Food & Beverages</button>
                                    <button type="button" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200">Handicraft</button>
                                    <button type="button" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200">Textile</button>
                                    <button type="button" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200">Electronics</button>
                                    <button type="button" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200">Fashion</button>
                                    <button type="button" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200">Digital Product</button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Tags
                                </label>
                                <input
                                    type="text"
                                    placeholder="Add tags separated by comma"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                                >
                                <p class="mt-1 text-xs text-gray-500">e.g., handmade, local, promo</p>
                            </div>
                        </div>

                        <!-- Row 3: Price & Stock -->
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Price <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                                    <input
                                        type="text"
                                        placeholder="0"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                                    >
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Stock Quantity
                                </label>
                                <input
                                    type="number"
                                    placeholder="0"
                                    min="0"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"
                                >
                            </div>
                        </div>

                        <!-- Row 4: Description -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Description
                            </label>
                            <textarea
                                rows="4"
                                placeholder="Describe your product..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all resize-none"
                            ></textarea>
                            <p class="mt-1 text-xs text-gray-500">Include details like materials, size, usage instructions, etc.</p>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Product Images
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-indigo-400 hover:bg-indigo-50 transition-colors cursor-pointer">
                                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-cloud-upload-alt text-2xl text-gray-400"></i>
                                </div>
                                <p class="text-gray-600 mb-2">Drag and drop images here, or click to browse</p>
                                <p class="text-xs text-gray-500">Supports: JPG, PNG, WebP (max 5MB each)</p>
                                <input type="file" class="hidden" accept="image/*" multiple>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200">
                            <button
                                type="button"
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors"
                            >
                                Cancel
                            </button>
                            <button
                                type="submit"
                                class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors"
                            >
                                Save Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</body>
</html>