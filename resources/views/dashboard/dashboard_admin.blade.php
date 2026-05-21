<!DOCTYPE html>
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

        <!-- SIDEBAR -->
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

        <!-- MAIN CONTENT -->
        <main class="flex-1">

            <!-- TOPBAR -->
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

                <!-- ALERT -->
                <div id="alertBox" class="hidden px-5 py-4 rounded-xl font-medium"></div>

                <!-- DASHBOARD CARDS -->
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

                <!-- INFO CONTRACT -->
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

                <!-- KANDIDAT -->
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

                <!-- REGISTER DPT -->
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

                <!-- CEK PEMILIH -->
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

        const ABI = [
            "function committee() view returns (address)",
            "function registerVoter(address _voter)",
            "function isEligible(address) view returns (bool)",
            "function alreadyVote(address) view returns (bool)",
            "function getAllCandidates() view returns (tuple(uint256 id, string name, uint256 totalVote)[])",
            "function getTotalCandidates() view returns (uint256)",
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
                const totalCandidate = await contract.getTotalCandidates();

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
                document.getElementById('totalCandidates').innerText = Number(totalCandidate);
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
</html>