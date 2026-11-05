<x-filament::page>
    @php
        $labels = [
            'open' => ['Terhubung', 'text-success-700 bg-success-100'],
            'connecting' => ['Menunggu pemindaian QR', 'text-warning-700 bg-warning-100'],
            'close' => ['Terputus', 'text-danger-700 bg-danger-100'],
            'not_found' => ['Instance belum dibuat', 'text-gray-700 bg-gray-100'],
            'unconfigured' => ['Belum dikonfigurasi', 'text-gray-700 bg-gray-100'],
            'error' => ['Server tidak dapat dihubungi', 'text-danger-700 bg-danger-100'],
        ];
        [$label, $kelas] = $labels[$state] ?? ['Tidak diketahui', 'text-gray-700 bg-gray-100'];
    @endphp

    <div class="space-y-6" @if ($qr) wire:poll.4s="refreshState" @endif>
        <div class="p-6 bg-white rounded-xl shadow space-y-4 dark:bg-gray-800">
            <div class="flex flex-wrap items-center gap-3">
                <span class="px-3 py-1 text-sm font-medium rounded-full {{ $kelas }}">{{ $label }}</span>
                <span class="text-sm text-gray-500">Instance: <code>{{ $this->instanceName }}</code></span>
                <span class="text-sm text-gray-500">Pengirim aktif: <strong>{{ $this->driverAktif }}</strong></span>
            </div>

            @if ($state === 'unconfigured')
                <p class="text-sm text-gray-600">
                    Isi <code>EVOLUTION_URL</code>, <code>EVOLUTION_API_KEY</code>, dan <code>EVOLUTION_INSTANCE</code>
                    di file <code>.env</code> server, lalu muat ulang halaman ini.
                </p>
            @endif

            @if ($this->driverAktif !== 'Evolution API' && $state !== 'unconfigured')
                <p class="text-sm text-warning-700">
                    Pesan masih dikirim lewat {{ $this->driverAktif }}. Setelah terhubung, ubah <code>WA_DRIVER=evolution</code> di <code>.env</code>.
                </p>
            @endif

            @if ($state !== 'unconfigured' && $state !== 'open')
                <div class="max-w-sm">
                    <label for="nomor" class="block mb-1 text-sm font-medium">Nomor WhatsApp yang akan dihubungkan</label>
                    <input id="nomor" type="tel" wire:model.defer="nomor" placeholder="08123456789"
                        class="block w-full border-gray-300 rounded-lg shadow-sm text-sm dark:bg-gray-700 dark:border-gray-600">
                    <p class="mt-1 text-xs text-gray-500">Wajib diisi agar koneksi berhasil. Format 08xx atau 628xx.</p>
                </div>
            @endif

            @if ($state !== 'unconfigured')
                <div class="flex flex-wrap gap-2">
                    <x-filament::button wire:click="refreshState" color="secondary" icon="heroicon-o-refresh">Cek Status</x-filament::button>

                    @if ($state === 'not_found')
                        <x-filament::button wire:click="buatInstance">Buat Instance</x-filament::button>
                    @elseif ($state !== 'open')
                        <x-filament::button wire:click="hubungkan" icon="heroicon-o-qrcode">Tampilkan QR</x-filament::button>
                    @endif

                    @if ($state !== 'not_found' && $state !== 'error')
                        <x-filament::button wire:click="restart" color="secondary">Restart</x-filament::button>
                    @endif

                    @if ($state === 'open')
                        <x-filament::button wire:click="putuskan" color="danger"
                            onclick="return confirm('Putuskan WhatsApp dari instance ini?') || event.stopImmediatePropagation()">Putuskan</x-filament::button>
                    @endif

                    @if (in_array($state, ['open', 'close', 'connecting'], true))
                        <x-filament::button wire:click="hapusInstance" color="danger"
                            onclick="return confirm('Hapus instance? Perangkat harus dipindai ulang.') || event.stopImmediatePropagation()">Hapus Instance</x-filament::button>
                    @endif
                </div>
            @endif
        </div>

        @if ($qr)
            <div class="p-6 bg-white rounded-xl shadow space-y-3 text-center dark:bg-gray-800">
                <img src="{{ $qr }}" alt="QR WhatsApp" class="mx-auto w-64 h-64">
                @if ($pairingCode)
                    <p class="text-sm text-gray-600">Kode pairing: <strong>{{ $pairingCode }}</strong></p>
                @endif
                <p class="text-sm text-gray-500">
                    Buka WhatsApp di ponsel → Perangkat tertaut → Tautkan perangkat → pindai kode ini.
                    QR kedaluwarsa dalam ±40 detik; klik "Tampilkan QR" untuk memuat ulang.
                </p>
            </div>
        @endif
    </div>
</x-filament::page>
