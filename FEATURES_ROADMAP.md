# Fitur Belum Diterapkan - Ref LYNK.id

Daftar fitur yang terlihat di referensi LYNK.id tapi **belum diimplementasikan** di project EtalaseKu. Ditulis ulang setelah rombak dashboard seller (Juni 2026).

---

## 1. Custom Background / Appearance (Page Style)

**Deskripsi:** Fitur untuk customize tampilan halaman publik seller:
- Custom background (gambar/warna/pattern)
- Page layout style (Classic / Modern / Clean)
- Banner image upload
- Profile image dengan preview langsung
- About section untuk halaman publik
- Enable/disable member area menu

**Status:** `BELUM` - Perlu新增 database column + upload handler + preview rendering

**File yang perlu diubah:**
- `seller/store/edit.blade.php` — tambah section Appearance
- `Store` model — tambah field `background_color`, `background_image`, `banner_image`, `page_layout`
- Migration baru

---

## 2. Statistik Halaman Lanjutan

**Deskripsi:** Detail statistik yang ada di referensi:
- Social icons clicks (WhatsApp, Instagram, dll)
- Sales distribution (Total Sales, Net Value, Affiliate IDR)
- Top 5 Sales by Product
- Date range picker untuk statistik
- Social links management di Appearance

**Status:** `BELUM` — tabel `analytics` sudah ada, tapi fitur di halaman Statistics belum lengkap

**Yang perlu dilakukan:**
- Tambah endpoint/method di `DashboardController` untuk social clicks
- Tambah halaman statistik detail atau expand halaman Statistics yang ada
- Social links di Appearance page

---

## 3. Marketing Tools Menu (Coming Soon)

**Deskripsi:** Menu di sidebar untuk fitur marketing yang belum aktif:
- Affiliates
- E-Mail Marketing
- WhatsApp Blast
- Clip Campaign
- Automate Workflow (Beta)
- Vouchers

**Status:** `SUDAH` ditambahkan di sidebar (tampil sebagai link non-aktif), belum ada fungsionalitas

**Yang perlu dilakukan:**
- Buat controller + route per fitur
- Badge "Soon" / "Beta" sudah display di sidebar

---

## 4. Multi Admin

**Deskripsi:** Fitur untuk mendelegasikan akses ke sub-user.

**Status:** `BELUM` — placeholder card sudah ada di settings

**Yang perlu dilakukan:**
- `MultiAdmin` model + migration
- `MultiAdminMiddleware`
- UI untuk invite + manage sub-user

---

## 5. Earnings / Payout Detail

**Deskripsi:** Halaman payout dengan:
- Withdraw earnings
- Bank account setting
- PayMe link
- Verify account untuk activate payout

**Status:** `BELUM` — hanya placeholder link

**Yang perlu dilakukan:**
- `PayoutSetting` model
- Halaman payout settings
- Midtrans/e-wallet integration untuk pencairan

---

## 6. Integrations (Google Calendar, Webhooks)

**Deskripsi:** Koneksi dengan layanan eksternal:
- Google Calendar sync
- Webhook untuk order notifications

**Status:** `BELUM` — placeholder card sudah ada

---

## 7. Blog Content& Course Video (Dashboard Buttons)

**Deskripsi:** Fitur creation buttons di dashboard:
- Blog Content
- Course Video

**Status:** `BELUM` — tombol sudah ada tapi belum ada route/handler

**Yang perlu dilakukan:**
- `BlogController` + `CourseController`
- Model `BlogPost` + `Course`
- Halaman create/list

---

## 8. Affiliate Products Tracking

**Deskripsi:** Sistem affiliate dengan:
- Affiliate products count
- Affiliate IDR earnings
- Affiliate link generation

**Status:** `BELUM` — hanya placeholder stat card

---

## 9. Advance Settings (Google Analytics, Facebook Pixel)

**Deskripsi:** Tracking integration:
- Google Analytics ID
- Facebook Pixel ID

**Status:** `BELUM` — placeholder card sudah ada

**Yang perlu dilakukan:**
- `Store` model tambah `google_analytics_id`, `facebook_pixel_id`
- Insert tracking script di layout halaman publik

---

## 10. Custom Domain

**Deskripsi:** Fitur untuk custom domain per store.

**Status:** `BELUM` — placeholder card sudah ada

**Yang perlu dilakukan:**
- DNS validation
- SSL handling
- Route subdomain wildcard

---

## Prioritas的建议

| Prioritas | Fitur | Alasan |
|----------|-------|--------|
| **Tinggi** | Custom Background/Appearance | Core differentiator vs kompetitor |
| **Tinggi** | Blog Content + Course Video | Meningkatkan engagement |
| **Sedang** | Affiliate system | Revenue stream baru |
| **Sedang** | Advance Settings (GA/FB Pixel) | Analytics penting untuk marketing |
| **Rendah** | E-Mail Marketing, WhatsApp Blast | Butuh infrastruktur email/WhatsApp API |
| **Rendah** | Custom Domain | Perlu hosting support |
