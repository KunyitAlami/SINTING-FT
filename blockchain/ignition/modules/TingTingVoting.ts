import { buildModule } from "@nomicfoundation/hardhat-ignition/modules";

export default buildModule("TingTingVotingModule", (m) => {
  const voting = m.contract("TingTingVoting");
  return { voting };
});