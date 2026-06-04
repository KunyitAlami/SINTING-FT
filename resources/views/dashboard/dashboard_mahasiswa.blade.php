<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bilik Suara Mahasiswa - SINTING-FT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/ethers@6.13.2/dist/ethers.umd.min.js"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <div class="flex min-h-screen">

        <aside class="w-72 bg-green-900 text-white hidden md:flex flex-col">
            <div class="p-6 border-b border-green-700">
                <h1 class="text-2xl font-bold">SINTING-FT</h1>
                <p class="text-sm text-green-200 mt-1">Bilik Suara Mahasiswa</p>
            </div>

            <nav class="flex-1 p-4 space-y-2">
                <a href="#voting-area" class="block px-4 py-3 rounded-xl bg-green-800 font-semibold">
                    Bilik Suara
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
                    <h2 class="text-2xl font-bold text-gray-800">Bilik Suara Mahasiswa</h2>
                    <p class="text-gray-500">Selamat datang, {{ session('nama') }}</p>
                </div>

                <button
                    onclick="connectWallet()"
                    id="connectWalletBtn"
                    class="px-5 py-3 rounded-xl font-semibold transition bg-green-800 text-white hover:bg-green-900"
                >
                    Connect Wallet
                </button>
            </header>

            <div class="p-6 space-y-8">

                <div id="alertBox" class="hidden px-5 py-4 rounded-xl font-medium"></div>

                <section id="status-area" class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <p class="text-gray-500">Status Wallet</p>
                        <h3 id="walletStatus" class="text-lg font-bold mt-2 text-gray-800">Belum terhubung</h3>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <p class="text-gray-500">Status DPT (Whitelist)</p>
                        <h3 id="dptStatus" class="text-lg font-bold mt-2 text-gray-800">-</h3>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm">
                        <p class="text-gray-500">Status Memilih</p>
                        <h3 id="votingStatus" class="text-lg font-bold mt-2 text-gray-800">-</h3>
                    </div>
                </section>

                <section id="voting-area" class="bg-white p-6 rounded-2xl shadow-sm">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold text-gray-800">Kandidat Ketua Himpunan</h3>
                        <p class="text-gray-500">Silakan gunakan hak pilih Anda dengan menekan tombol Vote pada kandidat pilihan.</p>
                    </div>

                    <div id="loadingText" class="hidden text-blue-500 italic font-medium p-4">
                        ⏳ Sedang mengambil data kandidat dari Blockchain Sepolia...
                    </div>

                    <div id="candidatesContainer" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <p class="text-gray-500 italic col-span-2">Hubungkan dompet MetaMask Anda terlebih dahulu untuk memuat daftar kandidat.</p>
                    </div>
                </section>

                <section class="bg-white p-6 rounded-2xl shadow-sm">
                    <p class="text-gray-500 text-sm">Wallet Address Terhubung:</p>
                    <p class="font-mono font-semibold text-gray-800 break-all mt-1" id="connectedWallet">-</p>
                </section>

            </div>
        </main>
    </div>

    <script>
        // Variabel Backend Laravel sudah dihapus, kita hardcode langsung address-nya!
        const CONTRACT_ADDRESS = "0x4C973E008Be1D16571cb6f4bbfbe9bcaBe2b2e9A";

        const ABI = [
            "function isEligible(address) view returns (bool)",
            "function alreadyVote(address) view returns (bool)",
            "function getAllCandidates() view returns (tuple(uint256 id, string name, uint256 totalVote)[])",
            "function vote(uint256 _idKandidat)",
            "event VoteIn(address dompetPemilih, uint256 idKandidat)"
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
            alertBox.classList.remove('hidden');
        }

        async function connectWallet() {
            try {
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

                showAlert('Wallet berhasil terhubung.', 'success');

                // Cek status pemilih dan muat kandidat
                await checkVoterStatus();
                await loadCandidates();
            } catch (error) {
                console.error(error);
                showAlert('Gagal menghubungkan wallet.', 'error');
            }
        }

        async function checkVoterStatus() {
            try {
                const eligible = await contract.isEligible(connectedAccount);
                const voted = await contract.alreadyVote(connectedAccount);

                const dptStatusElement = document.getElementById('dptStatus');
                if (eligible) {
                    dptStatusElement.innerText = 'Terdaftar';
                    dptStatusElement.className = 'text-lg font-bold mt-2 text-green-600';
                } else {
                    dptStatusElement.innerText = 'Tidak Terdaftar (Hubungi Admin KPU)';
                    dptStatusElement.className = 'text-lg font-bold mt-2 text-red-600';
                    showAlert('Wallet Anda belum terdaftar dalam DPT (Whitelist). Anda tidak bisa mencoblos.', 'error');
                }

                const votingStatusElement = document.getElementById('votingStatus');
                if (voted) {
                    votingStatusElement.innerText = 'Sudah Memilih';
                    votingStatusElement.className = 'text-lg font-bold mt-2 text-blue-600';
                } else {
                    votingStatusElement.innerText = 'Belum Memilih';
                    votingStatusElement.className = 'text-lg font-bold mt-2 text-orange-600';
                }
            } catch (error) {
                console.error("Gagal memeriksa status pemilih:", error);
            }
        }

        async function loadCandidates() {
            const container = document.getElementById('candidatesContainer');
            const loader = document.getElementById('loadingText');

            container.innerHTML = '';
            loader.classList.remove('hidden');

            try {
                const candidates = await contract.getAllCandidates();
                const isVoted = await contract.alreadyVote(connectedAccount);
                const isEligible = await contract.isEligible(connectedAccount);

                let cardsHtml = '';

                candidates.forEach((candidate) => {
                    const id = Number(candidate.id);
                    const name = candidate.name;

                    // Tombol otomatis mati jika user belum masuk DPT atau sudah pernah voting
                    const isDisabled = isVoted || !isEligible;

                    cardsHtml += `
                        <div class="border border-gray-200 p-6 rounded-2xl shadow-sm bg-gray-50 flex flex-col justify-between">
                            <div>
                                <span class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">Kandidat #${id + 1}</span>
                                <h4 class="text-xl font-bold text-gray-800 mt-3 mb-4">${name}</h4>
                            </div>
                            <button
                                onclick="castVote(${id})"
                                ${isDisabled ? 'disabled' : ''}
                                class="w-full py-3 rounded-xl font-bold text-white transition
                                    ${isDisabled
                                        ? 'bg-gray-400 cursor-not-allowed'
                                        : 'bg-green-800 hover:bg-green-900 shadow-md'}"
                            >
                                ${isVoted ? 'Anda Sudah Memilih' : !isEligible ? 'Akses Terkunci' : 'Pilih Kandidat'}
                            </button>
                        </div>
                    `;
                });

                if (cardsHtml === '') {
                    container.innerHTML = '<p class="text-gray-500 italic col-span-2">Belum ada kandidat terdaftar di blockchain.</p>';
                } else {
                    container.innerHTML = cardsHtml;
                }
            } catch (error) {
                console.error(error);
                showAlert('Gagal mengambil data kandidat dari Sepolia.', 'error');
            } finally {
                loader.classList.add('hidden');
            }
        }

        async function castVote(idKandidat) {
            try {
                showAlert('Membuka MetaMask... Mohon konfirmasi transaksi dan bayar gas fee.', 'warning');

                const tx = await contract.vote(idKandidat);
                showAlert(`Transaksi dikirim ke Sepolia. Menunggu konfirmasi blok... Hash: ${tx.hash}`, 'warning');

                await tx.wait();

                showAlert('🎉 Selamat! Suara Anda berhasil direkam dengan aman di blockchain Sepolia.', 'success');

                // Refresh status data tampilan
                await checkVoterStatus();
                await loadCandidates();
            } catch (error) {
                console.error(error);
                if (error.reason) {
                    showAlert(`Gagal memilih: ${error.reason}`, 'error');
                } else {
                    showAlert('Transaksi voting dibatalkan atau gagal diproses.', 'error');
                }
            }
        }

        // Auto-check jika koneksi wallet sudah aktif saat halaman dibuka
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
