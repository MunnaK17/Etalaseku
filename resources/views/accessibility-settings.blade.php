<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accessibility Settings - EtalaseKU</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }

        /* Focus Indicators - WCAG 2.2 AA */
        *:focus-visible {
            outline: 3px solid #6366f1;
            outline-offset: 2px;
            border-radius: 4px;
        }
        *:focus:not(:focus-visible) { outline: none; }
        button:focus-visible,
        a:focus-visible,
        input:focus-visible,
        select:focus-visible {
            outline: 3px solid #6366f1;
            outline-offset: 2px;
        }
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
                        <a href="{{ route('analytics') }}" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900 transition-colors">
                            <i class="fas fa-chart-bar w-5"></i>
                            <span class="font-medium">Analytics</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('accessibility.settings') }}" class="flex items-center gap-3 px-5 py-3 mx-2 rounded-lg bg-indigo-50 text-indigo-600">
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
                        <h1 class="text-xl font-semibold text-gray-900">Accessibility Settings</h1>
                        <p class="text-sm text-gray-500">Make your catalog accessible for everyone</p>
                    </div>
                </div>
            </header>

            <div class="p-6">
                <!-- Info Banner -->
                <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-6 mb-6 flex items-start gap-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-universal-access text-indigo-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-900 mb-1">Accessibility First</h3>
                        <p class="text-gray-600 text-sm">EtalaseKU is designed to be accessible for everyone. Configure these settings to ensure your catalog is usable by people with various disabilities.</p>
                    </div>
                </div>

                <!-- Text Settings -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-font text-gray-500"></i>
                        Text & Typography
                    </h3>
                    <div class="space-y-6">
                        <!-- Text Resizing -->
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Enable Text Resizing</p>
                                <p class="text-sm text-gray-500">Allow visitors to increase/decrease text size</p>
                            </div>
                            <label for="toggle-text-resizing" class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="toggle-text-resizing" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>

                        <!-- Font Size Base -->
                        <div>
                            <label class="block font-medium text-gray-900 mb-2">Base Font Size</label>
                            <div class="flex items-center gap-4">
                                <input type="range" min="12" max="20" value="16" class="flex-1">
                                <span class="w-16 text-center font-medium text-gray-700">16px</span>
                            </div>
                        </div>

                        <!-- Line Height -->
                        <div>
                            <label class="block font-medium text-gray-900 mb-2">Line Height</label>
                            <select class="w-full max-w-xs px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                                <option>Compact (1.2)</option>
                                <option selected>Normal (1.5)</option>
                                <option>Relaxed (1.8)</option>
                                <option>Spacious (2.0)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Color & Contrast -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-palette text-gray-500"></i>
                        Color & Contrast
                    </h3>
                    <div class="space-y-6">
                        <!-- High Contrast Mode -->
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">High Contrast Mode</p>
                                <p class="text-sm text-gray-500">Increase contrast for better visibility</p>
                            </div>
                            <label for="toggle-high-contrast" class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="toggle-high-contrast" class="sr-only peer">
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>

                        <!-- Color Scheme -->
                        <div>
                            <label class="block font-medium text-gray-900 mb-3">Color Scheme</label>
                            <div class="flex gap-4">
                                <button class="w-16 h-16 rounded-xl bg-white border-2 border-indigo-500 flex items-center justify-center">
                                    <i class="fas fa-sun text-gray-400"></i>
                                </button>
                                <button class="w-16 h-16 rounded-xl bg-gray-900 border-2 border-gray-300 flex items-center justify-center">
                                    <i class="fas fa-moon text-gray-500"></i>
                                </button>
                                <button class="w-16 h-16 rounded-xl bg-blue-100 border-2 border-gray-300 flex items-center justify-center">
                                    <i class="fas fa-adjust text-blue-400"></i>
                                </button>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Light, Dark, or System default</p>
                        </div>
                    </div>
                </div>

                <!-- Screen Reader & Navigation -->
                <div class="bg-white rounded-xl border border-gray-200 p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-microphone text-gray-500"></i>
                        Screen Reader & Navigation
                    </h3>
                    <div class="space-y-6">
                        <!-- Text to Speech -->
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Text-to-Speech for Products</p>
                                <p class="text-sm text-gray-500">Add audio button to read product descriptions</p>
                            </div>
                            <label for="toggle-tts" class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="toggle-tts" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>

                        <!-- Keyboard Navigation -->
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Enhanced Keyboard Navigation</p>
                                <p class="text-sm text-gray-500">Allow full navigation using Tab, Enter, and arrow keys</p>
                            </div>
                            <label for="toggle-keyboard" class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="toggle-keyboard" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>

                        <!-- Focus Indicators -->
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">Visible Focus Indicators</p>
                                <p class="text-sm text-gray-500">Show clear outline when navigating with keyboard</p>
                            </div>
                            <label for="toggle-focus" class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="toggle-focus" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>

                        <!-- ARIA Labels -->
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="font-medium text-gray-900">ARIA Labels</p>
                                <p class="text-sm text-gray-500">Add descriptive labels for screen readers</p>
                            </div>
                            <label for="toggle-aria" class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" id="toggle-aria" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Preview & Save -->
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Accessibility Score</h3>
                            <p class="text-sm text-gray-500">Your catalog's current accessibility rating</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="text-center">
                                <div class="text-4xl font-bold text-green-600">92</div>
                                <p class="text-sm text-gray-500">Excellent</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end gap-4">
                        <button class="px-6 py-3 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                            Preview Catalog
                        </button>
                        <button class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                            Save Settings
                        </button>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>