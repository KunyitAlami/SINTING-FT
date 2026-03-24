import hre from "hardhat";

async function main() {
  console.log("Memulai proses deployment ke Sepolia...");

  const TingTingVoting = await hre.ethers.getContractFactory("TingTingVoting");
  const voting = await TingTingVoting.deploy();
  await voting.waitForDeployment();

  console.log(`🎉 BERHASIL! TingTingVoting mendarat di alamat: ${voting.target}`);
}

main().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});