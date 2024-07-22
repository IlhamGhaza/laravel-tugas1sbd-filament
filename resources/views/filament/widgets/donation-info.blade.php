<x-filament-widgets::widget>
    <x-filament::section>
       <style>
            .filament-main-content {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }

            .highlight {
                color: #ff6347;
                /* Warna merah tomat */
                font-weight: bold;
            }

            .link-blue {
                color: #1e90ff;
                /* Warna biru dodger */
            }

            .link-green {
                color: #32cd32;
                /* Warna hijau limau */
            }

            .link-orange {
                color: #ffa500;
                /* Warna oranye */
            }

            .link-purple {
                color: #800080;
                /* Warna ungu */
            }
        </style>
        <div class="p-4 bg-white shadow rounded-lg dark:bg-gray-800 dark:text-gray-200">
            <h2 class="text-lg font-semibold highlight">💖 Donasi</h2>
            <p class="mt-4">Support saya</p><br>

            <ul class="mt-4 space-y-2">
                <li>🧡 <a href="https://patreon.com/your-patreon" class="link-orange">Sponsori saya di Patreon</a></li>
                <li>⭐ <a href="https://github.com/IlhamGhaza/laravel-tugas1sbd-filament" class="link-blue">Ikuti dan star repository kami</a></li>
                <li>🐛 <a href="https://github.com/IlhamGhaza/laravel-tugas1sbd-filament/issues" class="link-green">Laporkan bug atau masalah</a></li>
                <li>🗣️ <a href="https://github.com/IlhamGhaza/laravel-tugas1sbd-filament" class="link-purple">Bantu terjemahkan paket kami</a></li>
                <li>🔧 <a href="https://github.com/IlhamGhaza/laravel-tugas1sbd-filament" class="link-blue">Mintalah fitur baru atau bantu saya
                        menyelesaikan satu</a></li>
            </ul>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
