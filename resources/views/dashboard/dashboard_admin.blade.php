{{-- <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin KPU - SINTING-FT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/ethers@6.13.2/dist/ethers.umd.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="flex min-h-screen">

        <aside class="w-72 bg-green-900 text-white hidden md:flex flex-col">
            <div class="p-6 border-b border-green-700">
                <h1 class="text-2xl font-bold">SINTING-FT</h1>
                <p class="text-sm text-green-200 mt-1">Dashboard Admin KPU</p>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="#dashboard" class="block px-4 py-3 rounded-xl bg-green-800 font-semibold">
                    Dashboard
                </a>
                <a href="#kandidat" class="block px-4 py-3 rounded-xl hover:bg-green-800 transition">
                    Kandidat & Hasil Suara
                </a>
                <a href="#dpt" class="block px-4 py-3 rounded-xl hover:bg-green-800 transition">
                    Registrasi DPT Blockchain
                </a>
                <a href="#cek-pemilih" class="block px-4 py-3 rounded-xl hover:bg-green-800 transition">
                    Cek Status Pemilih
                </a>
            </nav>

            <div class="p-4 border-t border-green-700">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full px-4 py-3 bg-red-600 rounded-xl font-semibold hover:bg-red-700 transition">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1">

            <header class="bg-white shadow-sm px-6 py-5 flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Dashboard Admin KPU</h2>
                    <p class="text-gray-500">Selamat datang, {{ session('nama') }}</p>
                </div>

                <button
                    onclick="connectWallet()"
                    id="connectWalletBtn"
                    {{ !$isContractConfigured ? 'disabled' : '' }}
                    class="px-5 py-3 rounded-xl font-semibold transition
                        {{ $isContractConfigured
                            ? 'bg-green-800 text-white hover:bg-green-900'
                            : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
                >
                    {{ $isContractConfigured ? 'Connect Wallet' : 'Contract Belum Ada' }}
                </button>
            </header>

            <div class="p-6 space-y-8">

                <div id="alertBox" class="hidden px-5 py-4 rounded-xl font-medium"></div>

                <section id="dashboard" class="grid grid-cols-1 md:grid-cols-4 gap-5">
                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <p class="text-gray-500">Status Wallet</p>
                        <h3 id="walletStatus" class="text-lg font-bold mt-2 text-gray-800">Belum terhubung</h3>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <p class="text-gray-500">Wallet Admin SC</p>
                        <h3 id="committeeAddress" class="text-sm font-bold mt-2 text-gray-800 break-all">-</h3>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <p class="text-gray-500">Total Kandidat</p>
                        <h3 id="totalCandidates" class="text-3xl font-bold mt-2 text-gray-800">0</h3>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <p class="text-gray-500">Total Suara Masuk</p>
                        <h3 id="totalVotes" class="text-3xl font-bold mt-2 text-gray-800">0</h3>
                    </div>
                </section>

                <section class="bg-white p-6 rounded-2xl shadow-sm">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Informasi Smart Contract</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 bg-gray-100 rounded-xl">
                            <p class="text-gray-500 text-sm">Contract Address</p>
                            <p class="mt-3 mb-3 font-semibold break-all {{ $isContractConfigured ? 'text-gray-800' : 'text-red-600' }}" id="contractAddressText">
                                {{ $isContractConfigured ? $contractAddress : 'Belum dikonfigurasi' }}
                            </p>
                            @if(!$isContractConfigured)
                                <section class="bg-yellow-50 border border-yellow-300 p-6 rounded-2xl shadow-sm">
                                    <h3 class="text-lg font-bold text-yellow-800">Smart Contract Belum Dikonfigurasi</h3>
                                    <p class="text-yellow-700 mt-2">
                                        Kami tidak menemukan alamat smart contract yang akan digunakan
                                    </p>
                                    <div class="mt-3 bg-yellow-100 text-yellow-900 px-4 py-3 rounded-xl font-mono text-sm">
                                        Hubungi Teknisi Terkait Mengenai Kendala Pada Smart Contract ini
                                    </div>
                                </section>
                            @endif
                        </div>

                        <div class="p-4 bg-gray-100 rounded-xl">
                            <p class="text-gray-500 text-sm">Wallet Terhubung</p>
                            <p class="font-semibold text-gray-800 break-all" id="connectedWallet">
                                -
                            </p>
                        </div>
                    </div>
                </section>

                <section id="kandidat" class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Kandidat & Hasil Suara</h3>
                            <p class="text-gray-500">Data kandidat diambil langsung dari smart contract.</p>
                        </div>

                        <button
                            onclick="loadCandidates()"
                            {{ !$isContractConfigured ? 'disabled' : '' }}
                            class="px-4 py-3 rounded-xl font-semibold transition
                                {{ $isContractConfigured
                                    ? 'bg-green-800 text-white hover:bg-green-900'
                                    : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
                        >
                            Refresh
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100 text-left">
                                    <th class="p-4 rounded-l-xl">ID</th>
                                    <th class="p-4">Nama Kandidat</th>
                                    <th class="p-4 rounded-r-xl">Total Suara</th>
                                </tr>
                            </thead>
                            <tbody id="candidateTable">
                                <tr>
                                    <td colspan="3" class="p-4 text-center text-gray-500">
                                        Belum ada data. Hubungkan wallet lalu klik refresh.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section id="dpt" class="bg-white p-6 rounded-2xl shadow-sm">
                    <h3 class="text-xl font-bold text-gray-800">Registrasi DPT Blockchain</h3>
                    <p class="text-gray-500 mt-1">
                        Masukkan wallet address mahasiswa yang berhak voting. Aksi ini memanggil fungsi registerVoter().
                    </p>

                    <div class="mt-5 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <input
                            type="text"
                            id="voterAddress"
                            placeholder="0x wallet mahasiswa"
                            class="md:col-span-3 px-5 py-4 rounded-xl bg-gray-100 outline-none focus:ring-2 focus:ring-green-800"
                        >

                        <button
                            onclick="registerVoter()"
                            {{ !$isContractConfigured ? 'disabled' : '' }}
                            class="px-5 py-4 rounded-xl font-bold transition
                                {{ $isContractConfigured
                                    ? 'bg-green-800 text-white hover:bg-green-900'
                                    : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
                        >
                            Daftarkan
                        </button>
                    </div>

                    <div id="registerResult" class="mt-4 text-sm text-gray-600"></div>
                </section>

                <section id="cek-pemilih" class="bg-white p-6 rounded-2xl shadow-sm">
                    <h3 class="text-xl font-bold text-gray-800">Cek Status Pemilih</h3>
                    <p class="text-gray-500 mt-1">
                        Cek apakah wallet mahasiswa sudah masuk DPT dan apakah sudah voting.
                    </p>

                    <div class="mt-5 grid grid-cols-1 md:grid-cols-4 gap-4">
                        <input
                            type="text"
                            id="checkAddress"
                            placeholder="0x wallet mahasiswa"
                            class="md:col-span-3 px-5 py-4 rounded-xl bg-gray-100 outline-none focus:ring-2 focus:ring-green-800"
                        >

                        <button
                            onclick="checkVoterStatus()"
                            {{ !$isContractConfigured ? 'disabled' : '' }}
                            class="px-5 py-4 rounded-xl font-bold transition
                                {{ $isContractConfigured
                                    ? 'bg-blue-700 text-white hover:bg-blue-800'
                                    : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
                        >
                            Cek Status
                        </button>
                    </div>

                    <div id="checkResult" class="mt-5 grid grid-cols-1 md:grid-cols-2 gap-4 hidden">
                        <div class="p-4 bg-gray-100 rounded-xl">
                            <p class="text-gray-500 text-sm">Status DPT</p>
                            <p id="eligibleStatus" class="text-lg font-bold text-gray-800">-</p>
                        </div>

                        <div class="p-4 bg-gray-100 rounded-xl">
                            <p class="text-gray-500 text-sm">Status Voting</p>
                            <p id="voteStatus" class="text-lg font-bold text-gray-800">-</p>
                        </div>
                    </div>
                </section>

            </div>
        </main>
    </div>

    <script>
        const CONTRACT_ADDRESS = @json($contractAddress);
        const IS_CONTRACT_CONFIGURED = @json($isContractConfigured);

        // SUDAH DIPERBAIKI: getTotalCandidates dihapus dari ABI
        const ABI = [
            "function committee() view returns (address)",
            "function registerVoter(address _voter)",
            "function isEligible(address) view returns (bool)",
            "function alreadyVote(address) view returns (bool)",
            "function getAllCandidates() view returns (tuple(uint256 id, string name, uint256 totalVote)[])",
            "event VoteIn(address dompetPemilih, uint256 idKandidat)",
            "event VoterRegistered(address dompetPemilih)"
        ];

        let provider;
        let signer;
        let contract;
        let connectedAccount;

        function showAlert(message, type = 'success') {
            const alertBox = document.getElementById('alertBox');

            alertBox.classList.remove('hidden', 'bg-green-100', 'text-green-700', 'bg-red-100', 'text-red-700', 'bg-yellow-100', 'text-yellow-700');

            if (type === 'success') {
                alertBox.classList.add('bg-green-100', 'text-green-700');
            } else if (type === 'error') {
                alertBox.classList.add('bg-red-100', 'text-red-700');
            } else {
                alertBox.classList.add('bg-yellow-100', 'text-yellow-700');
            }

            alertBox.innerText = message;
        }

        function isBlockchainReady() {
            if (!IS_CONTRACT_CONFIGURED || !CONTRACT_ADDRESS) {
                showAlert('Smart contract belum dikonfigurasi. Dashboard tetap bisa digunakan, tetapi fitur blockchain belum aktif.', 'warning');
                return false;
            }

            if (!ethers.isAddress(CONTRACT_ADDRESS)) {
                showAlert('Alamat smart contract tidak valid. Periksa kembali VOTING_CONTRACT_ADDRESS di file .env.', 'error');
                return false;
            }

            return true;
        }

       async function connectWallet() {
            try {
                if (!isBlockchainReady()) {
                    return;
                }

                if (!window.ethereum) {
                    showAlert('MetaMask belum terpasang di browser.', 'error');
                    return;
                }

                provider = new ethers.BrowserProvider(window.ethereum);
                await provider.send("eth_requestAccounts", []);
                signer = await provider.getSigner();
                connectedAccount = await signer.getAddress();

                contract = new ethers.Contract(CONTRACT_ADDRESS, ABI, signer);

                document.getElementById('connectedWallet').innerText = connectedAccount;
                document.getElementById('walletStatus').innerText = 'Terhubung';
                document.getElementById('connectWalletBtn').innerText = 'Wallet Terhubung';

                await loadCommittee();
                await loadCandidates();

                showAlert('Wallet berhasil terhubung.', 'success');
            } catch (error) {
                console.error(error);
                showAlert('Gagal menghubungkan wallet.', 'error');
            }
        }

        async function loadCommittee() {
            try {
                if (!isBlockchainReady()) {
                    return;
                }
                if (!contract) {
                    showAlert('Hubungkan wallet terlebih dahulu.', 'warning');
                    return;
                }

                const committee = await contract.committee();
                document.getElementById('committeeAddress').innerText = committee;

                if (committee.toLowerCase() !== connectedAccount.toLowerCase()) {
                    showAlert('Wallet terhubung bukan wallet committee/admin smart contract. Register voter akan gagal jika wallet bukan admin.', 'warning');
                }
            } catch (error) {
                console.error(error);
                showAlert('Gagal mengambil data committee.', 'error');
            }
        }

        // SUDAH DIPERBAIKI: Logika pengambilan data disesuaikan dengan getAllCandidates
        async function loadCandidates() {
            try {
                if (!isBlockchainReady()) {
                    return;
                }
                if (!contract) {
                    showAlert('Hubungkan wallet terlebih dahulu.', 'warning');
                    return;
                }

                // Hanya memanggil getAllCandidates yang memang ada di Smart Contract
                const candidates = await contract.getAllCandidates();

                // Menghitung total kandidat dari panjang array, bukan memanggil fungsi error
                const totalCandidate = candidates.length;

                let rows = '';
                let totalVotes = 0;

                candidates.forEach((candidate) => {
                    const id = Number(candidate.id);
                    const name = candidate.name;
                    const totalVote = Number(candidate.totalVote);

                    totalVotes += totalVote;

                    rows += `
                        <tr class="border-b">
                            <td class="p-4 font-semibold">${id}</td>
                            <td class="p-4">${name}</td>
                            <td class="p-4 font-bold">${totalVote}</td>
                        </tr>
                    `;
                });

                if (rows === '') {
                    rows = `
                        <tr>
                            <td colspan="3" class="p-4 text-center text-gray-500">
                                Belum ada kandidat.
                            </td>
                        </tr>
                    `;
                }

                document.getElementById('candidateTable').innerHTML = rows;
                document.getElementById('totalCandidates').innerText = totalCandidate;
                document.getElementById('totalVotes').innerText = totalVotes;

            } catch (error) {
                console.error(error);
                showAlert('Gagal mengambil data kandidat.', 'error');
            }
        }

        async function registerVoter() {
            try {
                if (!isBlockchainReady()) {
                    return;
                }
                if (!contract) {
                    showAlert('Hubungkan wallet admin terlebih dahulu.', 'warning');
                    return;
                }

                const voterAddress = document.getElementById('voterAddress').value.trim();

                if (!ethers.isAddress(voterAddress)) {
                    showAlert('Alamat wallet pemilih tidak valid.', 'error');
                    return;
                }

                const alreadyEligible = await contract.isEligible(voterAddress);

                if (alreadyEligible) {
                    showAlert('Wallet ini sudah terdaftar sebagai DPT.', 'warning');
                    return;
                }

                document.getElementById('registerResult').innerText = 'Memproses transaksi register voter...';

                const tx = await contract.registerVoter(voterAddress);
                document.getElementById('registerResult').innerText = `Transaksi dikirim: ${tx.hash}`;

                await tx.wait();

                document.getElementById('registerResult').innerText = `Berhasil didaftarkan ke DPT. Tx Hash: ${tx.hash}`;
                showAlert('Pemilih berhasil didaftarkan ke blockchain.', 'success');

            } catch (error) {
                console.error(error);

                if (error.reason) {
                    showAlert(error.reason, 'error');
                } else if (error.shortMessage) {
                    showAlert(error.shortMessage, 'error');
                } else {
                    showAlert('Gagal mendaftarkan pemilih. Pastikan wallet yang connect adalah committee/admin.', 'error');
                }
            }
        }

        async function checkVoterStatus() {
            try {
                if (!isBlockchainReady()) {
                    return;
                }
                if (!contract) {
                    showAlert('Hubungkan wallet terlebih dahulu.', 'warning');
                    return;
                }

                const checkAddress = document.getElementById('checkAddress').value.trim();

                if (!ethers.isAddress(checkAddress)) {
                    showAlert('Alamat wallet tidak valid.', 'error');
                    return;
                }

                const eligible = await contract.isEligible(checkAddress);
                const voted = await contract.alreadyVote(checkAddress);

                document.getElementById('checkResult').classList.remove('hidden');

                document.getElementById('eligibleStatus').innerText = eligible
                    ? 'Terdaftar di DPT'
                    : 'Belum terdaftar di DPT';

                document.getElementById('voteStatus').innerText = voted
                    ? 'Sudah voting'
                    : 'Belum voting';

            } catch (error) {
                console.error(error);
                showAlert('Gagal mengecek status pemilih.', 'error');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            if (!IS_CONTRACT_CONFIGURED || !CONTRACT_ADDRESS) {
                document.getElementById('walletStatus').innerText = 'Contract belum ada';
                document.getElementById('committeeAddress').innerText = '-';
                document.getElementById('totalCandidates').innerText = '0';
                document.getElementById('totalVotes').innerText = '0';

                document.getElementById('candidateTable').innerHTML = `
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">
                            Data kandidat belum bisa dimuat karena smart contract belum dikonfigurasi.
                        </td>
                    </tr>
                `;
            }
        });
    </script>
</body>
</html> --}}
<!DOCTYPE html>
<html class="light" lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel SINTING-FT | Blockchain Voting</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/ethers@6.13.2/dist/ethers.umd.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
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
                        "2xl": "24px",
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
        body { font-family: 'Inter', sans-serif; }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(226, 232, 240, 0.5);
        }
    </style>
</head>

<body class="bg-background text-on-background min-h-screen">
    <div class="min-h-screen">
        <aside class="h-screen w-72 fixed left-0 top-0 bg-surface border-r border-outline-variant/10 shadow-sm hidden md:flex flex-col p-md gap-sm z-50">
            <div class="px-4 py-6">
                <h1 class="font-headline-md text-2xl font-bold text-primary">Admin Panel</h1>
                <p class="font-label-md text-sm text-on-surface-variant">SINTING-FT Blockchain Voting</p>
            </div>

            <nav class="flex flex-col gap-1 flex-1">
                <a class="bg-primary-container/20 text-primary font-bold rounded-xl px-4 py-3 flex items-center gap-3 transition-all" href="#dashboard">
                    <span class="material-symbols-outlined">dashboard</span>
                    <span class="font-label-md">Dashboard</span>
                </a>

                <a class="text-on-surface-variant px-4 py-3 flex items-center gap-3 hover:bg-surface-container rounded-xl transition-all hover:translate-x-1 duration-200" href="#kandidat">
                    <span class="material-symbols-outlined">groups</span>
                    <span class="font-label-md">Kandidat & Hasil Suara</span>
                </a>

                <a class="text-on-surface-variant px-4 py-3 flex items-center gap-3 hover:bg-surface-container rounded-xl transition-all hover:translate-x-1 duration-200" href="#dpt">
                    <span class="material-symbols-outlined">how_to_reg</span>
                    <span class="font-label-md">Registrasi DPT Blockchain</span>
                </a>

                <a class="text-on-surface-variant px-4 py-3 flex items-center gap-3 hover:bg-surface-container rounded-xl transition-all hover:translate-x-1 duration-200" href="#cek-pemilih">
                    <span class="material-symbols-outlined">verified_user</span>
                    <span class="font-label-md">Cek Status Pemilih</span>
                </a>
            </nav>

            <div class="mt-auto pt-4 border-t border-outline-variant/10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-primary text-on-primary font-label-md py-3 px-4 rounded-xl flex items-center justify-center gap-2 shadow-sm hover:opacity-90 transition-opacity">
                        <span class="material-symbols-outlined">logout</span>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <main class="md:ml-72 p-margin-mobile md:p-margin-desktop">
            <header class="flex flex-col gap-4 lg:flex-row lg:justify-between lg:items-end mb-xl">
                <div>
                    <h2 class="font-headline-lg text-3xl font-bold text-on-surface">Dashboard Admin KPU</h2>
                    <p class="font-body-md text-on-surface-variant">Selamat datang, {{ session('nama') }}</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-sm sm:items-center">
                    <div class="flex items-center gap-sm bg-surface-container-low px-4 py-2 rounded-full border border-outline-variant/20">
                        <span class="w-2 h-2 rounded-full {{ $isContractConfigured ? 'bg-green-500 animate-pulse' : 'bg-yellow-500' }}"></span>
                        <span class="font-label-md text-on-surface-variant">
                            {{ $isContractConfigured ? 'Contract Ready' : 'Contract Belum Ada' }}
                        </span>
                    </div>

                    <button
                        onclick="connectWallet()"
                        id="connectWalletBtn"
                        {{ !$isContractConfigured ? 'disabled' : '' }}
                        class="px-5 py-3 rounded-xl font-semibold transition flex items-center justify-center gap-2
                            {{ $isContractConfigured
                                ? 'bg-primary text-on-primary hover:opacity-90 shadow-sm active:scale-95'
                                : 'bg-surface-container-highest text-on-surface-variant cursor-not-allowed' }}"
                    >
                        <span class="material-symbols-outlined">account_balance_wallet</span>
                        {{ $isContractConfigured ? 'Connect Wallet' : 'Contract Belum Ada' }}
                    </button>
                </div>
            </header>

            <div id="alertBox" class="hidden mb-xl px-5 py-4 rounded-xl font-medium border"></div>

            <section id="dashboard" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-gutter mb-xl">
                <div class="glass-card p-lg rounded-2xl shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-md">
                        <span class="material-symbols-outlined text-primary text-[32px]">account_balance_wallet</span>
                        <span id="walletBadge" class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Offline</span>
                    </div>
                    <p class="font-label-sm text-sm text-on-surface-variant mb-1">Status Wallet Admin</p>
                    <h3 id="walletStatus" class="font-headline-md text-xl font-bold text-on-surface">Belum terhubung</h3>
                </div>

                <div class="glass-card p-lg rounded-2xl shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-md">
                        <span class="material-symbols-outlined text-primary text-[32px]">shield_person</span>
                    </div>
                    <p class="font-label-sm text-sm text-on-surface-variant mb-1">Wallet Admin SC</p>
                    <h3 id="committeeAddress" class="font-label-md text-sm font-bold text-on-surface break-all">-</h3>
                </div>

                <div class="glass-card p-lg rounded-2xl shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-md">
                        <span class="material-symbols-outlined text-primary text-[32px]">person_celebrate</span>
                    </div>
                    <p class="font-label-sm text-sm text-on-surface-variant mb-1">Total Kandidat</p>
                    <h3 id="totalCandidates" class="font-display-lg text-3xl font-bold text-on-surface">0</h3>
                </div>

                <div class="glass-card p-lg rounded-2xl shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-md">
                        <span class="material-symbols-outlined text-primary text-[32px]">how_to_vote</span>
                    </div>
                    <p class="font-label-sm text-sm text-on-surface-variant mb-1">Total Suara Masuk</p>
                    <h3 id="totalVotes" class="font-display-lg text-3xl font-bold text-on-surface">0</h3>
                </div>
            </section>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-gutter">
                <div class="lg:col-span-2 flex flex-col gap-gutter">
                    <section id="kandidat" class="glass-card rounded-2xl overflow-hidden shadow-sm">
                        <div class="p-lg flex flex-col gap-4 md:flex-row md:justify-between md:items-center border-b border-outline-variant/10">
                            <div>
                                <h3 class="font-headline-md text-2xl font-bold text-on-surface">Kandidat & Hasil Suara</h3>
                                <p class="font-body-md text-on-surface-variant">Data kandidat diambil langsung dari smart contract.</p>
                            </div>

                            <button
                                onclick="loadCandidates()"
                                {{ !$isContractConfigured ? 'disabled' : '' }}
                                class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl font-label-md transition-all active:scale-95
                                    {{ $isContractConfigured
                                        ? 'bg-primary-container text-on-primary-container hover:bg-primary-container/80'
                                        : 'bg-surface-container-highest text-on-surface-variant cursor-not-allowed' }}"
                            >
                                <span class="material-symbols-outlined text-md">refresh</span>
                                Refresh
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-surface-container-low text-on-surface-variant font-label-sm">
                                    <tr>
                                        <th class="px-lg py-md">ID</th>
                                        <th class="px-lg py-md">Nama Kandidat</th>
                                        <th class="px-lg py-md text-right">Persentase</th>
                                        <th class="px-lg py-md text-right">Total Suara</th>
                                    </tr>
                                </thead>

                                <tbody id="candidateTable" class="divide-y divide-outline-variant/10">
                                    <tr>
                                        <td colspan="4" class="px-lg py-lg text-center text-on-surface-variant">
                                            Belum ada data. Hubungkan wallet lalu klik refresh.
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <section id="dpt" class="glass-card p-lg rounded-2xl shadow-sm">
                        <div class="flex items-center gap-3 mb-md">
                            <span class="material-symbols-outlined text-primary">how_to_reg</span>
                            <div>
                                <h3 class="font-headline-md text-2xl font-bold text-on-surface">Registrasi DPT Blockchain</h3>
                                <p class="font-body-md text-on-surface-variant">Masukkan wallet address mahasiswa yang berhak voting. Aksi ini memanggil fungsi registerVoter().</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 gap-md">
                            <input
                                type="text"
                                id="voterAddress"
                                placeholder="0x wallet mahasiswa"
                                class="md:col-span-3 w-full bg-surface border border-outline-variant/30 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-container focus:border-primary transition-all"
                            >

                            <button
                                onclick="registerVoter()"
                                {{ !$isContractConfigured ? 'disabled' : '' }}
                                class="px-5 py-4 rounded-xl font-bold transition flex items-center justify-center gap-2
                                    {{ $isContractConfigured
                                        ? 'bg-secondary-container text-on-secondary-container shadow-sm hover:shadow-md active:scale-[0.98]'
                                        : 'bg-surface-container-highest text-on-surface-variant cursor-not-allowed' }}"
                            >
                                <span class="material-symbols-outlined">how_to_reg</span>
                                Daftarkan
                            </button>
                        </div>

                        <div id="registerResult" class="mt-4 text-sm text-on-surface-variant"></div>
                    </section>
                </div>

                <div class="flex flex-col gap-gutter">
                    <section class="bg-inverse-surface text-inverse-on-surface p-lg rounded-2xl shadow-lg relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="material-symbols-outlined text-primary-fixed-dim">terminal</span>
                                <h3 class="font-label-md font-bold uppercase tracking-widest">Smart Contract Info</h3>
                            </div>

                            <p class="font-label-sm opacity-70 mb-1">Contract Address</p>

                            <div id="contractAddressText" class="bg-white/10 p-4 rounded-xl break-all font-mono text-sm mb-4 border border-white/5 {{ $isContractConfigured ? '' : 'text-error-container' }}">
                                {{ $isContractConfigured ? $contractAddress : 'Belum dikonfigurasi' }}
                            </div>

                            @if(!$isContractConfigured)
                                <div class="bg-yellow-100/10 border border-yellow-200/20 p-4 rounded-xl mb-4">
                                    <h4 class="font-bold text-yellow-100">Smart Contract Belum Dikonfigurasi</h4>
                                    <p class="text-yellow-50/80 mt-2 text-sm">
                                        Kami tidak menemukan alamat smart contract yang akan digunakan.
                                    </p>
                                    <div class="mt-3 bg-yellow-100/10 text-yellow-50 px-4 py-3 rounded-xl font-mono text-xs">
                                        Hubungi teknisi terkait mengenai kendala pada smart contract ini.
                                    </div>
                                </div>
                            @endif

                            <div class="flex flex-col gap-2 text-xs opacity-80">
                                <div class="flex justify-between items-center gap-4">
                                    <span>Network: FT-Chain</span>
                                    <span class="flex items-center gap-1">
                                        <span class="w-2 h-2 rounded-full {{ $isContractConfigured ? 'bg-green-400' : 'bg-yellow-400' }}"></span>
                                        {{ $isContractConfigured ? 'Configured' : 'Pending' }}
                                    </span>
                                </div>

                                <div>
                                    <span class="block opacity-70 mb-1">Wallet Terhubung</span>
                                    <span id="connectedWallet" class="block bg-white/10 p-3 rounded-xl break-all font-mono">-</span>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-primary opacity-20 rounded-full blur-3xl"></div>
                    </section>

                    <section id="cek-pemilih" class="glass-card p-lg rounded-2xl shadow-sm border-l-4 border-primary">
                        <div class="flex items-center gap-3 mb-md">
                            <span class="material-symbols-outlined text-primary">person_search</span>
                            <div>
                                <h3 class="font-label-md font-bold text-on-surface">Cek Status Pemilih</h3>
                                <p class="font-label-sm text-on-surface-variant">Cek apakah wallet sudah masuk DPT dan apakah sudah voting.</p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-md">
                            <input
                                type="text"
                                id="checkAddress"
                                placeholder="Masukkan Wallet Address..."
                                class="w-full bg-surface-container-low border border-outline-variant/30 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary-container transition-all text-sm"
                            >

                            <button
                                onclick="checkVoterStatus()"
                                {{ !$isContractConfigured ? 'disabled' : '' }}
                                class="w-full font-label-md py-3 rounded-xl transition-colors flex items-center justify-center gap-2
                                    {{ $isContractConfigured
                                        ? 'bg-surface-container-highest text-on-surface hover:bg-surface-variant'
                                        : 'bg-surface-container-highest text-on-surface-variant cursor-not-allowed' }}"
                            >
                                <span class="material-symbols-outlined">verified_user</span>
                                Periksa Status
                            </button>

                            <div id="checkResult" class="mt-2 grid grid-cols-1 gap-md hidden">
                                <div class="p-4 bg-surface-container rounded-xl">
                                    <p class="text-on-surface-variant text-sm">Status DPT</p>
                                    <p id="eligibleStatus" class="text-lg font-bold text-on-surface">-</p>
                                </div>

                                <div class="p-4 bg-surface-container rounded-xl">
                                    <p class="text-on-surface-variant text-sm">Status Voting</p>
                                    <p id="voteStatus" class="text-lg font-bold text-on-surface">-</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="p-lg rounded-2xl bg-primary-container/10 border border-primary/10 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white">
                            <span class="material-symbols-outlined">help_center</span>
                        </div>
                        <div>
                            <h4 class="font-label-md font-bold text-primary">Butuh Bantuan?</h4>
                            <p class="font-label-sm text-on-surface-variant">Hubungi tim teknis FT</p>
                        </div>
                    </section>
                </div>
            </div>

            <footer class="mt-3xl flex flex-col md:flex-row justify-between items-center py-xl border-t border-outline-variant/10 text-on-surface-variant">
                <p class="font-body-md text-sm">© 2024 Faculty of Engineering. SINTING-FT Blockchain Voting System.</p>
                <div class="flex gap-lg mt-md md:mt-0">
                    <a class="font-label-sm hover:text-primary transition-colors" href="#">Privacy Policy</a>
                    <a class="font-label-sm hover:text-primary transition-colors" href="#">Terms of Service</a>
                    <a class="font-label-sm hover:text-primary transition-colors" href="#">Help Center</a>
                </div>
            </footer>
        </main>
    </div>

    <script>
        const CONTRACT_ADDRESS = @json($contractAddress);
        const IS_CONTRACT_CONFIGURED = @json($isContractConfigured);

        const ABI = [
            "function committee() view returns (address)",
            "function registerVoter(address _voter)",
            "function isEligible(address) view returns (bool)",
            "function alreadyVote(address) view returns (bool)",
            "function getAllCandidates() view returns (tuple(uint256 id, string name, uint256 totalVote)[])",
            "event VoteIn(address dompetPemilih, uint256 idKandidat)",
            "event VoterRegistered(address dompetPemilih)"
        ];

        let provider;
        let signer;
        let contract;
        let connectedAccount;

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
        }

        function isBlockchainReady() {
            if (!IS_CONTRACT_CONFIGURED || !CONTRACT_ADDRESS) {
                showAlert('Smart contract belum dikonfigurasi. Dashboard tetap bisa digunakan, tetapi fitur blockchain belum aktif.', 'warning');
                return false;
            }

            if (!ethers.isAddress(CONTRACT_ADDRESS)) {
                showAlert('Alamat smart contract tidak valid. Periksa kembali VOTING_CONTRACT_ADDRESS di file .env.', 'error');
                return false;
            }

            return true;
        }

        async function connectWallet() {
            try {
                if (!isBlockchainReady()) {
                    return;
                }

                if (!window.ethereum) {
                    showAlert('MetaMask belum terpasang di browser.', 'error');
                    return;
                }

                provider = new ethers.BrowserProvider(window.ethereum);
                await provider.send("eth_requestAccounts", []);
                signer = await provider.getSigner();
                connectedAccount = await signer.getAddress();

                contract = new ethers.Contract(CONTRACT_ADDRESS, ABI, signer);

                document.getElementById('connectedWallet').innerText = connectedAccount;
                document.getElementById('walletStatus').innerText = 'Terhubung';
                document.getElementById('connectWalletBtn').innerHTML = '<span class="material-symbols-outlined">account_balance_wallet</span> Wallet Terhubung';

                const walletBadge = document.getElementById('walletBadge');
                walletBadge.innerText = 'Terhubung';
                walletBadge.classList.remove('bg-yellow-100', 'text-yellow-700');
                walletBadge.classList.add('bg-green-100', 'text-green-700');

                await loadCommittee();
                await loadCandidates();

                showAlert('Wallet berhasil terhubung.', 'success');
            } catch (error) {
                console.error(error);
                showAlert('Gagal menghubungkan wallet.', 'error');
            }
        }

        async function loadCommittee() {
            try {
                if (!isBlockchainReady()) {
                    return;
                }

                if (!contract) {
                    showAlert('Hubungkan wallet terlebih dahulu.', 'warning');
                    return;
                }

                const committee = await contract.committee();
                document.getElementById('committeeAddress').innerText = committee;

                if (committee.toLowerCase() !== connectedAccount.toLowerCase()) {
                    showAlert('Wallet terhubung bukan wallet committee/admin smart contract. Register voter akan gagal jika wallet bukan admin.', 'warning');
                }
            } catch (error) {
                console.error(error);
                showAlert('Gagal mengambil data committee.', 'error');
            }
        }

        async function loadCandidates() {
            try {
                if (!isBlockchainReady()) {
                    return;
                }

                if (!contract) {
                    showAlert('Hubungkan wallet terlebih dahulu.', 'warning');
                    return;
                }

                const candidates = await contract.getAllCandidates();
                const totalCandidate = candidates.length;

                let rows = '';
                let totalVotes = 0;

                candidates.forEach((candidate) => {
                    totalVotes += Number(candidate.totalVote);
                });

                candidates.forEach((candidate) => {
                    const id = Number(candidate.id);
                    const name = candidate.name;
                    const totalVote = Number(candidate.totalVote);
                    const percentage = totalVotes > 0 ? Math.round((totalVote / totalVotes) * 100) : 0;

                    rows += `
                        <tr class="hover:bg-surface-container-low transition-colors">
                            <td class="px-lg py-md font-label-md">${id}</td>
                            <td class="px-lg py-md font-bold text-on-surface">${name}</td>
                            <td class="px-lg py-md text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <div class="w-24 bg-surface-container-high h-2 rounded-full overflow-hidden">
                                        <div class="bg-primary h-full" style="width: ${percentage}%;"></div>
                                    </div>
                                    <span class="font-label-md">${percentage}%</span>
                                </div>
                            </td>
                            <td class="px-lg py-md text-right font-bold">${totalVote}</td>
                        </tr>
                    `;
                });

                if (rows === '') {
                    rows = `
                        <tr>
                            <td colspan="4" class="px-lg py-lg text-center text-on-surface-variant">
                                Belum ada kandidat.
                            </td>
                        </tr>
                    `;
                }

                document.getElementById('candidateTable').innerHTML = rows;
                document.getElementById('totalCandidates').innerText = totalCandidate;
                document.getElementById('totalVotes').innerText = totalVotes;

            } catch (error) {
                console.error(error);
                showAlert('Gagal mengambil data kandidat.', 'error');
            }
        }

        async function registerVoter() {
            try {
                if (!isBlockchainReady()) {
                    return;
                }

                if (!contract) {
                    showAlert('Hubungkan wallet admin terlebih dahulu.', 'warning');
                    return;
                }

                const voterAddress = document.getElementById('voterAddress').value.trim();

                if (!ethers.isAddress(voterAddress)) {
                    showAlert('Alamat wallet pemilih tidak valid.', 'error');
                    return;
                }

                const alreadyEligible = await contract.isEligible(voterAddress);

                if (alreadyEligible) {
                    showAlert('Wallet ini sudah terdaftar sebagai DPT.', 'warning');
                    return;
                }

                document.getElementById('registerResult').innerText = 'Memproses transaksi register voter...';

                const tx = await contract.registerVoter(voterAddress);
                document.getElementById('registerResult').innerText = `Transaksi dikirim: ${tx.hash}`;

                await tx.wait();

                document.getElementById('registerResult').innerText = `Berhasil didaftarkan ke DPT. Tx Hash: ${tx.hash}`;
                showAlert('Pemilih berhasil didaftarkan ke blockchain.', 'success');

            } catch (error) {
                console.error(error);

                if (error.reason) {
                    showAlert(error.reason, 'error');
                } else if (error.shortMessage) {
                    showAlert(error.shortMessage, 'error');
                } else {
                    showAlert('Gagal mendaftarkan pemilih. Pastikan wallet yang connect adalah committee/admin.', 'error');
                }
            }
        }

        async function checkVoterStatus() {
            try {
                if (!isBlockchainReady()) {
                    return;
                }

                if (!contract) {
                    showAlert('Hubungkan wallet terlebih dahulu.', 'warning');
                    return;
                }

                const checkAddress = document.getElementById('checkAddress').value.trim();

                if (!ethers.isAddress(checkAddress)) {
                    showAlert('Alamat wallet tidak valid.', 'error');
                    return;
                }

                const eligible = await contract.isEligible(checkAddress);
                const voted = await contract.alreadyVote(checkAddress);

                document.getElementById('checkResult').classList.remove('hidden');

                document.getElementById('eligibleStatus').innerText = eligible
                    ? 'Terdaftar di DPT'
                    : 'Belum terdaftar di DPT';

                document.getElementById('voteStatus').innerText = voted
                    ? 'Sudah voting'
                    : 'Belum voting';

            } catch (error) {
                console.error(error);
                showAlert('Gagal mengecek status pemilih.', 'error');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            if (!IS_CONTRACT_CONFIGURED || !CONTRACT_ADDRESS) {
                document.getElementById('walletStatus').innerText = 'Contract belum ada';
                document.getElementById('committeeAddress').innerText = '-';
                document.getElementById('totalCandidates').innerText = '0';
                document.getElementById('totalVotes').innerText = '0';

                document.getElementById('candidateTable').innerHTML = `
                    <tr>
                        <td colspan="4" class="px-lg py-lg text-center text-on-surface-variant">
                            Data kandidat belum bisa dimuat karena smart contract belum dikonfigurasi.
                        </td>
                    </tr>
                `;
            }
        });
    </script>
</body>
</html>