<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics - EtalaseKU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50">

    <div class="flex min-h-screen">
        <!-- Sidebar (same as dashboard) -->
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
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
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
                        <a href="{{ route('catalog.editor') }}" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            <i class="fas fa-link w-5"></i>
                            <span class="font-medium">Link/Catalog Editor</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products') }}" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            <i class="fas fa-boxes-stacked w-5"></i>
                            <span class="font-medium">Product Inventory</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('analytics') }}" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg bg-indigo-50 text-indigo-600">
                            <i class="fas fa-chart-bar w-5"></i>
                            <span class="font-medium">Analytics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('accessibility.settings') }}" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
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
                        <h1 class="text-xl font-semibold text-gray-900">Analytics</h1>
                        <p class="text-sm text-gray-500">Track your catalog performance</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm">
                            <option>Last 7 days</option>
                            <option>Last 30 days</option>
                            <option>Last 90 days</option>
                            <option>This year</option>
                        </select>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors flex items-center gap-2">
                            <i class="fas fa-download"></i>
                            Export
                        </button>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <!-- Stats Overview -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-gray-500">Total Views</span>
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-eye text-blue-600"></i>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900">12,847</div>
                        <div class="flex items-center text-sm text-green-500 mt-2">
                            <i class="fas fa-arrow-up mr-1"></i> +28% from last month
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-gray-500">QR Scans</span>
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-qrcode text-purple-600"></i>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900">2,456</div>
                        <div class="flex items-center text-sm text-green-500 mt-2">
                            <i class="fas fa-arrow-up mr-1"></i> +15% from last month
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-gray-500">Products</span>
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-box text-green-600"></i>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900">124</div>
                        <div class="flex items-center text-sm text-gray-500 mt-2">
                            12 active, 112 draft
                        </div>
                    </div>
                    <div class="bg-white rounded-xl p-6 border border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-sm font-medium text-gray-500">Link Shares</span>
                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-share-nodes text-orange-600"></i>
                            </div>
                        </div>
                        <div class="text-3xl font-bold text-gray-900">89</div>
                        <div class="flex items-center text-sm text-green-500 mt-2">
                            <i class="fas fa-arrow-up mr-1"></i> +42% from last month
                        </div>
                    </div>
                </div>

                <!-- Chart Placeholder -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Views Over Time</h3>
                    <div class="h-64 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-lg flex items-center justify-center">
                        <div class="text-center">
                            <i class="fas fa-chart-line text-4xl text-indigo-300 mb-4"></i>
                            <p class="text-gray-500">Chart visualization will appear here</p>
                            <p class="text-sm text-gray-400">Integrate with Chart.js or similar library</p>
                        </div>
                    </div>
                </div>

                <!-- Top Products -->
                <div class="bg-white rounded-xl border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900">Top Performing Products</h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                <span class="text-2xl font-bold text-gray-400">1</span>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">Kue Lapis Legit</p>
                                    <p class="text-sm text-gray-500">234 views • 45 QR scans</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-green-600">Rp 3.8M</div>
                                    <p class="text-xs text-gray-500">revenue</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                <span class="text-2xl font-bold text-gray-400">2</span>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">Kerajinan Bambu</p>
                                    <p class="text-sm text-gray-500">189 views • 38 QR scans</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-green-600">Rp 2.8M</div>
                                    <p class="text-xs text-gray-500">revenue</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-lg">
                                <span class="text-2xl font-bold text-gray-400">3</span>
                                <div class="flex-1">
                                    <p class="font-medium text-gray-900">Kopi Arabika</p>
                                    <p class="text-sm text-gray-500">312 views • 52 QR scans</p>
                                </div>
                                <div class="text-right">
                                    <div class="text-lg font-bold text-green-600">Rp 2.3M</div>
                                    <p class="text-xs text-gray-500">revenue</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>