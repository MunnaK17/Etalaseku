{{-- ============================================
    EtalaseKU - Product Inventory (Grid View)
    Generated from Figma Design
    File: KELOMPOK-5 (Z6lPYasLGmve1Tb1TqJxv5)
=========================================== --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Inventory - EtalaseKU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
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
                        <a href="#" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            <i class="fas fa-link w-5"></i>
                            <span class="font-medium">Link/Catalog Editor</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg bg-indigo-50 text-indigo-600">
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
                        <h1 class="text-xl font-semibold text-gray-900">Product Inventory</h1>
                        <p class="text-sm text-gray-500">Manage your product catalog</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <button class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors flex items-center gap-2">
                            <i class="fas fa-download"></i>
                            Export
                        </button>
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors flex items-center gap-2">
                            <i class="fas fa-plus"></i>
                            Add Product
                        </button>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <!-- ============================================
                     PRODUCTS SECTION
                     Node ID: 3:872
                ============================================ -->

                <!-- Section Header -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">My Products</h2>
                    <p class="text-gray-600">Browse and manage all your products in one place</p>
                </div>

                <!-- Filter & Search Bar -->
                <div class="flex flex-wrap items-center gap-4 mb-6">
                    <div class="relative flex-1 min-w-[300px]">
                        <input
                            type="text"
                            placeholder="Search products..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none"
                        >
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    </div>
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                        <option>All Categories</option>
                        <option>Food & Beverages</option>
                        <option>Handicraft</option>
                        <option>Textile</option>
                        <option>Electronics</option>
                        <option>Fashion</option>
                    </select>
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                        <option>All Status</option>
                        <option>Active</option>
                        <option>Draft</option>
                        <option>Sold Out</option>
                    </select>
                </div>

                <!-- Products Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                    <!-- Product Card 1 -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="relative">
                            <div class="aspect-square bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                                <div class="w-20 h-20 bg-indigo-200 rounded-full flex items-center justify-center">
                                    <i class="fas fa-cookie-bite text-3xl text-indigo-600"></i>
                                </div>
                            </div>
                            <span class="absolute top-3 left-3 px-3 py-1 bg-green-500 text-white text-xs font-medium rounded-full">Active</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-1">Kue Lapis Legit</h3>
                            <p class="text-sm text-gray-500 mb-3 line-clamp-2">Kue lapis legit premium dengan bahan berkualitas tinggi</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">Rp 85.000</span>
                                <span class="text-sm text-gray-500">234 views</span>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <button class="flex-1 py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                                    Edit
                                </button>
                                <button class="py-2 px-3 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 2 -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="relative">
                            <div class="aspect-square bg-gradient-to-br from-green-100 to-teal-100 flex items-center justify-center">
                                <div class="w-20 h-20 bg-green-200 rounded-full flex items-center justify-center">
                                    <i class="fas fa-seedling text-3xl text-green-600"></i>
                                </div>
                            </div>
                            <span class="absolute top-3 left-3 px-3 py-1 bg-green-500 text-white text-xs font-medium rounded-full">Active</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-1">Kerajinan Bambu</h3>
                            <p class="text-sm text-gray-500 mb-3 line-clamp-2"> Berbagai kerajinan tangan dari bambu asli Indonesia</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">Rp 150.000</span>
                                <span class="text-sm text-gray-500">189 views</span>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <button class="flex-1 py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                                    Edit
                                </button>
                                <button class="py-2 px-3 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 3 -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="relative">
                            <div class="aspect-square bg-gradient-to-br from-purple-100 to-pink-100 flex items-center justify-center">
                                <div class="w-20 h-20 bg-purple-200 rounded-full flex items-center justify-center">
                                    <i class="fas fa-palette text-3xl text-purple-600"></i>
                                </div>
                            </div>
                            <span class="absolute top-3 left-3 px-3 py-1 bg-yellow-500 text-white text-xs font-medium rounded-full">Draft</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-1">Batik Tulis</h3>
                            <p class="text-sm text-gray-500 mb-3 line-clamp-2">Batik tulis handmade dengan motif klasik Indonesia</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">Rp 450.000</span>
                                <span class="text-sm text-gray-500">156 views</span>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <button class="flex-1 py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                                    Edit
                                </button>
                                <button class="py-2 px-3 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 4 -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="relative">
                            <div class="aspect-square bg-gradient-to-br from-orange-100 to-red-100 flex items-center justify-center">
                                <div class="w-20 h-20 bg-orange-200 rounded-full flex items-center justify-center">
                                    <i class="fas fa-mug-hot text-3xl text-orange-600"></i>
                                </div>
                            </div>
                            <span class="absolute top-3 left-3 px-3 py-1 bg-green-500 text-white text-xs font-medium rounded-full">Active</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-1">Kopi Arabika</h3>
                            <p class="text-sm text-gray-500 mb-3 line-clamp-2">Kopi arabika premium dari dataran tinggi</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">Rp 75.000</span>
                                <span class="text-sm text-gray-500">312 views</span>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <button class="flex-1 py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                                    Edit
                                </button>
                                <button class="py-2 px-3 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 5 -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="relative">
                            <div class="aspect-square bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center">
                                <div class="w-20 h-20 bg-blue-200 rounded-full flex items-center justify-center">
                                    <i class="fas fa-tshirt text-3xl text-blue-600"></i>
                                </div>
                            </div>
                            <span class="absolute top-3 left-3 px-3 py-1 bg-red-500 text-white text-xs font-medium rounded-full">Sold Out</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-1">Kaos Sablon</h3>
                            <p class="text-sm text-gray-500 mb-3 line-clamp-2">Kaos sablon custom dengan desain original</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">Rp 120.000</span>
                                <span class="text-sm text-gray-500">98 views</span>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <button class="flex-1 py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                                    Edit
                                </button>
                                <button class="py-2 px-3 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Product Card 6 -->
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-lg transition-shadow">
                        <div class="relative">
                            <div class="aspect-square bg-gradient-to-br from-yellow-100 to-amber-100 flex items-center justify-center">
                                <div class="w-20 h-20 bg-yellow-200 rounded-full flex items-center justify-center">
                                    <i class="fas fa-ring text-3xl text-yellow-600"></i>
                                </div>
                            </div>
                            <span class="absolute top-3 left-3 px-3 py-1 bg-green-500 text-white text-xs font-medium rounded-full">Active</span>
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-1">Cincin Perak</h3>
                            <p class="text-sm text-gray-500 mb-3 line-clamp-2">Cincin perak handmade dengan ukiran khas</p>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-gray-900">Rp 250.000</span>
                                <span class="text-sm text-gray-500">167 views</span>
                            </div>
                            <div class="mt-4 flex gap-2">
                                <button class="flex-1 py-2 bg-indigo-50 text-indigo-600 rounded-lg text-sm font-medium hover:bg-indigo-100 transition-colors">
                                    Edit
                                </button>
                                <button class="py-2 px-3 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Add New Product Card -->
                    <div class="bg-white rounded-xl border-2 border-dashed border-gray-300 overflow-hidden hover:border-indigo-400 hover:bg-indigo-50 transition-colors cursor-pointer flex items-center justify-center min-h-[400px]">
                        <div class="text-center p-6">
                            <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-plus text-2xl text-gray-400"></i>
                            </div>
                            <p class="text-gray-600 font-medium">Add New Product</p>
                            <p class="text-sm text-gray-400 mt-1">Click to add a new item</p>
                        </div>
                    </div>

                </div>

                <!-- Pagination -->
                <div class="mt-8 flex items-center justify-between">
                    <p class="text-sm text-gray-500">Showing 1-6 of 124 products</p>
                    <div class="flex items-center gap-2">
                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50 disabled:opacity-50" disabled>
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="px-3 py-2 bg-indigo-600 text-white rounded-lg">1</button>
                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">2</button>
                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">3</button>
                        <span class="px-2 text-gray-400">...</span>
                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">21</button>
                        <button class="px-3 py-2 border border-gray-300 rounded-lg text-gray-600 hover:bg-gray-50">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>