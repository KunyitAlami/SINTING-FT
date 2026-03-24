// SPDX-License-Identifier: MIT
pragma solidity ^0.8.7;

contract TingTingVoting {
    event VoteIn(address dompetPemilih, uint256 idKandidat);
    event VoterRegistered(address dompetPemilih); 

    mapping(address => bool) public alreadyVote;
    mapping(address => bool) public isEligible; 
    
    address public comittee;

    struct Candidate {
        uint256 id;
        string name;
        uint256 totalVote;
    }

    Candidate[] public candidateList;
    
    // hanya sender atau atmint yang boleh akses
    modifier onlyComittee() {
        require(msg.sender == comittee, "Akses Ditolak: Anda bukan panitia!");
        _;
    }

    // syarat voting
    modifier noVoteYet() {
        require(isEligible[msg.sender] == true, "Maaf, Anda tidak terdaftar dalam DPT (Whitelist)!");
        require(alreadyVote[msg.sender] == false, "Maaf, Anda Sudah Pernah Melakukan Voting!");
        _;
    }

    constructor() {
        comittee = msg.sender; // Orang yang deploy otomatis jadi Ketua Panitia 
        candidateList.push(Candidate(0, "Kandidat 1: Budi & Siti", 0));
        candidateList.push(Candidate(1, "Kandidat 2: Andi & Joko", 0));
    }

    // daftar voter
    function registerVoter(address _voter) public onlyComittee {
        require(isEligible[_voter] == false, "Pemilih ini sudah terdaftar sebelumnya!");
        isEligible[_voter] = true;
        
        emit VoterRegistered(_voter);
    }

    // fungsi voting
    function vote(uint256 _idKandidat) public noVoteYet {
        require(_idKandidat < candidateList.length, "ID Kandidat tidak valid!");

        candidateList[_idKandidat].totalVote++;
        alreadyVote[msg.sender] = true;

        emit VoteIn(msg.sender, _idKandidat);
    }

    // fungsi melihat daftar kandidat
    function getAllCandidates() public view returns (Candidate[] memory) {
        return candidateList;
    }
}