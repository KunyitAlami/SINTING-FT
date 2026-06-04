import { network } from "hardhat";

const { ethers, networkName } = await network.create();

console.log(`Memulai proses deployment ke ${networkName}...`);

const voting = await ethers.deployContract("TingTingVoting");

console.log("Menunggu konfirmasi deployment...");
await voting.waitForDeployment();

const contractAddress = await voting.getAddress();
console.log(`🎉 TingTingVoting berhasil di-deploy ke alamat: ${contractAddress}`);