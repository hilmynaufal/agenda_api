---
name: Siagan Bedas Admin
description: Admin panel formal untuk pengelolaan agenda pimpinan, diturunkan dari bahasa visual aplikasi mobile Siagan Bedas
colors:
  registry-teal: "#088C91"
  registry-teal-deep: "#0F686B"
  registry-teal-wash: "#DDEEEE"
  paper-white: "#FBFCFC"
  ink-teal: "#0B2628"
  registry-fog: "#EEEEEE"
  slate-label: "#9E9E9E"
  divider-mist: "#E4E7E7"
  status-pending: "#FFC107"
  status-pending-wash: "#FFF3D6"
  status-delegated: "#9C55B5"
  status-delegated-wash: "#F1E3F6"
  status-attended: "#088C91"
  status-attended-wash: "#DDEEEE"
  action-confirm: "#2E7D32"
  action-confirm-wash: "#E4F2E5"
  action-edit: "#1E6FBF"
  action-delete: "#B3261E"
typography:
  headline:
    fontFamily: "Poppins, sans-serif"
    fontSize: "20px"
    fontWeight: 600
    lineHeight: 1.3
    letterSpacing: "normal"
  title:
    fontFamily: "Poppins, sans-serif"
    fontSize: "16px"
    fontWeight: 600
    lineHeight: 1.35
    letterSpacing: "normal"
  body:
    fontFamily: "Poppins, sans-serif"
    fontSize: "14px"
    fontWeight: 400
    lineHeight: 1.5
    letterSpacing: "normal"
  label:
    fontFamily: "Poppins, sans-serif"
    fontSize: "11px"
    fontWeight: 500
    lineHeight: 1.3
    letterSpacing: "0.02em"
rounded:
  sm: "6px"
  md: "10px"
  pill: "999px"
spacing:
  xs: "4px"
  sm: "8px"
  md: "16px"
  lg: "24px"
components:
  button-primary:
    backgroundColor: "{colors.registry-teal}"
    textColor: "#FFFFFF"
    rounded: "{rounded.md}"
    padding: "12px 20px"
  button-primary-hover:
    backgroundColor: "{colors.registry-teal-deep}"
    textColor: "#FFFFFF"
    rounded: "{rounded.md}"
    padding: "12px 20px"
  button-confirm:
    backgroundColor: "{colors.action-confirm}"
    textColor: "#FFFFFF"
    rounded: "{rounded.md}"
    padding: "12px 20px"
  button-delete:
    backgroundColor: "{colors.action-delete}"
    textColor: "#FFFFFF"
    rounded: "{rounded.md}"
    padding: "12px 20px"
  badge-pending:
    backgroundColor: "{colors.status-pending-wash}"
    textColor: "{colors.status-pending}"
    rounded: "{rounded.pill}"
    padding: "4px 12px"
  badge-delegated:
    backgroundColor: "{colors.status-delegated-wash}"
    textColor: "{colors.status-delegated}"
    rounded: "{rounded.pill}"
    padding: "4px 12px"
  badge-attended:
    backgroundColor: "{colors.status-attended-wash}"
    textColor: "{colors.status-attended}"
    rounded: "{rounded.pill}"
    padding: "4px 12px"
  input-field:
    backgroundColor: "{colors.registry-fog}"
    textColor: "{colors.ink-teal}"
    rounded: "{rounded.md}"
    padding: "12px 16px"
---

# Design System: Siagan Bedas Admin

## 1. Overview

**Creative North Star: "The Registry Desk"**

Bayangkan meja registrasi di kantor kabupaten: rapi, resmi, setiap map dan status punya tempatnya sendiri, tidak ada yang berteriak untuk mendapat perhatian kecuali memang sedang menunggu tindakan. Admin panel ini adalah versi digital dari meja itu — dipakai ajudan di jam kerja, di layar desktop, untuk memindai status agenda secepat mungkin lalu bertindak.

Sistem ini diturunkan langsung dari aplikasi mobile Siagan Bedas yang sudah berjalan (Material 3, seed warna teal gelap `#00686C`, tipografi Poppins), bukan dibangun dari nol. Admin panel harus terasa sebagai kelanjutan sistem yang sama, bukan tool generik yang kebetulan mengelola data yang sama. Yang ditolak secara eksplisit: tampilan admin panel generik/out-of-the-box — ikon default, tanpa identitas warna, terasa seperti template yang belum disentuh.

Satu pergeseran disengaja dari app mobile: di mobile, badge status dan tombol aksi memakai warna solid penuh (amber pekat, ungu pekat). Di web, versi ini bergeser ke lebih tonal/halus — warna solid dipakai untuk teks/ikon, bukan untuk mengisi seluruh permukaan — supaya terasa lebih tenang di layar besar yang menampilkan banyak baris data sekaligus.

**Key Characteristics:**
- Radius 10px konsisten di card, badge, input, tombol — satu bahasa bentuk, tanpa variasi
- Status selalu dikomunikasikan lewat warna badge tonal + label teks, tidak pernah lewat ikon saja
- Poppins tunggal untuk semua level teks, dibedakan lewat berat huruf, bukan pergantian font
- Shadow tipis khas Material dipertahankan dari app mobile, bukan flat total

## 2. Colors

Palet penuh (bukan satu aksen terbatas) karena tugas inti aplikasi ini — memindai status agenda — butuh beberapa peran warna yang berbeda dan sengaja dipakai bersamaan.

### Primary
- **Registry Teal** (#088C91): Warna identitas utama, diturunkan dari seed Material 3 app mobile (`#00686C`). Dipakai untuk aksi utama, heading kartu, dan status "Dihadiri oleh Bupati" — persis peran `theme.primaryColor` di app mobile.
- **Deep Registry Teal** (#0F686B): Versi lebih gelap untuk state hover/pressed pada elemen primary.

### Secondary
- **Pale Teal Wash** (#DDEEEE): Latar tonal lembut untuk badge status "attended" dan area highlight ringan.

### Tertiary (status semantik)
- **Amber Pending** (#FFC107) di atas **Amber Wash** (#FFF3D6): Status "Belum Dikonfirmasi" — sama seperti `Colors.amber` di app mobile, dilembutkan jadi tonal.
- **Muted Violet** (#9C55B5) di atas **Violet Wash** (#F1E3F6): Status "Diwakilkan" — turunan dari `Colors.purple.shade300` di app mobile, dilembutkan jadi tonal.
- **Confirm Green** (#2E7D32): Aksi konfirmasi/terima, turunan dari `Colors.green` yang dipakai tombol "Hadiri" di app mobile.
- **Working Blue** (#1E6FBF): Aksi edit, turunan dari `Colors.blue.shade400`.
- **Alert Red** (#B3261E): Aksi hapus/tolak — warna error standar Material 3, tetap solid dan tidak ditonalkan (tindakan destruktif tidak boleh terlihat lembut).

### Neutral
- **Paper White** (#FBFCFC): Latar halaman/permukaan utama — putih dengan sedikit sentuhan dingin, bukan putih murni.
- **Ink Teal** (#0B2628): Warna teks utama — hitam-kehijauan gelap, bukan `#000` murni, konsisten dengan hue teal sistem.
- **Registry Fog** (#EEEEEE): Latar input field saat idle, turunan `Colors.grey.shade200` di app mobile.
- **Slate Label** (#9E9E9E): Teks label/placeholder sekunder, turunan `Colors.grey.shade500`.
- **Divider Mist** (#E4E7E7): Garis pemisah antar baris tabel/section.

### Named Rules
**The Tonal Shift Rule.** Badge status dan chip memakai latar wash + teks/ikon warna penuh, bukan latar warna penuh seperti di app mobile. Tombol aksi primer boleh tetap solid. Aksi destruktif (hapus) selalu solid merah, tidak pernah ditonalkan.

## 3. Typography

**Display/Body/Label Font:** Poppins (fallback: system sans-serif)

**Character:** Geometris, hangat tapi tetap rapi — sama seperti pilihan font app mobile. Satu keluarga font untuk seluruh hierarki; pembeda level adalah berat huruf (300–600), bukan pergantian typeface.

### Hierarchy
- **Headline** (600, 20px, line-height 1.3): Judul halaman/section di admin panel (mis. "Kelola Agenda").
- **Title** (600, 16px, line-height 1.35): Judul kartu/baris utama — setara `titleLarge` yang dipakai untuk nama acara di app mobile.
- **Body** (400, 14px, line-height 1.5, maks ~70ch): Teks konten umum, deskripsi, isi form.
- **Label** (500, 11px, letter-spacing 0.02em): Label status, meta info kecil (tanggal, badge) — setara `bodySmall` di app mobile yang dipakai untuk tanggal dan status.

### Named Rules
**The One Family Rule.** Tidak ada font kedua. Setiap kebutuhan hierarki diselesaikan dengan berat huruf (300 ringan, 400 body, 500 label, 600 judul), persis pola yang sudah dipakai app mobile.

## 4. Elevation

Mengikuti gaya Material Card asli dari app mobile: permukaan sebagian besar flat, tapi kartu (agenda, form section) memakai shadow tipis untuk memisahkan dari latar halaman — bukan flat total, bukan juga elevasi berlapis-lapis. Shadow dihitung dengan tint warna ink teal, bukan hitam murni, supaya menyatu dengan palet.

### Shadow Vocabulary
- **card-resting** (`box-shadow: 0 1px 2px rgba(11,38,40,0.06), 0 1px 3px rgba(11,38,40,0.10)`): Shadow default untuk card/table container saat diam.
- **card-hover** (`box-shadow: 0 2px 4px rgba(11,38,40,0.08), 0 4px 8px rgba(11,38,40,0.12)`): Saat card/row diklik-hover, sedikit terangkat.

### Named Rules
**The Thin Shadow Rule.** Shadow selalu tipis dan tinted teal, tidak pernah hitam pekat atau tersebar lebar. Kedalaman itu petunjuk kecil, bukan efek dekoratif.

## 5. Components

### Buttons
- **Shape:** Radius 10px (`{rounded.md}`), sama seperti card dan input — satu bahasa bentuk di seluruh sistem.
- **Primary:** Latar Registry Teal (#088C91), teks putih, padding 12px 20px.
- **Semantic action buttons:** Setiap aksi punya warna sendiri yang konsisten lintas halaman — hijau untuk konfirmasi/terima, biru untuk edit, merah untuk hapus/tolak, ungu untuk wakilkan — meneruskan pola tombol aksi di detail agenda app mobile.
- **Hover/Focus:** Latar menggelap satu step (mis. Registry Teal → Deep Registry Teal), tanpa transform/scale berlebihan, transisi warna 150ms ease-out.

### Badges / Status Pills
- **Style:** Bentuk pil penuh (`{rounded.pill}`), latar wash + teks warna penuh sesuai status (lihat Tonal Shift Rule).
- **State:** Statis, tidak interaktif — murni penanda status. Tiga peran tetap: pending (amber), diwakilkan (violet), dihadiri (teal).

### Cards / Containers
- **Corner Style:** Radius 10px, konsisten dengan Named Rule "The Ten Rule" berikut.
- **Background:** Paper White, dengan Registry Fog untuk section yang butuh pemisahan halus tanpa garis.
- **Shadow Strategy:** `card-resting` saat diam, `card-hover` saat interaktif (lihat Elevation).
- **Border:** Tidak memakai border solid; pemisahan lewat shadow tipis dan white-space, bukan garis.
- **Catatan migrasi dari mobile:** Kartu agenda di app mobile memakai blok warna solid 16px di sisi kiri sebagai penanda status. Pola ini SENGAJA tidak dibawa ke web — lihat Do's and Don'ts.

### Inputs / Fields
- **Style:** Latar Registry Fog terisi penuh, tanpa border terlihat saat idle, radius 10px.
- **Focus:** Ring tipis Registry Teal 2px menggantikan border, latar tetap Registry Fog (bukan putih) — perubahan warna latar minimal, ring adalah sinyal utama.
- **Error/Disabled:** Error memakai ring Alert Red + teks keterangan merah di bawah field. Disabled menurunkan opacity teks ke Slate Label di atas latar Registry Fog yang lebih pudar.

### Navigation
- Sidebar dengan grup label kapital kecil (Label style), item aktif ditandai latar Pale Teal Wash + teks Registry Teal — bukan garis vertikal berwarna di tepi (lihat larangan side-stripe di Do's and Don'ts).

### Named Rules
**The Ten Rule.** Setiap permukaan interaktif — card, badge, tombol, input — memakai radius 10px. Tidak ada pengecualian, tidak ada "kartu besar" bersudut lebih tumpul atau elemen lain bersudut tajam.

## 6. Do's and Don'ts

### Do:
- **Do** pakai radius 10px di semua permukaan interaktif (The Ten Rule) — konsisten dengan card, badge, dan input di app mobile.
- **Do** komunikasikan status lewat badge tonal berwarna (amber/violet/teal) + label teks Bahasa Indonesia yang jelas, sesuai prinsip "Kejelasan status di atas dekorasi".
- **Do** pakai Poppins tunggal, bedakan hierarki lewat berat huruf saja.
- **Do** pertahankan shadow tipis tinted-teal pada card, meneruskan gaya Material Card app mobile.
- **Do** jaga aksi destruktif (hapus) tetap solid merah pekat, tidak ditonalkan seperti badge status lain.

### Don't:
- **Don't** gunakan aksen garis warna di tepi kiri/kanan card, list item, atau sidebar item (`border-left`/`border-right` tebal) — app mobile memakai blok warna solid di kartu agenda, tapi pola ini tidak dibawa ke web; ganti dengan badge tonal atau latar tint penuh.
- **Don't** biarkan tampilan terlihat generik/out-of-the-box Filament — ikon default, tanpa identitas warna Registry Teal, terasa seperti template yang belum disentuh. Ini anti-reference utama dari PRODUCT.md.
- **Don't** pakai gradient pada teks atau latar dekoratif — bukan bahasa visual sistem ini.
- **Don't** pakai badge/status hanya lewat ikon tanpa label teks — staf non-teknis harus bisa membaca status tanpa menghafal makna ikon.
- **Don't** campur beberapa family font — satu Poppins untuk semua, dibedakan lewat berat huruf.
- **Don't** buat modal sebagai langkah pertama untuk aksi sederhana (edit inline, konfirmasi ringan) — cadangkan modal untuk aksi yang benar-benar butuh konfirmasi eksplisit (hapus, wakilkan).
