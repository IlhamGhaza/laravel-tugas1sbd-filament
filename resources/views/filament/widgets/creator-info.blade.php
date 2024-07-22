<x-filament-widgets::widget>
    <x-filament::section>
        <style>
            .filament-main-content {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 16px;
            }

            .highlight {
                color: #1e90ff;
                /* Warna biru dodger */
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
            <h2 class="text-lg font-semibold highlight">🌟 Tentang Pembuat</h2>
            <p class="mt-4">Hai, saya adalah <span class="highlight">Ilham Ghaza</span>, seorang pengembang yang berdedikasi
                untuk menciptakan solusi inovatif dan bermanfaat bagi komunitas. Anda dapat mengetahui lebih banyak tentang saya
                dan proyek-proyek saya melalui tautan berikut:</p><br>
            <ul class="mt-4 space-y-2">
                <li>🔗 <a href="https://github.com/IlhamGhaza" class="link-blue">GitHub</a></li>
                <li>💼 <a href=https://www.linkedin.com/in/muhammadilhamghazali/" class="link-green">LinkedIn</a></li>
                {{-- <li>📘 <a href="https://your-website.com" class="link-purple">Blog Pribadi</a>: Baca artikel dan tutorial
                    yang saya tulis tentang pengembangan perangkat lunak, teknologi, dan lain-lain.</li> --}}
                <li>🐦 <a href="https://twitter.com/your-twitter" class="link-orange">Twitter</a></li>
            </ul>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
