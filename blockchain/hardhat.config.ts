import { defineConfig } from "hardhat/config";
import hardhatVerify from "@nomicfoundation/hardhat-verify";
import hardhatEthers from "@nomicfoundation/hardhat-ethers";

export default defineConfig({
  plugins: [
    hardhatEthers,
    hardhatVerify,
  ],
    solidity: {
    version: "0.8.24", // tambahkan ini
  },
  networks: {
    sepolia: {
      type: "http",
      url: "https://eth-sepolia.g.alchemy.com/v2/-JDb0hJBwReeDt-mYYqTV",
      accounts: ["0xae3ff2208d6de27da76d98d8dfd8ef66b25a607638d4b6d1bd56a68cd9ceb633"],
    },
  },
  verify: {
    etherscan: {
      apiKey: "BJTF16WQDUS6Q57Q2I9ISPDFVVWQFD2W1K",
    },
  },
});