import React, { useState, useEffect } from 'react';
import { BrowserProvider, Contract } from 'ethers';

// import file abi
import TingTingArtifact from '../contracts/TingTingVoting.json';

const CONTRACT_ADDRESS = "0xB4F95ca65dAaCebcf95A5Fdf57ed4FF7730e7555";
const CONTRACT_ABI = TingTingArtifact.abi;

export default function VotingApp() {
    const [account, setAccount] = useState(null);
    const [candidates, setCandidates] = useState([]);
    const [isVoting, setIsVoting] = useState(false);
    const [errorMsg, setErrorMsg] = useState("");
    const [isLoading, setIsLoading] = useState(false);

    useEffect(() => {
        const checkConnection = async () => {
            if (window.ethereum) {
                try {
                    const accounts = await window.ethereum.request({ method: 'eth_accounts' });
                    if (accounts.length > 0) {
                        setAccount(accounts[0]);
                        loadCandidates();
                    }
                } catch (error) {
                    console.error("Gagal mengecek koneksi:", error);
                }
            }
        };

        checkConnection();
    }, []);

    const connectWallet = async () => {
        if (window.ethereum) {
            try {
                const accounts = await window.ethereum.request({ method: 'eth_requestAccounts' });
                setAccount(accounts[0]);
                loadCandidates();
            } catch (error) {
                setErrorMsg("Gagal menghubungkan MetaMask.");
            }
        } else {
            setErrorMsg("MetaMask belum terinstall!");
        }
    };

    const loadCandidates = async () => {
        setIsLoading(true);
        try {
            const provider = new BrowserProvider(window.ethereum);
            const contract = new Contract(CONTRACT_ADDRESS, CONTRACT_ABI, provider);

            // KEMBALI MENGGUNAKAN getAllCandidates KARENA SUDAH ADA DI ABI
            const data = await contract.getAllCandidates();

            const formattedCandidates = data.map(kandidat => ({
                id: kandidat.id.toString(),
                name: kandidat.name,
                totalVote: kandidat.totalVote.toString()
            }));

            setCandidates(formattedCandidates);
        } catch (error) {
            console.error("Gagal memuat:", error);
            setErrorMsg("Gagal memuat data kandidat.");
        } finally {
            setIsLoading(false);
        }
    };

    const castVote = async (idKandidat) => {
        if (!account) return alert("Connect wallet dulu!");
        setIsVoting(true);
        setErrorMsg("");

        try {
            const provider = new BrowserProvider(window.ethereum);
            const signer = await provider.getSigner();
            const contract = new Contract(CONTRACT_ADDRESS, CONTRACT_ABI, signer);

            const tx = await contract.vote(idKandidat);
            await tx.wait();

            alert("Voting berhasil!");
            loadCandidates();

        } catch (error) {
            console.error(error);
            if (error.reason) setErrorMsg(error.reason);
            else setErrorMsg("Gagal memproses transaksi.");
        } finally {
            setIsVoting(false);
        }
    };

    return (
        <div className="p-6 bg-white rounded-lg shadow-md w-full max-w-2xl mx-auto mt-8">
            <h2 className="text-2xl font-bold text-center text-gray-800 mb-6">Pemilihan Ketua Himpunan</h2>

            {errorMsg && (
                <div className="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                    <p>{errorMsg}</p>
                </div>
            )}

            <div className="flex justify-between items-center mb-6 pb-4 border-b">
                <div>
                    <p className="text-sm text-gray-500">Wallet Anda:</p>
                    <p className="font-mono font-medium text-gray-800">
                        {account ? `${account.slice(0, 6)}...${account.slice(-4)}` : "Belum terhubung"}
                    </p>
                </div>
                {!account && (
                    <button
                        onClick={connectWallet}
                        className="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-6 rounded-full"
                    >
                        Connect MetaMask
                    </button>
                )}
            </div>

            {account && (
                <div>
                    <h3 className="text-lg font-semibold mb-3 text-gray-700">Kandidat Tersedia</h3>
                    {isLoading ? (
                        <p className="text-blue-500 italic font-medium">⏳ Sedang mengambil data dari Blockchain Sepolia...</p>
                    ) : candidates.length === 0 ? (
                        <p className="text-red-500 italic font-medium">⚠️ Belum ada data kandidat. Suruh Orang 1 input data dulu!</p>
                    ) : (
                        <div className="grid gap-4">
                            {candidates.map((kandidat) => (
                                <div key={kandidat.id} className="flex justify-between items-center p-4 border rounded shadow-sm">
                                    <div>
                                        <p className="font-bold text-lg text-gray-800">{kandidat.name}</p>
                                        <p className="text-sm text-gray-600">Total Suara: {kandidat.totalVote}</p>
                                    </div>
                                    <button
                                        onClick={() => castVote(kandidat.id)}
                                        disabled={isVoting}
                                        className="bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-bold py-2 px-6 rounded"
                                    >
                                        {isVoting ? "Proses..." : "Vote"}
                                    </button>
                                </div>
                            ))}
                        </div>
                    )}
                </div>
            )}
        </div>
    );
}
