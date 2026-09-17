# Product

## Register

product

## Users

Ajudan dan staf OPD yang mengelola agenda pimpinan (Bupati) sehari-hari, bekerja di jam kantor dari desktop/laptop. Mereka sebelumnya harus mengedit data langsung lewat database karena tidak ada admin panel — tool ini menggantikan itu. Tugas utama pada sesi kerja mana pun: memantau dan mengonfirmasi status agenda (diterima/diwakilkan/pending), mengelola data pendamping yang menerima notifikasi WhatsApp, dan menelusuri log riwayat notifikasi untuk keperluan verifikasi/audit.

## Product Purpose

Admin panel internal untuk sistem agenda pimpinan "Siagan Bedas" (aplikasi mobile Flutter yang sudah berjalan untuk ajudan/pegawai). Backend ini menutup celah operasional: sebelumnya master data pendamping dan agenda hanya bisa diubah lewat query database langsung. Sukses berarti ajudan bisa mengelola seluruh data (agenda, pendamping, log WA) tanpa akses database, dengan kejelasan status yang setara dengan yang mereka lihat di aplikasi mobile.

## Brand Personality

Formal dan tegas — mencerminkan instansi pemerintah kabupaten, bukan produk konsumer. Tenang, rapi, dapat dipercaya. Tidak playful, tidak berusaha terlihat seperti startup. Nuansa visual mengikuti aplikasi mobile Siagan Bedas yang sudah ada (Material 3, seed warna teal gelap, tipografi Poppins) — admin panel harus terasa sebagai bagian dari sistem yang sama, bukan tool generik yang ditempel di sampingnya.

## Anti-references

Tampilan admin panel generik/out-of-the-box (scaffolding default Filament yang belum disesuaikan — ikon default, tanpa identitas warna/tipografi, terasa seperti template yang belum disentuh). Ini yang paling ingin dihindari: kesan "belum jadi" atau tidak terhubung dengan identitas Siagan Bedas.

## Design Principles

1. **Konsistensi dengan aplikasi mobile.** Bahasa visual (warna, tipografi) admin panel harus terasa sebagai perpanjangan dari aplikasi mobile Siagan Bedas yang sudah dipakai ajudan — bukan tool terpisah yang kebetulan mengelola data yang sama.
2. **Kejelasan status di atas dekorasi.** Tugas inti ajudan adalah memindai status agenda dengan cepat (diterima/diwakilkan/pending/dikonfirmasi). Status harus terbaca sekilas lewat warna dan label yang konsisten, bukan tersembunyi di balik ikon dekoratif.
3. **Formal dan dapat dipercaya.** Sebagai identitas instansi pemerintah, tampilan harus tenang dan resmi. Tidak ada elemen playful, gradient mencolok, atau nuansa "startup consumer app".
4. **Efisiensi kerja di atas estetika showcase.** Ini alat kerja harian, bukan halaman yang dipamerkan. Tabel padat informasi, alur minim klik, form yang tidak bertele-tele.
5. **Aksesibel bagi staf non-teknis.** Label dan istilah dalam Bahasa Indonesia yang jelas, tanpa jargon teknis, dengan kontras yang cukup untuk dibaca cepat di layar kantor.

## Accessibility & Inclusion

Standar WCAG AA: kontras warna teks/latar cukup, ukuran teks terbaca nyaman, target klik yang jelas. Tidak ada kebutuhan aksesibilitas khusus tambahan yang dikonfirmasi saat ini.
