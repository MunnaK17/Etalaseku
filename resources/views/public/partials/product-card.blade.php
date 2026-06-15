{{-- Product Card Partial - used in public store --}}
{{-- Supports display styles: card, button, list --}}

@php
    $displayStyle = $product->display_style ?? 'card';
    $effectiveImage = $product->effective_image;
@endphp

@switch($displayStyle)
    @case('button')
        {{-- Button Style --}}
        <a href="{{ route('track.click', ['product' => $product->id, 'event' => $product->cta_type === 'whatsapp' ? 'whatsapp_click' : ($product->cta_type === 'checkout' ? 'checkout_click' : ($product->cta_type === 'external_link' ? 'external_click' : 'download_click'))]) }}"
           class="flex items-center gap-3 p-4 bg-white border-2 border-gray-100 rounded-xl hover:border-gray-200 hover:shadow-sm transition-all {{ $product->button_color ? '' : $product->cta_button_color_classes }}"
           style="{{ $product->button_color ? 'border-color: ' . $product->button_color . '; background-color: ' . $product->button_color . ';' : '' }}">
            @if($product->thumbnail || $product->emoji)
                <div class="flex-shrink-0 w-10 h-10 rounded-full overflow-hidden bg-white/20 flex items-center justify-center">
                    @if($product->thumbnail)
                        <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-xl">{{ $product->emoji }}</span>
                    @endif
                </div>
            @endif
            <div class="flex-1 min-w-0">
                <div class="font-semibold text-white truncate">{{ $product->emoji ? $product->emoji . ' ' . $product->name : $product->name }}</div>
                @if($product->description)
                    <div class="text-xs text-white/80 truncate">{{ $product->description }}</div>
                @endif
            </div>
            <svg class="w-5 h-5 text-white flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
        @break

    @case('list')
        {{-- List Style --}}
        <a href="{{ route('track.click', ['product' => $product->id, 'event' => $product->cta_type === 'whatsapp' ? 'whatsapp_click' : ($product->cta_type === 'checkout' ? 'checkout_click' : ($product->cta_type === 'external_link' ? 'external_click' : 'download_click'))]) }}"
           class="flex items-center gap-3 p-3 bg-white border-b border-gray-100 last:border-b-0 hover:bg-gray-50 transition-colors">
            @if($product->thumbnail || $product->emoji)
                <div class="flex-shrink-0 w-8 h-8 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                    @if($product->thumbnail)
                        <img src="{{ $product->thumbnail }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    @else
                        <span class="text-lg">{{ $product->emoji }}</span>
                    @endif
                </div>
            @endif
            <div class="flex-1 min-w-0">
                <div class="font-medium text-gray-900 truncate text-sm">{{ $product->emoji ? $product->emoji . ' ' . $product->name : $product->name }}</div>
                @if($product->price)
                    <div class="text-xs font-semibold text-indigo-600">{{ $product->formatted_price }}</div>
                @endif
            </div>
            @if($product->price)
                <span class="text-lg font-bold text-gray-900">{{ $product->formatted_price }}</span>
            @endif
        </a>
        @break

    @default
        {{-- Card Style (default) --}}
        <div class="product-card bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            {{-- Image --}}
            @if($effectiveImage)
                <div class="aspect-[4/3] bg-gray-100 relative overflow-hidden">
                    <img src="{{ $effectiveImage }}"
                         alt="{{ $product->name }}"
                         class="w-full h-full object-cover"
                         loading="lazy">
                    @if($product->display_style === 'card' && $product->thumbnail && $product->image)
                        <div class="absolute bottom-2 right-2 w-12 h-12 rounded-lg overflow-hidden border-2 border-white shadow">
                            <img src="{{ $product->image }}" alt="" class="w-full h-full object-cover">
                        </div>
                    @endif
                </div>
            @else
                <div class="aspect-[4/3] bg-gray-100 relative overflow-hidden flex items-center justify-center">
                    @if($product->emoji)
                        <span class="text-6xl">{{ $product->emoji }}</span>
                    @else
                        <svg class="w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    @endif
                </div>
            @endif

            {{-- Product Info --}}
            <div class="p-4">
                {{-- Name with Emoji --}}
                <h3 class="font-bold text-gray-900 text-lg flex items-center gap-2">
                    <span>{{ $product->name }}</span>
                </h3>

                {{-- Description --}}
                @if($product->description)
                    <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $product->description }}</p>
                @endif

                {{-- Price --}}
                @if($product->price)
                    <div class="mt-3">
                        <span class="text-2xl font-bold text-indigo-600">{{ $product->formatted_price }}</span>
                    </div>
                @endif

                {{-- CTA Button --}}
                <a href="{{ route('track.click', ['product' => $product->id, 'event' => $product->cta_type === 'whatsapp' ? 'whatsapp_click' : ($product->cta_type === 'checkout' ? 'checkout_click' : ($product->cta_type === 'external_link' ? 'external_click' : 'download_click'))]) }}"
                   class="mt-4 flex items-center justify-center gap-2 w-full py-3.5 px-4 rounded-xl font-semibold text-base transition-all text-white {{ $product->button_color ? '' : $product->cta_button_color_classes }}"
                   style="{{ $product->button_color ? 'background-color: ' . $product->button_color . ';' : '' }}">
                    @switch($product->cta_type)
                        @case('whatsapp')
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            @break
                        @case('checkout')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            @break
                        @case('download')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            @break
                        @case('external_link')
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            @break
                    @endswitch
                    <span>{{ $product->cta_button_text }}</span>
                </a>
            </div>
        </div>
@endswitch