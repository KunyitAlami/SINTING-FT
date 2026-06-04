<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Registrasi DPT - SINTING-FT</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-secondary": "#ffffff",
                        "inverse-on-surface": "#ecf1ff",
                        "surface-container-lowest": "#ffffff",
                        "primary-fixed-dim": "#7bd0ff",
                        "surface-bright": "#f9f9ff",
                        "tertiary-fixed": "#e1e0ff",
                        "secondary-fixed": "#ffe083",
                        "primary": "#00668a",
                        "on-primary-fixed": "#001e2c",
                        "on-tertiary-fixed-variant": "#2f2ebe",
                        "on-primary": "#ffffff",
                        "on-primary-fixed-variant": "#004c69",
                        "on-surface-variant": "#3e484f",
                        "inverse-surface": "#263143",
                        "surface-container-low": "#f0f3ff",
                        "outline": "#6e7980",
                        "on-tertiary-container": "#2b29bb",
                        "background": "#f9f9ff",
                        "on-background": "#111c2d",
                        "on-tertiary-fixed": "#07006c",
                        "on-secondary-fixed-variant": "#574500",
                        "on-secondary-fixed": "#231b00",
                        "on-error-container": "#93000a",
                        "primary-fixed": "#c4e7ff",
                        "error": "#ba1a1a",
                        "surface": "#f9f9ff",
                        "secondary-fixed-dim": "#eec200",
                        "secondary": "#735c00",
                        "on-secondary-container": "#6f5900",
                        "surface-container": "#e7eeff",
                        "surface-variant": "#d8e3fb",
                        "secondary-container": "#fed01b",
                        "on-primary-container": "#004965",
                        "on-surface": "#111c2d",
                        "on-tertiary": "#ffffff",
                        "primary-container": "#38bdf8",
                        "surface-tint": "#00668a",
                        "surface-dim": "#cfdaf2",
                        "on-error": "#ffffff",
                        "surface-container-highest": "#d8e3fb",
                        "tertiary-fixed-dim": "#c0c1ff",
                        "surface-container-high": "#dee8ff",
                        "inverse-primary": "#7bd0ff",
                        "outline-variant": "#bdc8d1",
                        "tertiary-container": "#a7a9ff",
                        "tertiary": "#494bd6",
                        "error-container": "#ffdad6"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                    "spacing": {
                        "base": "4px",
                        "xs": "4px",
                        "sm": "8px",
                        "margin-mobile": "16px",
                        "xl": "32px",
                        "2xl": "48px",
                        "3xl": "64px",
                        "lg": "24px",
                        "md": "16px",
                        "margin-desktop": "40px",
                        "gutter": "24px"
                    },
                    "fontFamily": {
                        "body-lg": ["Inter"],
                        "headline-md": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "display-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "label-sm": ["Inter"]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .glass-effect {
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .ambient-shadow {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.05);
        }
        .hover-shadow:hover {
            box-shadow: 0px 10px 30px rgba(56, 189, 248, 0.1);
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
    <header class="fixed top-0 z-50 w-full h-20 bg-surface/80 backdrop-blur-md dark:bg-surface-container-low/80 border-b border-outline-variant/10 shadow-sm flex justify-between items-center px-margin-desktop">
        <div class="flex items-center gap-2">
            <span class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed-dim">SINTING-FT</span>
        </div>
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-on-surface-variant dark:text-on-surface-variant font-medium hover:text-primary transition-colors duration-200" href="#">Home</a>
            <a class="text-primary dark:text-primary-fixed-dim font-bold border-b-2 border-primary dark:border-primary-fixed-dim pb-1" href="#">Registrasi</a>
            <a class="text-on-surface-variant dark:text-on-surface-variant font-medium hover:text-primary transition-colors duration-200" href="#">Admin</a>
        </nav>
        <button class="bg-primary text-on-primary px-6 py-2.5 rounded-lg font-label-md hover:opacity-90 active:scale-95 transition-all flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]" data-icon="account_balance_wallet">account_balance_wallet</span>
            Connect Wallet
        </button>
    </header>

    <main class="flex-grow pt-32 pb-2xl px-margin-mobile md:px-margin-desktop max-w-[1280px] mx-auto w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-gutter">
            <section class="lg:col-span-7">
                <div class="mb-xl">
                    <h1 class="font-headline-lg text-headline-lg text-on-surface mb-sm">Pendaftaran DPT</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Pastikan data yang Anda masukkan sesuai dengan identitas akademik resmi Anda untuk diverifikasi di sistem blockchain.</p>
                </div>
                <div class="bg-surface-container-lowest border border-outline-variant/20 rounded-[24px] p-xl ambient-shadow">

                    <form class="space-y-lg" method="POST" action="" onsubmit="event.preventDefault();">
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant ml-1">Nama Lengkap</label>
                            <input name="nama" class="w-full bg-white border border-outline-variant/30 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all font-body-md" placeholder="Masukkan nama sesuai KTM" type="text"/>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant ml-1">NIM (Nomor Induk Mahasiswa)</label>
                            <input name="nim_reg" class="w-full bg-white border border-outline-variant/30 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all font-body-md" placeholder="Contoh: 210601..." type="text"/>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant ml-1">Alamat Wallet MetaMask</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-outline" data-icon="link">link</span>
                                <input name="wallet_address" class="w-full bg-white border border-outline-variant/30 rounded-xl pl-12 pr-4 py-3 focus:ring-2 focus:ring-primary-container focus:border-primary outline-none transition-all font-body-md" placeholder="0x..." type="text"/>
                            </div>
                            <p class="font-label-sm text-label-sm text-outline mt-1 italic">Pastikan alamat wallet ini aktif untuk proses pemungutan suara nantinya.</p>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="w-full bg-primary-container text-on-primary-container font-headline-md py-4 rounded-xl hover:shadow-lg active:scale-[0.98] transition-all flex justify-center items-center gap-3">
                                <span class="material-symbols-outlined" data-icon="how_to_reg">how_to_reg</span>
                                Daftarkan Diri
                            </button>
                        </div>
                    </form>

                </div>
            </section>

            <section class="lg:col-span-5 space-y-gutter">
                <div class="bg-surface-container-high border border-outline-variant/10 rounded-[24px] p-xl ambient-shadow">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="bg-primary/10 p-2 rounded-lg">
                            <span class="material-symbols-outlined text-primary" data-icon="person_search">person_search</span>
                        </div>
                        <h2 class="font-headline-md text-headline-md">Cek Status DPT</h2>
                    </div>
                    <div class="space-y-md">
                        <p class="font-body-md text-body-md text-on-surface-variant">Periksa apakah alamat wallet Anda sudah terdaftar dalam Daftar Pemilih Tetap.</p>
                        <div class="space-y-3">
                            <input class="w-full bg-white border border-outline-variant/30 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary outline-none transition-all font-body-md" placeholder="Masukkan Alamat Wallet (0x...)" type="text"/>
                            <button type="button" class="w-full bg-primary text-on-primary font-label-md py-3.5 rounded-xl hover:opacity-90 active:scale-95 transition-all">
                                Cek Status
                            </button>
                        </div>
                    </div>
                    <div class="mt-6 p-4 bg-white/50 rounded-xl border border-outline-variant/20 hidden" id="statusResult">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-green-600" data-icon="check_circle" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                            <div>
                                <p class="font-label-md text-green-800">Terverifikasi</p>
                                <p class="font-label-sm text-on-surface-variant">Anda sudah terdaftar sebagai pemilih sah.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-outline-variant/20 rounded-[24px] p-xl ambient-shadow hover-shadow transition-all group">
                    <div class="relative overflow-hidden rounded-xl mb-6 aspect-video">
                        <img alt="Blockchain Security" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAmhKEHSbDvZnHs99m-6BKT2RdCehqCOBoDGsL-YMBqj2OC8FLENoJfHcxnnMZs0RyQH-6XoDTE4dlBHDiAOiUqIh4MDvtTW7lCVERaBK3B94jrEyeVyTcwcDMLoW15U5FgmHiZswQRypzFdrLZcJLQx-I80HrGum-yNdb3ZHIvlkeqTnRqtwv1Zu6Rd-O1175uSt20VrwjT5f9ezQD3yueDlRFtrYsKLTK95PRP2VlL8iS-38tRNs3Hh4ryCEidLgAHGOhrhtrgTU"/>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    </div>
                    <h3 class="font-headline-md text-headline-md mb-2">Mengapa Blockchain?</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant">SINTING-FT menggunakan teknologi Web3 untuk menjamin bahwa setiap suara tidak dapat diubah, anonim, dan dapat diaudit secara publik oleh seluruh civitas akademika.</p>
                </div>
            </section>
        </div>
    </main>

    <footer class="w-full relative bottom-0 bg-surface-container-low dark:bg-surface-container-lowest border-t border-outline-variant/10 py-xl px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-lg">
        <div class="flex flex-col items-center md:items-start">
            <span class="font-headline-md text-headline-md font-bold text-primary">SINTING-FT</span>
            <p class="font-body-md text-body-md text-on-surface-variant mt-1">© 2024 Faculty of Engineering. Blockchain Voting System.</p>
        </div>
        <div class="flex gap-8">
            <a class="text-on-surface-variant hover:text-primary transition-colors font-label-sm" href="#">Privacy Policy</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors font-label-sm" href="#">Terms of Service</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors font-label-sm" href="#">Help Center</a>
        </div>
    </footer>
    <script>
        document.querySelector('button:contains("Cek Status")')?.addEventListener('click', function() {
            const result = document.getElementById('statusResult');
            result.classList.remove('hidden');
            result.classList.add('animate-pulse');
            setTimeout(() => {
                result.classList.remove('animate-pulse');
            }, 1000);
        });

        const buttons = document.querySelectorAll('button');
        buttons.forEach(btn => {
            if(btn.innerText.includes('Cek Status')) {
                btn.addEventListener('click', () => {
                    const result = document.getElementById('statusResult');
                    result.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
