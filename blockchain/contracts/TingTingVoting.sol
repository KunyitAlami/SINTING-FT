// SPDX-License-Identifier: MIT
pragma solidity ^0.8.24;

contract TingTingVoting {
    event VoteIn(address dompetPemilih, uint256 idKandidat);
    event VoterRegistered(address dompetPemilih);
    event CandidateAdded(uint256 id, string name);

    mapping(address => bool) public alreadyVote;
    mapping(address => bool) public isEligible;

    address public committee;

    struct Candidate {
        uint256 id;
        string name;
        uint256 totalVote;
    }

    Candidate[] public candidateList;

    modifier onlyCommittee() {
        require(msg.sender == committee, "Akses Ditolak: Anda bukan panitia!");
        _;
    }

    modifier noVoteYet() {
        require(isEligible[msg.sender], "Maaf, Anda tidak terdaftar dalam DPT!");
        require(!alreadyVote[msg.sender], "Maaf, Anda sudah pernah melakukan voting!");
        _;
    }

    constructor() {
        committee = msg.sender;
    }

    function addCandidate(string memory _name) public onlyCommittee {
        uint256 newCandidateId = candidateList.length;

        candidateList.push(Candidate(newCandidateId, _name, 0));

        emit CandidateAdded(newCandidateId, _name);
    }

    function registerVoter(address _voter) public onlyCommittee {
        require(_voter != address(0), "Alamat voter tidak valid!");
        require(!isEligible[_voter], "Pemilih ini sudah terdaftar sebelumnya!");

        isEligible[_voter] = true;

        emit VoterRegistered(_voter);
    }

    function vote(uint256 _idKandidat) public noVoteYet {
        require(_idKandidat < candidateList.length, "ID Kandidat tidak valid!");

        candidateList[_idKandidat].totalVote++;
        alreadyVote[msg.sender] = true;

        emit VoteIn(msg.sender, _idKandidat);
    }

    function getAllCandidates() public view returns (Candidate[] memory) {
        return candidateList;
    }

    function getTotalCandidates() public view returns (uint256) {
        return candidateList.length;
    }
}
