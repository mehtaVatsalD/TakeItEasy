-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2017 at 05:09 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `takeiteasy`
--

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `id` int(255) NOT NULL,
  `name` varchar(500) NOT NULL,
  `code` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institutes`
--

INSERT INTO `institutes` (`id`, `name`, `code`, `type`) VALUES
(0, 'Sardar Vallabhbhai National Institute of Technology, Surat', 'svnit', 'engineering'),
(1, 'Nirma Institute of Technology, Ahmedabad', 'nita', 'engineering'),
(2, 'GMERS, Junagadh', 'gmersj', 'medical'),
(3, 'B. J. Medical College, Ahmedabad', 'bjmca', 'medical'),
(4, 'Junagadh Agriculture University', 'jau', 'agriculture'),
(5, 'Anand Agriculture University', 'aau', 'agriculture');

-- --------------------------------------------------------

--
-- Table structure for table `questionpapers`
--

CREATE TABLE `questionpapers` (
  `id` int(255) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `examName` varchar(500) NOT NULL,
  `institute` varchar(500) NOT NULL,
  `examDate` varchar(20) NOT NULL,
  `fromTime` varchar(20) NOT NULL,
  `toTime` varchar(20) NOT NULL,
  `totalMarks` int(255) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questionpapers`
--

INSERT INTO `questionpapers` (`id`, `userName`, `examName`, `institute`, `examDate`, `fromTime`, `toTime`, `totalMarks`, `subject`, `createdOn`) VALUES
(1, 'vdmehta', 'Mid Semester Examination September 2017', 'svnit', '18/9/2017', '8:30 AM', '10:00 AM', 30, 'daa', '2017-10-26 07:56:54'),
(2, 'vdmehta', 'kfl', 'svnit', '1/1/2017', '8:30 AM', '9:30 AM', 10, 'daa', '2017-10-26 08:11:26'),
(3, 'vdmehta', 'Test', 'svnit', '27/10/2017', '2:00 PM', '2:30 PM', 20, 'daa', '2017-10-27 08:30:42'),
(4, 'vdmehta', 'Test', 'svnit', '27/10/2017', '2:00 PM', '2:30 PM', 20, 'daa', '2017-10-27 08:35:02'),
(5, 'vdmehta', 'Test', 'svnit', '27/10/2017', '2:00 PM', '2:30 PM', 20, 'daa', '2017-10-27 08:35:19'),
(6, 'debugtest', 'Mid Semester Examination September 2017', 'svnit', '18/9/2017', '2:00 PM', '3:30 PM', 30, 'daa', '2017-10-27 08:48:50');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(255) NOT NULL,
  `question` varchar(5000) NOT NULL,
  `marks` int(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `marks`, `subject`, `type`) VALUES
(4, 'Write the For LOOP general format.', 2, 'daa', 'engineering'),
(5, 'What is recursive algorithm?', 2, 'daa', 'engineering'),
(8, 'Give the two major phases of performance evaluation.', 2, 'daa', 'engineering'),
(10, 'Define worst-case step count.', 2, 'daa', 'engineering'),
(11, 'Define worst-case step count.', 2, 'daa', 'engineering'),
(12, ' Define average step count.', 2, 'daa', 'engineering'),
(13, 'Define the asymptotic notation Big Oh.', 2, 'daa', 'engineering'),
(14, 'Define the asymptotic notation Big Omega.', 2, 'daa', 'engineering'),
(15, ' Define the asymptotic notation Theta', 2, 'daa', 'engineering'),
(16, 'Define Little theta', 2, 'daa', 'engineering'),
(17, 'Define Little Omega.', 2, 'daa', 'engineering'),
(18, 'Write algorithm using iterative function to fine sum of n numbers.', 2, 'daa', 'engineering'),
(19, 'Write an algorithm using Recursive function to fine sum of n numbers.', 2, 'daa', 'engineering'),
(20, 'Define the divide an conquer method.', 2, 'daa', 'engineering'),
(21, 'Define control abstraction.', 3, 'daa', 'engineering'),
(22, 'Write the Control abstraction for Divide-and conquer.', 3, 'daa', 'engineering'),
(23, 'What is the substitution method?', 3, 'daa', 'engineering'),
(24, 'Give computing time for Bianry search?', 3, 'daa', 'engineering'),
(25, 'What is the binary search?', 3, 'daa', 'engineering'),
(26, 'Define external path length?', 3, 'daa', 'engineering'),
(27, ' Define internal path length.', 3, 'daa', 'engineering'),
(28, 'What is the maximum and minimum problem?', 3, 'daa', 'engineering'),
(29, 'What is the Quick sort?', 3, 'daa', 'engineering'),
(30, ' Write the Anlysis for the Quick sort.', 3, 'daa', 'engineering'),
(31, 'Is insertion sort better than the merge sort?', 3, 'daa', 'engineering'),
(32, 'Write a algorithm for straightforward maximum and minimum', 3, 'daa', 'engineering'),
(33, 'Give the recurrence relation of divide-and-conquer?', 3, 'daa', 'engineering'),
(34, 'Write the algorithm for Iterative binary search?', 3, 'daa', 'engineering'),
(36, 'Describe the recurrence relation ofr merge sort?', 3, 'daa', 'engineering'),
(37, 'Write any three characteristics of Greedy Algorithm?', 3, 'daa', 'engineering'),
(38, 'Write any three characteristics of Greedy Algorithm?', 3, 'daa', 'engineering'),
(39, 'Define optimal solution?', 3, 'daa', 'engineering'),
(40, 'What is Knapsack problem?', 3, 'daa', 'engineering'),
(41, 'Explain 0/1 Knapsack Problem and give algorithm for it.', 5, 'daa', 'engineering'),
(42, 'Explain Longest Subsequence problem and give algorithm for it.', 5, 'daa', 'engineering'),
(43, 'Explain and give algorithm for assembly line scheduling', 5, 'daa', 'engineering'),
(46, 'Explain and give pseudo code for thirsty baby problem', 5, 'daa', 'engineering'),
(47, 'Explain with example Knapsack Problem and its solution using Greedy approach.', 5, 'daa', 'engineering'),
(48, 'Explain optimal Binary Search Tree.', 5, 'daa', 'engineering'),
(49, 'Explain in detail Fast Fourier Transform', 5, 'daa', 'engineering'),
(50, 'Explain in detail Monotonous Increasing Sequence Problem', 5, 'daa', 'engineering'),
(51, 'Expalin in detail Hiring Problem', 5, 'daa', 'engineering'),
(53, 'Explain in detail Huffmann codding and also give pseudo code for same.', 5, 'daa', 'engineering'),
(54, 'What is Microprocessor? Give the power supply ', 2, 'mit', 'engineering'),
(55, 'What are the functions of an accumulator?', 2, 'mit', 'engineering'),
(56, 'List the 16 â€“ bit registers of 8085 microprocessor', 2, 'mit', 'engineering'),
(57, 'List few applications of microprocessor-based system', 2, 'mit', 'engineering'),
(58, 'List the allowed register pairs of 8085', 2, 'mit', 'engineering'),
(59, 'Mention the purpose of SID and SOD lines', 2, 'mit', 'engineering'),
(60, 'What is an Opcode?', 2, 'mit', 'engineering'),
(61, 'What is the function of IO/M signal in the 8085?', 2, 'mit', 'engineering'),
(62, 'What is an Operand?', 2, 'mit', 'engineering'),
(63, 'How many operations are there in the instruction set of 8085?', 2, 'mit', 'engineering'),
(64, 'List out the five categories of the 8085 instructions. Give examples of the instructions for each group?', 2, 'mit', 'engineering'),
(65, 'Explain the difference between a JMP instruction and CALL instruction', 2, 'mit', 'engineering'),
(66, 'Explain the purpose of the I/O instructions IN and OUT.', 2, 'mit', 'engineering'),
(67, 'What is the difference between the shifts and rotate instructions?', 2, 'mit', 'engineering'),
(68, 'How many address lines in a 4096 x 8 EPROM CHIP?', 2, 'mit', 'engineering'),
(69, 'What are the control signals used for DMA operation', 2, 'mit', 'engineering'),
(70, 'What is meant by Wait State?', 2, 'mit', 'engineering'),
(71, 'List the four instructions which control the interrupt structure of the 8085 microprocessor.', 2, 'mit', 'engineering'),
(72, 'What is meant by polling?', 2, 'mit', 'engineering'),
(73, 'What is meant by interrupt?', 2, 'mit', 'engineering'),
(74, 'Explain priority interrupts of 8085.', 2, 'mit', 'engineering'),
(75, 'What is a microcomputer?', 2, 'mit', 'engineering'),
(76, 'What is the signal classification of 8085?', 2, 'mit', 'engineering'),
(77, 'What are operations performed on data in 8085', 2, 'mit', 'engineering'),
(78, 'Steps involved fetching a byte in 8085.', 2, 'mit', 'engineering'),
(79, 'How many interrupts does 8085 have, mention them', 2, 'mit', 'engineering'),
(80, 'Basic concepts in memory interfacing', 2, 'mit', 'engineering'),
(81, 'Define instruction cycle, ma chine cycle and T-state', 2, 'mit', 'engineering'),
(82, 'What is an instruction?', 2, 'mit', 'engineering'),
(83, 'What is the use of ALE?', 2, 'mit', 'engineering'),
(84, 'How many machine cycles does 8085 have, mention them', 2, 'mit', 'engineering'),
(85, 'Explain the signals HOLD, READY and SID', 2, 'mit', 'engineering'),
(86, 'Mention the ca theories of instruction and give two examples for each category', 2, 'mit', 'engineering'),
(87, 'Explain LDA, STA and DAA instructions', 2, 'mit', 'engineering'),
(88, 'Explain the different instruction formats with examples', 2, 'mit', 'engineering'),
(89, 'What is the use of addressing modes, mention the different types?', 2, 'mit', 'engineering'),
(90, 'What is the use of bi-directional buffers?', 2, 'mit', 'engineering'),
(91, 'Give the register organization of 8085', 2, 'mit', 'engineering'),
(92, 'Define stack and explain stack related instructions', 2, 'mit', 'engineering'),
(93, 'Why do we use XRA A INSTRUCTION?', 2, 'mit', 'engineering'),
(94, 'Compare CALL and PUSH instruction', 2, 'mit', 'engineering'),
(95, 'What is Microcontroller and Microcomputer?', 2, 'mit', 'engineering'),
(96, 'Define Flags', 2, 'mit', 'engineering'),
(97, 'How does the microprocessor differentiate between data and instruction?', 2, 'mit', 'engineering'),
(98, 'What is subroutine?', 2, 'mit', 'engineering'),
(99, 'What are the difference between microcontroller and microprocessor?', 2, 'mit', 'engineering'),
(100, 'What are the flags available in 8085 explain?', 2, 'mit', 'engineering'),
(101, 'If the frequency of the crystal connected to 8085 is 6MHz calculate the time to fetch and execute NOP instruction?', 2, 'mit', 'engineering'),
(102, 'What is a T-state?', 2, 'mit', 'engineering'),
(103, 'Define instruction cycle and machine cycle?', 2, 'mit', 'engineering'),
(104, 'Explain the architecture of microprocessor 8085.', 3, 'mit', 'engineering'),
(106, 'Explain the requirement of a program counter, stack pointer and status flags in the architecture of 8085 microprocessor.', 3, 'mit', 'engineering'),
(107, 'Explain the memory mapped i/o addressing scheme.', 3, 'mit', 'engineering'),
(108, 'Draw and explain the timing diagram of memory read cycle.', 3, 'mit', 'engineering'),
(109, 'Draw and explain the timing diagram of memory write cycle with example.', 3, 'mit', 'engineering'),
(110, 'Draw and explain the timing diagram of opcode fetch cycle.', 3, 'mit', 'engineering'),
(111, 'Explain the direct addressing modes and indirect addressing modes of 8085 with example.', 3, 'mit', 'engineering'),
(112, 'Assume that the accumulator contents data bytes 88 hand instruction MOV C, A 4FH is fetched. List the steps decoding and executing the instruction.', 3, 'mit', 'engineering'),
(113, ' Draw the functional block diagram of 8085 microprocessor and explain.', 3, 'mit', 'engineering'),
(114, 'Write a Program to Perform the following functions and verify the output steps: a. Load the number 5CH in register D b. Load the number 9E H in register C . Increment the Contents of register C by one. d. Add the contents of register C and D and Display the sum at output port1.', 3, 'mit', 'engineering'),
(115, 'Write an assembly language program to find out the largest number from a given unordered array of 8 bit numbers, stored in the locations starting from a known address.', 3, 'mit', 'engineering'),
(116, 'With suitable examples explain 8085 instruction set in detail.', 3, 'mit', 'engineering'),
(117, 'With suitable examples explain 8085 addressing modes in detail.', 3, 'mit', 'engineering'),
(118, 'Explain 8085 Stack in detail.', 3, 'mit', 'engineering'),
(119, 'Write a 8085 ALP to generate a accurate time delay of 100ms.', 3, 'mit', 'engineering'),
(120, 'Write 8085 assembly language program to SORT an array of 10 bytes in Descending order.', 3, 'mit', 'engineering'),
(121, 'Explain 8085 stack in detail?', 3, 'mit', 'engineering'),
(122, 'Write an 8085 ALP to perform 32 bit binary addition?', 3, 'mit', 'engineering'),
(123, 'List out the maskable and non maskable interrupt available in 8085? (8)', 3, 'mit', 'engineering'),
(124, 'Write an 8085 ALP to convert the hexadecimal value to decimal value? (8) ', 3, 'mit', 'engineering'),
(125, 'Write Algorithm for sorting an array according to absolute difference with given value.', 2, 'daa', 'engineering'),
(128, 'sjdksads sdfsahfsdicj', 7, 'daa', 'engineering'),
(129, 'What is anatomy?', 2, 'anat', 'medical'),
(130, 'Why you study anatomy?', 2, 'anat', 'medical'),
(131, 'Are you really knowing what anatomy is?', 2, 'anat', 'medical'),
(132, 'Who took course on anatomy?', 2, 'anat', 'medical'),
(133, 'Why the hack you study anatomy?', 2, 'anat', 'medical'),
(134, 'Name all the chapters that you are having in anatomy.', 2, 'anat', 'medical'),
(135, 'How much you really studied anatomy?', 2, 'anat', 'medical'),
(136, 'Where anatomy is used in real medical field', 5, 'anat', 'medical'),
(137, 'Anatomy Anatomy Anatomy Anatomy Anatomy!', 3, 'anat', 'medical'),
(138, 'This year full marks in anatomy!', 3, 'anat', 'medical'),
(139, 'How much you you really know what is anatomy!', 5, 'anat', 'medical'),
(140, 'Name any 12 parts of body.', 3, 'anat', 'medical');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(255) NOT NULL,
  `name` varchar(500) NOT NULL,
  `code` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `code`, `type`) VALUES
(0, 'Design and Analysis of Algorithms', 'daa', 'engineering'),
(1, 'Microprocessor and Interfacing Techniques', 'mit', 'engineering'),
(2, 'Principle of Genetics', 'pog', 'agriculture'),
(3, 'Princliple of Plant Breeding', 'popb', 'agriculture'),
(4, 'Anatomy', 'anat', 'medical'),
(5, 'Biochemistry', 'biochem', 'medical');

-- --------------------------------------------------------

--
-- Table structure for table `tempQuestions`
--

CREATE TABLE `tempQuestions` (
  `id` int(255) NOT NULL,
  `uploader` varchar(30) NOT NULL,
  `question` varchar(5000) NOT NULL,
  `marks` int(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `propic` varchar(50) NOT NULL,
  `block` tinyint(1) NOT NULL DEFAULT '0',
  `verified` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userName`, `password`, `mail`, `propic`, `block`, `verified`) VALUES
(1, 'adminbro', '4832cc3d33fab05b5bed2c73b5fe183d', 'admin@takeiteasy.com', 'adminbro.png', 0, 'verified'),
(2, 'vdmehta', '2b297c10a89b861fb639fa78717ff1a2', 'vatsal@gmail.com', 'default.png', 0, 'verified'),
(3, 'gogo77', '0b4de64821b8ae266fa1ca5c35ea6931', 'gogo@namere.com', 'gogo77.jpg', 0, 'verified'),
(4, 'aaaaaa', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'a@a.aa', 'default.png', 0, 'verified'),
(5, 'debugtest', '7ded3198c265316c33cdfb63aa3e676a', 'aa@aa.aaa', 'default.png', 1, 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `questionpapers`
--
ALTER TABLE `questionpapers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `tempQuestions`
--
ALTER TABLE `tempQuestions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
