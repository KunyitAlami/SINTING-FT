<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SINTING-FT | Bilik Suara Mahasiswa</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/ethers@6.13.2/dist/ethers.umd.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
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
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        "2xl": "1.5rem",
                        full: "9999px"
                    },
                    spacing: {
                        base: "4px",
                        xs: "4px",
                        sm: "8px",
                        md: "16px",
                        lg: "24px",
                        xl: "32px",
                        "2xl": "48px",
                        "3xl": "64px",
                        gutter: "24px",
                        "margin-mobile": "16px",
                        "margin-desktop": "40px"
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
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
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9f9ff;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.84);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(189, 200, 209, 0.35);
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cfdaf2;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-background text-on-surface">
    <nav class="fixed top-0 z-50 w-full h-20 flex justify-between items-center px-margin-mobile md:px-margin-desktop bg-surface/80 backdrop-blur-md border-b border-outline-variant/10 shadow-sm">
        <div class="flex items-center gap-sm">
            <span class="font-headline-md text-2xl font-extrabold text-primary">SINTING-FT</span>
        </div>

        <div class="hidden md:flex items-center gap-xl">
            <a class="text-primary font-bold border-b-2 border-primary pb-1 font-label-md" href="#home">Home</a>
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 font-label-md" href="#voting-area">Bilik Suara</a>
            <a class="text-on-surface-variant font-medium hover:text-primary transition-colors duration-200 font-label-md" href="#status-area">Status</a>
        </div>

        <div class="flex items-center gap-sm">
            <button
                onclick="connectWallet()"
                id="connectWalletBtn"
                class="bg-secondary-container text-on-secondary-container font-bold px-lg py-sm rounded-lg shadow-sm hover:brightness-95 active:scale-95 transition-all duration-150 flex items-center gap-2"
            >
                <span class="material-symbols-outlined text-[20px]">account_balance_wallet</span>
                Connect Wallet
            </button>

            <form action="{{ route('logout') }}" method="POST" class="hidden sm:block">
                @csrf
                <button type="submit" class="bg-surface-container-high text-on-surface-variant font-bold px-md py-sm rounded-lg hover:bg-surface-variant transition-all">
                    Logout
                </button>
            </form>
        </div>
    </nav>

    <main id="home" class="pt-32 pb-2xl px-margin-mobile md:px-margin-desktop max-w-[1280px] mx-auto">
        <div id="alertBox" class="hidden mb-xl px-5 py-4 rounded-xl font-medium border"></div>

        <section class="grid grid-cols-1 lg:grid-cols-12 gap-gutter mb-3xl">
            <div class="lg:col-span-7 bg-white p-xl rounded-2xl border border-outline-variant/10 shadow-sm flex flex-col justify-center">
                <div class="flex items-center gap-sm mb-md">
                    <span class="flex h-3 w-3 relative">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    <span class="font-label-sm text-green-700 bg-green-50 px-sm py-xs rounded-full uppercase font-bold">
                        Pemilihan Aktif
                    </span>
                </div>

                <h1 class="font-display-lg text-4xl md:text-5xl font-extrabold leading-tight text-primary mb-md">
                    Suara Anda, Masa Depan Fakultas.
                </h1>

                <p class="font-body-lg text-lg text-on-surface-variant mb-lg">
                    Selamat datang, {{ session('nama') }}. Pastikan wallet Anda terhubung dan sudah terdaftar dalam DPT sebelum memberikan suara melalui sistem voting blockchain SINTING-FT.
                </p>

                <div class="flex flex-wrap gap-md">
                    <div class="flex items-center gap-sm bg-surface-container-low px-md py-sm rounded-xl">
                        <span class="material-symbols-outlined text-primary">verified</span>
                        <span class="font-label-md">Keamanan Blockchain</span>
                    </div>

                    <div class="flex items-center gap-sm bg-surface-container-low px-md py-sm rounded-xl">
                        <span class="material-symbols-outlined text-primary">public</span>
                        <span class="font-label-md">Transparansi Publik</span>
                    </div>

                    <div class="flex items-center gap-sm bg-surface-container-low px-md py-sm rounded-xl">
                        <span class="material-symbols-outlined text-primary">how_to_vote</span>
                        <span class="font-label-md">Satu Wallet Satu Suara</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 bg-white p-xl rounded-2xl border border-outline-variant/10 shadow-sm">
                <div class="flex justify-between items-center mb-xl">
                    <div>
                        <h2 class="font-headline-md text-2xl font-bold text-on-surface">Status Pemilih</h2>
                        <p class="text-on-surface-variant text-sm mt-1">Data wallet dan hak pilih Anda.</p>
                    </div>
                    <span class="material-symbols-outlined text-on-surface-variant text-3xl">fact_check</span>
                </div>

                <div class="space-y-lg">
                    <div class="p-md bg-surface-container-low rounded-xl">
                        <div class="flex items-center justify-between mb-sm">
                            <span class="font-label-md text-on-surface-variant">Status Wallet</span>
                            <span id="walletBadge" class="text-[10px] font-bold uppercase bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">Offline</span>
                        </div>
                        <h3 id="walletStatus" class="font-bold text-xl text-on-surface">Belum terhubung</h3>
                    </div>

                    <div class="p-md bg-surface-container-low rounded-xl">
                        <div class="flex items-center justify-between mb-sm">
                            <span class="font-label-md text-on-surface-variant">Status DPT</span>
                            <span class="material-symbols-outlined text-primary">how_to_reg</span>
                        </div>
                        <h3 id="dptStatus" class="font-bold text-xl text-on-surface">-</h3>
                    </div>

                    <div class="p-md bg-surface-container-low rounded-xl">
                        <div class="flex items-center justify-between mb-sm">
                            <span class="font-label-md text-on-surface-variant">Status Memilih</span>
                            <span class="material-symbols-outlined text-primary">ballot</span>
                        </div>
                        <h3 id="votingStatus" class="font-bold text-xl text-on-surface">-</h3>
                    </div>
                </div>
            </div>
        </section>

        <section id="status-area" class="mb-3xl">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
                <div class="lg:col-span-2 bg-white p-xl rounded-2xl border border-outline-variant/10 shadow-sm">
                    <div class="flex items-center gap-md mb-md">
                        <div class="w-12 h-12 rounded-full bg-primary-fixed flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
                        </div>
                        <div>
                            <h2 class="font-headline-md text-2xl font-bold text-on-surface">Wallet Address Terhubung</h2>
                            <p class="text-on-surface-variant">Alamat ini akan digunakan untuk validasi DPT dan voting.</p>
                        </div>
                    </div>

                    <div class="bg-surface-container-low rounded-xl p-md font-mono text-sm text-on-surface break-all" id="connectedWallet">
                        -
                    </div>
                </div>

                <div class="bg-inverse-surface text-inverse-on-surface p-xl rounded-2xl shadow-lg relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="material-symbols-outlined text-primary-fixed-dim">terminal</span>
                            <h3 class="font-label-md font-bold uppercase tracking-widest">Smart Contract</h3>
                        </div>

                        <p class="font-label-sm opacity-70 mb-1">Contract Address</p>

                        <div class="bg-white/10 p-4 rounded-xl break-all font-mono text-sm mb-4 border border-white/5" id="uiContractAddress">
                            0x427dC08BA46192024ceAdeD224f3251bFB8c3fBB
                        </div>

                        <div class="flex justify-between items-center text-xs opacity-80">
                            <span>Network: Sepolia</span>
                            <span class="flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-green-400"></span>
                                Active
                            </span>
                        </div>
                    </div>

                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-primary opacity-20 rounded-full blur-3xl"></div>
                </div>
            </div>
        </section>

        <section id="voting-area" class="mb-3xl">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-xl gap-md">
                <div>
                    <h2 class="font-headline-lg text-3xl font-bold text-on-surface">Bilik Suara Mahasiswa</h2>
                    <p class="font-body-md text-on-surface-variant">
                        Pilih calon pemimpin yang mewakili visi dan aspirasi Anda.
                    </p>
                </div>

                <div class="flex gap-sm">
                    <button class="px-md py-sm bg-primary text-on-primary rounded-lg font-label-md">
                        Kategori: Ketua Himpunan
                    </button>
                    <button onclick="loadCandidates()" class="px-md py-sm bg-surface-container-high text-on-surface-variant rounded-lg font-label-md hover:bg-surface-variant transition">
                        Refresh Kandidat
                    </button>
                </div>
            </div>

            <div id="loadingText" class="hidden mb-lg text-primary italic font-medium p-4 bg-primary-fixed/50 rounded-xl">
                ⏳ Sedang mengambil data kandidat dari Blockchain Sepolia...
            </div>

            <div id="candidatesContainer" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
                <div class="bg-surface-container-low rounded-2xl border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center p-xl text-center md:col-span-2 lg:col-span-3">
                    <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mb-md shadow-sm">
                        <span class="material-symbols-outlined text-primary text-3xl">account_balance_wallet</span>
                    </div>
                    <h3 class="font-headline-md text-2xl font-bold text-on-surface mb-sm">Hubungkan Wallet Anda</h3>
                    <p class="font-body-md text-on-surface-variant mb-xl">
                        Hubungkan dompet MetaMask terlebih dahulu untuk memuat daftar kandidat dari blockchain.
                    </p>
                    <button onclick="connectWallet()" class="bg-secondary-container text-on-secondary-container font-extrabold px-lg py-md rounded-xl shadow-lg hover:brightness-105 active:scale-95 transition-all">
                        Connect Wallet
                    </button>
                </div>
            </div>
        </section>

        <section class="bg-white rounded-2xl border border-outline-variant/10 shadow-sm overflow-hidden">
            <div class="px-xl py-lg border-b border-outline-variant/10 bg-surface-bright flex justify-between items-center gap-md">
                <div>
                    <h3 class="font-headline-md text-2xl font-bold text-on-surface">Aktivitas On-Chain</h3>
                    <p class="text-on-surface-variant text-sm mt-1">Log aktivitas pada sesi voting Anda.</p>
                </div>
                <span class="text-label-sm font-bold text-primary bg-primary-fixed px-md py-xs rounded-full">
                    SESSION LOG
                </span>
            </div>

            <div id="activityLog" class="divide-y divide-outline-variant/10">
                <div class="p-md flex items-center justify-between hover:bg-surface-container-lowest transition-colors">
                    <div class="flex items-center gap-md">
                        <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center">
                            <span class="material-symbols-outlined text-primary text-sm">info</span>
                        </div>
                        <div>
                            <p class="font-label-md text-on-surface">Menunggu koneksi wallet</p>
                            <p class="text-[10px] font-mono text-on-surface-variant">SINTING-FT Voting Session</p>
                        </div>
                    </div>
                    <span class="font-label-sm text-on-surface-variant">Sekarang</span>
                </div>
            </div>
        </section>
    </main>

    <footer class="w-full bg-surface-container-low border-t border-outline-variant/10 flex flex-col md:flex-row justify-between items-center py-xl px-margin-mobile md:px-margin-desktop">
        <div class="mb-md md:mb-0">
            <span class="font-headline-md text-2xl font-bold text-primary">SINTING-FT</span>
            <p class="font-body-md text-on-surface-variant mt-xs">
                © 2024 Faculty of Engineering. SINTING-FT Blockchain Voting System.
            </p>
        </div>

        <div class="flex gap-xl">
            <a class="text-on-surface-variant hover:text-primary transition-colors font-label-sm" href="#">Privacy Policy</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors font-label-sm" href="#">Terms of Service</a>
            <a class="text-on-surface-variant hover:text-primary transition-colors font-label-sm" href="#">Help Center</a>
        </div>
    </footer>

    <script>
        const CONTRACT_ADDRESS = "0x427dC08BA46192024ceAdeD224f3251bFB8c3fBB";

        const ABI = [
            {
            "inputs": [],
            "stateMutability": "nonpayable",
            "type": "constructor"
            },
            {
            "anonymous": false,
            "inputs": [
                {
                "indexed": false,
                "internalType": "uint256",
                "name": "id",
                "type": "uint256"
                },
                {
                "indexed": false,
                "internalType": "string",
                "name": "name",
                "type": "string"
                },
                {
                "indexed": false,
                "internalType": "string",
                "name": "vision",
                "type": "string"
                },
                {
                "indexed": false,
                "internalType": "string",
                "name": "mission",
                "type": "string"
                }
            ],
            "name": "CandidateAdded",
            "type": "event"
            },
            {
            "anonymous": false,
            "inputs": [
                {
                "indexed": false,
                "internalType": "address",
                "name": "dompetPemilih",
                "type": "address"
                },
                {
                "indexed": false,
                "internalType": "uint256",
                "name": "idKandidat",
                "type": "uint256"
                }
            ],
            "name": "VoteIn",
            "type": "event"
            },
            {
            "anonymous": false,
            "inputs": [
                {
                "indexed": false,
                "internalType": "address",
                "name": "dompetPemilih",
                "type": "address"
                }
            ],
            "name": "VoterRegistered",
            "type": "event"
            },
            {
            "inputs": [
                {
                "internalType": "string",
                "name": "_name",
                "type": "string"
                },
                {
                "internalType": "string",
                "name": "_vision",
                "type": "string"
                },
                {
                "internalType": "string",
                "name": "_mission",
                "type": "string"
                }
            ],
            "name": "addCandidate",
            "outputs": [],
            "stateMutability": "nonpayable",
            "type": "function"
            },
            {
            "inputs": [
                {
                "internalType": "address",
                "name": "",
                "type": "address"
                }
            ],
            "name": "alreadyVote",
            "outputs": [
                {
                "internalType": "bool",
                "name": "",
                "type": "bool"
                }
            ],
            "stateMutability": "view",
            "type": "function"
            },
            {
            "inputs": [
                {
                "internalType": "uint256",
                "name": "",
                "type": "uint256"
                }
            ],
            "name": "candidateList",
            "outputs": [
                {
                "internalType": "uint256",
                "name": "id",
                "type": "uint256"
                },
                {
                "internalType": "string",
                "name": "name",
                "type": "string"
                },
                {
                "internalType": "string",
                "name": "vision",
                "type": "string"
                },
                {
                "internalType": "string",
                "name": "mission",
                "type": "string"
                },
                {
                "internalType": "uint256",
                "name": "totalVote",
                "type": "uint256"
                }
            ],
            "stateMutability": "view",
            "type": "function"
            },
            {
            "inputs": [],
            "name": "committee",
            "outputs": [
                {
                "internalType": "address",
                "name": "",
                "type": "address"
                }
            ],
            "stateMutability": "view",
            "type": "function"
            },
            {
            "inputs": [],
            "name": "getAllCandidates",
            "outputs": [
                {
                "components": [
                    {
                    "internalType": "uint256",
                    "name": "id",
                    "type": "uint256"
                    },
                    {
                    "internalType": "string",
                    "name": "name",
                    "type": "string"
                    },
                    {
                    "internalType": "string",
                    "name": "vision",
                    "type": "string"
                    },
                    {
                    "internalType": "string",
                    "name": "mission",
                    "type": "string"
                    },
                    {
                    "internalType": "uint256",
                    "name": "totalVote",
                    "type": "uint256"
                    }
                ],
                "internalType": "struct TingTingVoting.Candidate[]",
                "name": "",
                "type": "tuple[]"
                }
            ],
            "stateMutability": "view",
            "type": "function"
            },
            {
            "inputs": [],
            "name": "getTotalCandidates",
            "outputs": [
                {
                "internalType": "uint256",
                "name": "",
                "type": "uint256"
                }
            ],
            "stateMutability": "view",
            "type": "function"
            },
            {
            "inputs": [
                {
                "internalType": "address",
                "name": "",
                "type": "address"
                }
            ],
            "name": "isEligible",
            "outputs": [
                {
                "internalType": "bool",
                "name": "",
                "type": "bool"
                }
            ],
            "stateMutability": "view",
            "type": "function"
            },
            {
            "inputs": [
                {
                "internalType": "address",
                "name": "_voter",
                "type": "address"
                }
            ],
            "name": "registerVoter",
            "outputs": [],
            "stateMutability": "nonpayable",
            "type": "function"
            },
            {
            "inputs": [
                {
                "internalType": "uint256",
                "name": "_idKandidat",
                "type": "uint256"
                }
            ],
            "name": "vote",
            "outputs": [],
            "stateMutability": "nonpayable",
            "type": "function"
            }
        ];

        let provider;
        let signer;
        let contract;
        let connectedAccount;

        function truncateAddress(address) {
            if (!address) return '-';
            return `${address.slice(0, 6)}...${address.slice(-4)}`;
        }

        function showAlert(message, type = 'success') {
            const alertBox = document.getElementById('alertBox');

            alertBox.classList.remove(
                'hidden',
                'bg-green-100', 'text-green-700', 'border-green-200',
                'bg-red-100', 'text-red-700', 'border-red-200',
                'bg-yellow-100', 'text-yellow-700', 'border-yellow-200'
            );

            if (type === 'success') {
                alertBox.classList.add('bg-green-100', 'text-green-700', 'border-green-200');
            } else if (type === 'error') {
                alertBox.classList.add('bg-red-100', 'text-red-700', 'border-red-200');
            } else {
                alertBox.classList.add('bg-yellow-100', 'text-yellow-700', 'border-yellow-200');
            }

            alertBox.innerText = message;
            alertBox.classList.remove('hidden');
        }

        function addActivityLog(title, detail, icon = 'info', color = 'primary') {
            const activityLog = document.getElementById('activityLog');

            const colorClass = color === 'green'
                ? 'bg-green-100 text-green-600'
                : color === 'red'
                    ? 'bg-red-100 text-red-600'
                    : color === 'yellow'
                        ? 'bg-yellow-100 text-yellow-700'
                        : 'bg-primary-fixed text-primary';

            const newLog = document.createElement('div');
            newLog.className = 'p-md flex items-center justify-between hover:bg-surface-container-lowest transition-colors';
            newLog.style.opacity = '0';
            newLog.style.transform = 'translateY(-10px)';

            newLog.innerHTML = `
                <div class="flex items-center gap-md">
                    <div class="w-10 h-10 rounded-full ${colorClass} flex items-center justify-center">
                        <span class="material-symbols-outlined text-sm">${icon}</span>
                    </div>
                    <div>
                        <p class="font-label-md text-on-surface">${title}</p>
                        <p class="text-[10px] font-mono text-on-surface-variant">${detail}</p>
                    </div>
                </div>
                <span class="font-label-sm text-on-surface-variant">Baru saja</span>
            `;

            activityLog.prepend(newLog);

            setTimeout(() => {
                newLog.style.transition = 'all 0.5s ease';
                newLog.style.opacity = '1';
                newLog.style.transform = 'translateY(0)';
            }, 50);

            if (activityLog.children.length > 6) {
                activityLog.lastElementChild.remove();
            }
        }

        async function connectWallet() {
            try {
                if (!window.ethereum) {
                    showAlert('MetaMask belum terpasang di browser.', 'error');
                    addActivityLog('MetaMask tidak ditemukan', 'Install MetaMask terlebih dahulu', 'error', 'red');
                    return;
                }

                provider = new ethers.BrowserProvider(window.ethereum);
                await provider.send("eth_requestAccounts", []);
                signer = await provider.getSigner();
                connectedAccount = await signer.getAddress();

                contract = new ethers.Contract(CONTRACT_ADDRESS, ABI, signer);

                document.getElementById('connectedWallet').innerText = connectedAccount;
                document.getElementById('walletStatus').innerText = 'Terhubung';
                document.getElementById('connectWalletBtn').innerHTML = `
                    <span class="material-symbols-outlined text-[20px]">account_balance_wallet</span>
                    Wallet Terhubung
                `;

                const walletBadge = document.getElementById('walletBadge');
                walletBadge.innerText = 'Online';
                walletBadge.classList.remove('bg-yellow-100', 'text-yellow-700');
                walletBadge.classList.add('bg-green-100', 'text-green-700');

                showAlert('Wallet berhasil terhubung.', 'success');
                addActivityLog('Wallet Connected', `${truncateAddress(connectedAccount)} • Sepolia`, 'account_balance_wallet', 'green');

                await checkVoterStatus();
                await loadCandidates();
            } catch (error) {
                console.error(error);
                showAlert('Gagal menghubungkan wallet.', 'error');
                addActivityLog('Wallet gagal terhubung', 'User membatalkan koneksi atau terjadi error', 'error', 'red');
            }
        }

        async function checkVoterStatus() {
            try {
                if (!contract || !connectedAccount) return;

                const eligible = await contract.isEligible(connectedAccount);
                const voted = await contract.alreadyVote(connectedAccount);

                const dptStatusElement = document.getElementById('dptStatus');

                if (eligible) {
                    dptStatusElement.innerText = 'Terdaftar';
                    dptStatusElement.className = 'font-bold text-xl text-green-600';
                    addActivityLog('DPT Verified', `${truncateAddress(connectedAccount)} terdaftar sebagai pemilih`, 'how_to_reg', 'green');
                } else {
                    dptStatusElement.innerText = 'Tidak Terdaftar';
                    dptStatusElement.className = 'font-bold text-xl text-red-600';
                    showAlert('Wallet Anda belum terdaftar dalam DPT. Anda tidak bisa mencoblos.', 'error');
                    addActivityLog('DPT Rejected', `${truncateAddress(connectedAccount)} belum masuk whitelist`, 'block', 'red');
                }

                const votingStatusElement = document.getElementById('votingStatus');

                if (voted) {
                    votingStatusElement.innerText = 'Sudah Memilih';
                    votingStatusElement.className = 'font-bold text-xl text-primary';
                    addActivityLog('Vote Status Checked', `${truncateAddress(connectedAccount)} sudah pernah memilih`, 'how_to_vote', 'primary');
                } else {
                    votingStatusElement.innerText = 'Belum Memilih';
                    votingStatusElement.className = 'font-bold text-xl text-yellow-700';
                }
            } catch (error) {
                console.error("Gagal memeriksa status pemilih:", error);
                addActivityLog('Gagal cek status', 'Tidak dapat membaca status DPT dari blockchain', 'error', 'red');
            }
        }

        async function loadCandidates() {
            const container = document.getElementById('candidatesContainer');
            const loader = document.getElementById('loadingText');

            if (!contract || !connectedAccount) {
                showAlert('Hubungkan wallet terlebih dahulu untuk memuat kandidat.', 'warning');
                return;
            }

            container.innerHTML = '';
            loader.classList.remove('hidden');

            try {
                const candidates = await contract.getAllCandidates();
                const isVoted = await contract.alreadyVote(connectedAccount);
                const isEligible = await contract.isEligible(connectedAccount);

                let cardsHtml = '';

                candidates.forEach((candidate, index) => {
                    const id = Number(candidate.id);
                    const name = candidate.name;
                    const vision = candidate.vision || "-";
                    const mission = candidate.mission || "-";
                    const totalVote = Number(candidate.totalVote ?? 0);
                    const candidateNumber = String(index + 1).padStart(2, '0');
                    const isDisabled = isVoted || !isEligible;

                    // Mencegah error HTML saat data memiliki karakter ENTER / kutip
                    const safeVisionAlert = vision.replace(/'/g, "\\'").replace(/"/g, "&quot;").replace(/(\r\n|\n|\r)/gm, "\\n");
                    const safeMissionAlert = mission.replace(/'/g, "\\'").replace(/"/g, "&quot;").replace(/(\r\n|\n|\r)/gm, "\\n");

                    let buttonText = 'Pilih Kandidat';
                    let buttonClass = 'bg-secondary-container text-on-secondary-container shadow-lg hover:brightness-105 active:scale-95';

                    if (isVoted) {
                        buttonText = 'Anda Sudah Memilih';
                        buttonClass = 'bg-surface-container-highest text-on-surface-variant cursor-not-allowed';
                    } else if (!isEligible) {
                        buttonText = 'Akses Terkunci';
                        buttonClass = 'bg-surface-container-highest text-on-surface-variant cursor-not-allowed';
                    }

                    cardsHtml += `
                        <div class="group bg-white rounded-2xl border border-outline-variant/10 shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col">
                            <div class="relative h-64 bg-surface-container-low flex items-center justify-center shrink-0">
                                <div class="absolute inset-0 bg-gradient-to-br from-primary-fixed via-surface-container-low to-secondary-fixed opacity-80"></div>

                                <div class="relative z-10 w-28 h-28 rounded-full bg-white/90 shadow-lg flex items-center justify-center">
                                    <span class="material-symbols-outlined text-primary text-[64px]">person</span>
                                </div>

                                <div class="absolute top-md left-md bg-primary text-white px-md py-xs rounded-full font-bold text-label-sm">
                                    KANDIDAT ${candidateNumber}
                                </div>

                                <div class="absolute bottom-md right-md bg-white/90 backdrop-blur-sm px-md py-xs rounded-lg font-bold text-label-sm shadow-sm">
                                    <span class="text-primary">${totalVote}</span> Votes
                                </div>
                            </div>

                            <div class="p-xl flex flex-col flex-grow">
                                <h3 class="font-headline-md text-2xl font-bold text-on-surface mb-sm">${name}</h3>

                                <div class="font-body-md text-on-surface-variant mb-md text-sm max-h-[240px] overflow-y-auto pr-2 custom-scrollbar whitespace-pre-wrap">
                                    <p><strong>Visi:</strong> ${vision}</p>
                                    <p class="mt-1"><strong>Misi:</strong> ${mission}</p>
                                </div>

                                <div class="flex items-center justify-between gap-md mt-auto pt-4 border-t border-outline-variant/10">
                                    <button
                                        onclick="castVote(${id})"
                                        ${isDisabled ? 'disabled' : ''}
                                        class="flex-1 ${buttonClass} font-extrabold py-md rounded-xl transition-all font-label-md"
                                    >
                                        ${buttonText}
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                });

                if (cardsHtml === '') {
                    container.innerHTML = `
                        <div class="bg-surface-container-low rounded-2xl border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center p-xl text-center md:col-span-2 lg:col-span-3">
                            <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center mb-md shadow-sm">
                                <span class="material-symbols-outlined text-primary text-3xl">person_off</span>
                            </div>
                            <h3 class="font-headline-md text-2xl font-bold text-on-surface mb-sm">Belum Ada Kandidat</h3>
                            <p class="font-body-md text-on-surface-variant">
                                Belum ada kandidat terdaftar di blockchain.
                            </p>
                        </div>
                    `;
                } else {
                    container.innerHTML = cardsHtml;
                    addActivityLog('Candidates Loaded', `${candidates.length} kandidat berhasil dimuat dari blockchain`, 'groups', 'primary');
                }
            } catch (error) {
                console.error(error);
                showAlert('Gagal mengambil data kandidat dari Sepolia.', 'error');
                addActivityLog('Gagal memuat kandidat', 'Tidak dapat membaca data kandidat dari smart contract', 'error', 'red');
            } finally {
                loader.classList.add('hidden');
            }
        }

        async function castVote(idKandidat) {
            try {
                if (!contract || !connectedAccount) {
                    showAlert('Hubungkan wallet terlebih dahulu.', 'warning');
                    return;
                }

                showAlert('Membuka MetaMask... Mohon konfirmasi transaksi dan bayar gas fee.', 'warning');
                addActivityLog('Vote Requested', `Membuka MetaMask untuk kandidat ID ${idKandidat}`, 'pending_actions', 'yellow');

                const tx = await contract.vote(idKandidat);

                showAlert(`Transaksi dikirim ke Sepolia. Menunggu konfirmasi blok... Hash: ${tx.hash}`, 'warning');
                addActivityLog('Transaction Sent', `${tx.hash.slice(0, 10)}...${tx.hash.slice(-8)}`, 'receipt_long', 'yellow');

                await tx.wait();

                showAlert('🎉 Selamat! Suara Anda berhasil direkam dengan aman di blockchain Sepolia.', 'success');
                addActivityLog('Vote Verified', `${truncateAddress(connectedAccount)} memilih kandidat ID ${idKandidat}`, 'how_to_vote', 'green');

                await checkVoterStatus();
                await loadCandidates();
            } catch (error) {
                console.error(error);

                if (error.reason) {
                    showAlert(`Gagal memilih: ${error.reason}`, 'error');
                    addActivityLog('Vote Failed', error.reason, 'error', 'red');
                } else {
                    showAlert('Transaksi voting dibatalkan atau gagal diproses.', 'error');
                    addActivityLog('Vote Cancelled', 'Transaksi dibatalkan atau gagal diproses', 'cancel', 'red');
                }
            }
        }

        document.querySelectorAll('button').forEach(button => {
            button.addEventListener('mousedown', () => {
                button.classList.add('scale-95');
            });

            button.addEventListener('mouseup', () => {
                button.classList.remove('scale-95');
            });

            button.addEventListener('mouseleave', () => {
                button.classList.remove('scale-95');
            });
        });

        document.addEventListener('DOMContentLoaded', async function () {
            if (window.ethereum) {
                const accounts = await window.ethereum.request({ method: 'eth_accounts' });

                if (accounts.length > 0) {
                    connectWallet();
                }
            }
        });
    </script>
</body>
</html>
