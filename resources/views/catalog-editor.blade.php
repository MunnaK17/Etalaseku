<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog Editor - EtalaseKU</title>
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
                        <a href="{{ route('catalog.editor') }}" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg bg-indigo-50 text-indigo-600">
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
                        <a href="{{ route('analytics') }}" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
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
                        <h1 class="text-xl font-semibold text-gray-900">Link/Catalog Editor</h1>
                        <p class="text-sm text-gray-500">Customize your catalog appearance</p>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <!-- Catalog Link -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Catalog Link</h3>
                    <div class="flex items-center gap-4">
                        <div class="flex-1 bg-gray-100 rounded-lg px-4 py-3">
                            <code class="text-indigo-600">etalaseku.com/c/obiiit</code>
                        </div>
                        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors flex items-center gap-2">
                            <i class="fas fa-copy"></i>
                            Copy Link
                        </button>
                        <button class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                            <i class="fas fa-edit"></i>
                            Edit
                        </button>
                    </div>
                </div>

                <!-- QR Code -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">QR Code</h3>
                    <div class="flex items-center gap-6">
                        <div class="w-32 h-32 bg-gray-200 rounded-xl flex items-center justify-center">
                            <i class="fas fa-qrcode text-5xl text-gray-400"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-gray-600 mb-4">Download QR code for your physical store or product packaging.</p>
                            <div class="flex gap-3">
                                <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors flex items-center gap-2">
                                    <i class="fas fa-download"></i>
                                    Download PNG
                                </button>
                                <button class="px-4 py-2 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors flex items-center gap-2">
                                    <i class="fas fa-download"></i>
                                    Download SVG
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Catalog Settings -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Catalog Settings</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catalog Name</label>
                            <input type="text" value="Toko Kue Ibu" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Custom URL Slug</label>
                            <div class="flex items-center gap-2">
                                <span class="text-gray-500">etalaseku.com/c/</span>
                                <input type="text" value="obiiit" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Theme Color</label>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-indigo-600 cursor-pointer ring-2 ring-offset-2 ring-indigo-500"></div>
                                <div class="w-10 h-10 rounded-lg bg-green-600 cursor-pointer"></div>
                                <div class="w-10 h-10 rounded-lg bg-purple-600 cursor-pointer"></div>
                                <div class="w-10 h-10 rounded-lg bg-orange-600 cursor-pointer"></div>
                                <div class="w-10 h-10 rounded-lg bg-gray-600 cursor-pointer"></div>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catalog Visibility</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                                <option>Public - Anyone can view</option>
                                <option>Unlisted - Only with link</option>
                                <option>Private - Only owner</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                            Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>