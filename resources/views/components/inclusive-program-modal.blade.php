{{-- Inclusive Program Modal - Submit to n8n webhook → Google Sheets --}}

<div x-data="{
        open: false,
        loading: false,
        success: false,
        form: { name: '', email: '', whatsapp: '', disability_type: '', story: '', certificate: '' },
        errors: {},
        init() {
            window.addEventListener('open-inclusive-modal', () => this.openModal());
        },
        openModal() {
            this.open = true;
            this.success = false;
            this.errors = {};
            this.form = { name: '', email: '', whatsapp: '', disability_type: '', story: '', certificate: '' };
        },
        closeModal() {
            this.open = false;
        },
        validate() {
            this.errors = {};
            if (!this.form.name.trim()) this.errors.name = 'Nama lengkap wajib diisi.';
            if (!this.form.email.trim()) {
                this.errors.email = 'Email wajib diisi.';
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.form.email)) {
                this.errors.email = 'Format email tidak valid.';
            }
            if (!this.form.whatsapp.trim()) {
                this.errors.whatsapp = 'Nomor WhatsApp wajib diisi.';
            } else if (this.form.whatsapp.replace(/\D/g, '').length < 8) {
                this.errors.whatsapp = 'Nomor WhatsApp terlalu pendek.';
            }
            if (!this.form.disability_type) this.errors.disability_type = 'Pilih jenis disabilitas.';
            if (!this.form.story.trim()) {
                this.errors.story = 'Ceritakan tentang Anda wajib diisi.';
            } else if (this.form.story.trim().length < 50) {
                this.errors.story = 'Minimal 50 karakter untuk ceritakan tentang Anda.';
            }
            return Object.keys(this.errors).length === 0;
        },
        async submit() {
            if (!this.validate()) return;
            this.loading = true;
            this.errors = {};
            try {
                const response = await fetch('/api/inclusive-program/submit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=&quot;csrf-token&quot;]')?.content || '',
                    },
                    body: JSON.stringify({
                        name: this.form.name.trim(),
                        email: this.form.email.trim(),
                        whatsapp: this.form.whatsapp.trim(),
                        disability_type: this.form.disability_type,
                        story: this.form.story.trim(),
                        certificate: this.form.certificate.trim() || null,
                    }),
                });
                const data = await response.json();
                if (!response.ok || data.error) {
                    if (data.errors) { this.errors = data.errors; this.loading = false; return; }
                    throw new Error(data.message || 'Terjadi kesalahan. Silakan coba lagi.');
                }
                this.success = true;
            } catch (error) {
                this.errors.general = error.message || 'Terjadi kesalahan. Silakan coba lagi.';
            } finally {
                this.loading = false;
            }
        },
    }"
    x-show="open" x-cloak
    class="fixed inset-0 overflow-y-auto z-[100]" role="dialog" aria-modal="true" aria-labelledby="inclusive-modal-title">

    <!-- Backdrop -->
    <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" x-on:click="closeModal()" aria-hidden="true"></div>

    <!-- Modal -->
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden"
             x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95">

            <!-- Header -->
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-5">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center" aria-hidden="true">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 id="inclusive-modal-title" class="text-lg font-bold text-white">Program Inklusif</h2>
                            <p class="text-sm text-purple-200">Pro Gratis 6 Bulan untuk Disabilitas</p>
                        </div>
                    </div>
                    <button type="button" x-on:click="closeModal()" class="w-8 h-8 bg-white/20 hover:bg-white/30 rounded-lg flex items-center justify-center transition-colors" aria-label="Tutup dialog">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Success State -->
            <div x-show="success" x-cloak class="px-6 py-10 text-center">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Permohonan Terkirim!</h3>
                <p class="text-gray-600 mb-1">Terima kasih telah mengajukan Program Inklusif EtalaseKu.</p>
                <p class="text-sm text-gray-500">Tim kami akan memproses permohonan Anda dalam <strong>1–3 hari kerja</strong>. Cek email secara berkala.</p>
                <button type="button" x-on:click="closeModal()" class="mt-6 px-6 py-2.5 bg-purple-600 text-white rounded-xl font-medium hover:bg-purple-700 transition-colors">
                    Tutup
                </button>
            </div>

            <!-- Form State -->
            <div x-show="!success">
                <div class="px-6 py-5 border-b border-gray-100">
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Isi formulir di bawah untuk mengajukan <strong>Plan Pro gratis selama 6 bulan</strong>. Data Anda akan kami proses untuk verifikasi.
                    </p>
                </div>

                <form x-ref="form" x-on:submit.prevent="submit" class="px-6 py-5 space-y-5" novalidate>

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="inc-name" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Nama Lengkap <span class="text-red-500" aria-hidden="true">*</span>
                        </label>
                        <input type="text" id="inc-name" name="name" x-model="form.name" required
                               autocomplete="name"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition-all @error('name') border-red-400 @enderror"
                               :class="errors.name ? 'border-red-400 bg-red-50' : ''"
                               placeholder="Masukkan nama lengkap Anda">
                        <p x-show="errors.name" x-text="errors.name" class="mt-1 text-sm text-red-600" role="alert"></p>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="inc-email" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Alamat Surel (Email) <span class="text-red-500" aria-hidden="true">*</span>
                        </label>
                        <input type="email" id="inc-email" name="email" x-model="form.email" required
                               autocomplete="email"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition-all @error('email') border-red-400 @enderror"
                               :class="errors.email ? 'border-red-400 bg-red-50' : ''"
                               placeholder="nama@contoh.com">
                        <p x-show="errors.email" x-text="errors.email" class="mt-1 text-sm text-red-600" role="alert"></p>
                    </div>

                    <!-- WhatsApp -->
                    <div>
                        <label for="inc-whatsapp" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Nomor WhatsApp <span class="text-red-500" aria-hidden="true">*</span>
                        </label>
                        <input type="tel" id="inc-whatsapp" name="whatsapp" x-model="form.whatsapp" required
                               autocomplete="tel"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition-all @error('whatsapp') border-red-400 @enderror"
                               :class="errors.whatsapp ? 'border-red-400 bg-red-50' : ''"
                               placeholder="081234567890">
                        <p x-show="errors.whatsapp" x-text="errors.whatsapp" class="mt-1 text-sm text-red-600" role="alert"></p>
                    </div>

                    <!-- Jenis Disabilitas -->
                    <div>
                        <label for="inc-disability" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Jenis Disabilitas <span class="text-red-500" aria-hidden="true">*</span>
                        </label>
                        <select id="inc-disability" name="disability_type" x-model="form.disability_type" required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition-all bg-white @error('disability_type') border-red-400 @enderror"
                                :class="errors.disability_type ? 'border-red-400 bg-red-50' : ''">
                            <option value="">Pilih jenis disabilitas</option>
                            <option value="physical">Disabilitas Fisik</option>
                            <option value="visual">Disabilitas Netra / Tunanetra</option>
                            <option value="hearing">Disabilitas Rungu / Wicara</option>
                            <option value="intellectual">Disabilitas Intelektual</option>
                            <option value="mental">Disabilitas Mental / Psikososial</option>
                            <option value="multiple">Disabilitas Ganda (Multiple)</option>
                        </select>
                        <p x-show="errors.disability_type" x-text="errors.disability_type" class="mt-1 text-sm text-red-600" role="alert"></p>
                    </div>

                    <!-- Ceritakan Kebutuhan -->
                    <div>
                        <label for="inc-story" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Ceritakan tentang Anda dan kebutuhan Anda <span class="text-red-500" aria-hidden="true">*</span>
                        </label>
                        <textarea id="inc-story" name="story" x-model="form.story" rows="3" required minlength="50"
                                  class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition-all resize-none @error('story') border-red-400 @enderror"
                                  :class="errors.story ? 'border-red-400 bg-red-50' : ''"
                                  placeholder="Ceritakan tentang bisnis atau kegiatan Anda, dan bagaimana EtalaseKu dapat membantu..."></textarea>
                        <p class="mt-1 text-xs text-gray-400">Minimal 50 karakter. Semakin detail, semakin membantu proses verifikasi.</p>
                        <p x-show="errors.story" x-text="errors.story" class="mt-1 text-sm text-red-600" role="alert"></p>
                    </div>

                    <!-- Nomor Sertifikat (Opsional) -->
                    <div>
                        <label for="inc-cert" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Nomor Sertifikat Disabilitas
                            <span class="text-xs font-normal text-gray-400">(opsional)</span>
                        </label>
                        <input type="text" id="inc-cert" name="certificate" x-model="form.certificate"
                               class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition-all"
                               placeholder="Contoh: 12345678/2024">
                        <p class="mt-1 text-xs text-gray-400">Dari Kemendikbud, DisabilitasNet, atau instansi terakreditasi lainnya.</p>
                    </div>

                    <!-- Info box -->
                    <div class="bg-purple-50 border border-purple-100 rounded-xl p-4">
                        <div class="flex gap-3">
                            <svg class="w-5 h-5 text-purple-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div class="text-sm text-purple-800 space-y-1">
                                <p class="font-medium">Verifikasi 1–3 hari kerja</p>
                                <p class="text-purple-600">Setelah disetujui, Anda akan mendapat email berisi akses Plan Pro gratis selama 6 bulan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" :disabled="loading"
                            class="w-full py-3 px-4 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold rounded-xl transition-all disabled:opacity-60 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                            :class="loading ? 'opacity-70 cursor-not-allowed' : ''">
                        <template x-if="loading">
                            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </template>
                        <span x-text="loading ? 'Mengirim...' : 'Kirim Permohonan'"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

