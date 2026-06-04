<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>SINTING-FT | Sistem Voting Blockchain Fakultas Teknik</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
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
                        "headline-lg-mobile": ["Inter"],
                        "display-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "label-sm": ["Inter"]
                    },
                    "fontSize": {
                        "body-lg": ["18px", {"lineHeight": "28px", "fontWeight": "400"}],
                        "headline-md": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "label-md": ["14px", {"lineHeight": "20px", "letterSpacing": "0.01em", "fontWeight": "500"}],
                        "headline-lg": ["32px", {"lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600"}],
                        "headline-lg-mobile": ["24px", {"lineHeight": "32px", "fontWeight": "600"}],
                        "display-lg": ["48px", {"lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700"}],
                        "body-md": ["16px", {"lineHeight": "24px", "fontWeight": "400"}],
                        "label-sm": ["12px", {"lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600"}]
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-background text-on-background min-h-screen flex flex-col">
    <header class="bg-surface/80 backdrop-blur-md dark:bg-surface-container-low/80 docked full-width top-0 z-50 shadow-sm border-b border-outline-variant/10 flex justify-between items-center px-margin-desktop h-20 w-full fixed">
        <div class="flex items-center gap-3">
            <img alt="SINTING-FT Logo" class="h-10 w-10 object-contain" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAABAAAAAQACAYAAAB/HSuDAAAQAElEQVR4AezdCXyjR3n48eeRLzknJIGE+2iAkgL/hN21tOFIdr2BFij3fd/lJhRCKZSbAoUUQrlKW6DcEGghUAJhJTsJIVlvNoQzLUe5IQk3ocR67bXmP+PdsOtd23olvcfMOz99pF1bmnfmeb4jS+88el+7JlwQQAABBBBAAAEEEEAAAQQQKLUAlYAKKDUkxCAAAEEEEAAAQQQQAABBBBAQEQBAE+CBBBAAAEEEEAAAQQQQAABBKosYBPkCAALwBUBBBBAAAEEEEAAAQQQQACBqgu43CgAOAVuCCCAAAIIIIAAAggggAACCFS3wHJmFAGWGfgHAQQQQAABBBBAAAEEEEAAgSoK7MmLAsAeB/5FAAEEEEAAAQQQQAABBBBAoJoCe7OiALAXgv8QQAABBBBAAAEEEEAAAQQQqKLAdfnRAHhdgv8RQAABBBBAAAEEEEAAAQQQqJ7AHzOiAPBHCr5AAAEEEEAAAQQQQAABBBBAoGoC+/KhALDPgq8QQAABBBBAAAEEEEAAAQQQqJbAftnQANgPgy8RQAABBBBAAAEEEEAAAQQQqJLA/rkQANhfg68RQAABBBBAAAEEEEAAAQQQqI7AigwoAKzg4BsEEEAAAQQQQAABBBBAAAEEqiKwMg8KACs9+A4BBBBAAAEEEEAAAQQQQACBaggckAUFgANA+BYBBBBAAAEEEEAAAQQQQACBKggcmAMFgANF+B4BBBBAAAEEEEAAAQQQQACBcAXyoABwkAh3IIAAAggggAACCCCAAAIIIBCAQIEP/b/BwEAAAAASUVORK5CYII="/>
            <span class="font-headline-md text-headline-md font-bold text-primary dark:text-primary-fixed-dim">SINTING-FT</span>
        </div>
        <nav class="hidden md:flex items-center gap-8">
            <a class="text-primary dark:text-primary-fixed-dim font-bold border-b-2 border-primary dark:border-primary-fixed-dim pb-1 font-label-md text-label-md" href="#">Home</a>
            <a class="text-on-surface-variant dark:text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 font-label-md text-label-md" href="#">Registrasi</a>
            <a class="text-on-surface-variant dark:text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 font-label-md text-label-md" href="#">Admin</a>
        </nav>
        <button class="bg-primary-container text-on-primary-container px-6 py-2.5 rounded-full font-label-md text-label-md font-bold hover:opacity-90 active:scale-95 transition-all duration-150 shadow-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-[20px]" style="font-variation-settings: 'FILL' 1;">account_balance_wallet</span>
            Connect Wallet
        </button>
    </header>

    <main class="flex-grow flex flex-col pt-20">
        <div class="flex-grow grid grid-cols-1 md:grid-cols-2">
            <section class="hidden md:flex flex-col justify-center items-center p-2xl bg-surface-container-low relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 pointer-events-none">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-primary rounded-full blur-[120px] -mr-48 -mt-48"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-secondary rounded-full blur-[100px] -ml-32 -mb-32"></div>
                </div>
                <div class="relative z-10 max-w-lg text-center">
                    <div class="mb-12">
                        <img alt="Mahasiswa Teknik dan Teknologi Blockchain" class="w-full h-auto rounded-[32px] shadow-2xl" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAf8PqwO8QVg9giBPQAtGMW30HWZJav6iFkMFJ5FMSDIY0CkPIglthTe4BVejirV1F_0eqZTG8E5pyLESRN86qnkoLHmmvmcei342aT8DOtIm1r-aJeiPGSvQVz4Grl7JT0G-oNdei8aKZfM_v7T8iupFiPDtl5_MpTzXyZX-j3tFhfsJs2gCDI0d-8tAJZ5MesPIbZ1ASv7f9vjaDlziM_Ji83mNieGWQUggnap1Wec04fJkbj1OQ5vgQ9NfPSSWa5W6ORK4_wiGs"/>
                    </div>
                    <h1 class="font-display-lg text-display-lg text-primary mb-4 leading-tight">Transparansi Suara Anda Berawal di Sini.</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant">Sistem pemungutan suara berbasis blockchain yang aman, terdesentralisasi, dan khusus dirancang untuk Fakultas Teknik.</p>
                </div>
            </section>

            <section class="flex flex-col justify-center items-center p-margin-mobile md:p-2xl bg-white">
                <div class="w-full max-w-md">
                    <div class="mb-8 text-center md:text-left">
                        <h2 class="font-headline-lg text-headline-lg text-on-surface mb-2">Selamat datang di Sistem Informasi E-Voting Berbasis Blockchain Fakultas Teknik Universitas Lambung Mangkurat</h2>
                        <p class="font-body-md text-body-md text-on-surface-variant">Silakan masuk menggunakan akun SIMARI Anda untuk memulai voting.</p>
                    </div>

                    <!-- BLOK ERROR MESSAGE AGAR KETAHUAN JIKA PASSWORD SALAH -->
                    @if(session('error'))
                        <div class="bg-error-container text-on-error-container px-4 py-3 rounded-xl mb-6 flex items-center gap-2 font-body-md shadow-sm border border-error/20">
                            <span class="material-symbols-outlined">error</span>
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <!-- METHOD DAN ACTION SUDAH DIPERBAIKI -->
                    <form class="space-y-6" method="POST" action="{{ route('login.process') }}">
                        @csrf
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant block ml-1" for="nim">Masukkan NIM</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">person</span>
                                <input name="nim" value="{{ old('nim') }}" class="w-full pl-12 pr-4 py-4 bg-white border border-outline-variant/30 rounded-xl focus:ring-4 focus:ring-primary-container/20 focus:border-primary outline-none transition-all font-body-md text-body-md" id="nim" placeholder="Contoh: 2106xxxxxx" type="text"/>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="font-label-md text-label-md text-on-surface-variant block ml-1" for="password">Password</label>
                            <div class="relative group">
                                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline group-focus-within:text-primary transition-colors">lock</span>
                                <input name="password" class="w-full pl-12 pr-4 py-4 bg-white border border-outline-variant/30 rounded-xl focus:ring-4 focus:ring-primary-container/20 focus:border-primary outline-none transition-all font-body-md text-body-md" id="password" placeholder="••••••••" type="password"/>
                            </div>
                        </div>
                        <div class="flex items-center justify-between py-2">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input name="remember" class="w-5 h-5 rounded border-outline text-primary focus:ring-primary-container" type="checkbox"/>
                                <span class="font-label-md text-label-md text-on-surface-variant group-hover:text-on-surface">Ingat Saya</span>
                            </label>
                        </div>
                        <button class="w-full bg-primary-container text-on-primary-container py-4 rounded-xl font-headline-md text-headline-md font-bold shadow-lg hover:shadow-xl active:scale-[0.98] transition-all flex justify-center items-center gap-2" type="submit">
                            Masuk
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </button>
                    </form>

                    <div class="mt-8 flex items-center gap-4 text-outline-variant">
                        <hr class="flex-grow border-outline-variant/30"/>
                        <span class="font-label-sm text-label-sm uppercase tracking-wider">Keamanan Web3</span>
                        <hr class="flex-grow border-outline-variant/30"/>
                    </div>
                    <div class="mt-8 grid grid-cols-2 gap-4">
                        <div class="p-4 rounded-2xl bg-surface-container-lowest border border-outline-variant/10 flex flex-col gap-2">
                            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">verified_user</span>
                            <h4 class="font-label-md text-label-md font-bold text-on-surface">Enkripsi End-to-End</h4>
                            <p class="font-label-sm text-label-sm text-on-surface-variant">Data anda dilindungi enkripsi standar industri.</p>
                        </div>
                        <div class="p-4 rounded-2xl bg-surface-container-lowest border border-outline-variant/10 flex flex-col gap-2">
                            <span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">account_tree</span>
                            <h4 class="font-label-md text-label-md font-bold text-on-surface">Validasi Blockchain</h4>
                            <p class="font-label-sm text-label-sm text-on-surface-variant">Suara tercatat permanen di jaringan blockchain.</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer class="bg-surface-container-low dark:bg-surface-container-lowest w-full relative bottom-0 border-t border-outline-variant/10 py-xl px-margin-desktop flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex flex-col items-center md:items-start gap-2">
            <span class="font-headline-md text-headline-md font-bold text-primary">SINTING-FT</span>
            <p class="font-body-md text-body-md text-on-surface-variant text-center md:text-left">© 2024 Faculty of Engineering. SINTING-FT Blockchain Voting System.</p>
        </div>
        <div class="flex flex-wrap justify-center gap-8">
            <a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Privacy Policy</a>
            <a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Terms of Service</a>
            <a class="font-label-sm text-label-sm text-on-surface-variant hover:text-primary transition-colors" href="#">Help Center</a>
        </div>
        <div class="flex gap-4">
            <div class="w-10 h-10 rounded-full bg-surface-container-high flex items-center justify-center text-on-surface-variant hover:bg-primary-container hover:text-on-primary-container transition-all cursor-pointer">
                <span class="material-symbols-outlined text-[20px]">language</span>
            </div>
        </div>
    </footer>
    <script>
        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('mousedown', () => button.style.transform = 'scale(0.95)');
            button.addEventListener('mouseup', () => button.style.transform = 'scale(1)');
            button.addEventListener('mouseleave', () => button.style.transform = 'scale(1)');
        });

        const illustration = document.querySelector('section.hidden img');
        if(illustration) {
            window.addEventListener('mousemove', (e) => {
                const moveX = (e.clientX - window.innerWidth / 2) * 0.01;
                const moveY = (e.clientY - window.innerHeight / 2) * 0.01;
                illustration.style.transform = `translate(${moveX}px, ${moveY}px)`;
            });
        }
    </script>
</body>
</html>
