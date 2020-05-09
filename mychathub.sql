-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2020 at 07:36 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mychathub`
--

-- --------------------------------------------------------

--
-- Table structure for table `block_list`
--

CREATE TABLE `block_list` (
  `id` int(11) NOT NULL,
  `user_id_1` text NOT NULL,
  `user_id_2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_id_1` text NOT NULL,
  `user_id_2` text NOT NULL,
  `accept` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user_id_1`, `user_id_2`, `accept`) VALUES
(2, '0680cb2d0343b161134686e5924da9d4', '166ac38ac674cb863765f45dab414c1c', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_chats`
--

CREATE TABLE `personal_chats` (
  `id` int(11) NOT NULL,
  `sender_user_id` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `receiver_user_id` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `msg` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `seen` int(11) NOT NULL DEFAULT 0,
  `sender_seen` int(11) NOT NULL DEFAULT 0,
  `sent_time` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `personal_chats`
--

INSERT INTO `personal_chats` (`id`, `sender_user_id`, `receiver_user_id`, `msg`, `seen`, `sender_seen`, `sent_time`) VALUES
(1, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', 'hi', 1, 1, 1584267213),
(2, 'a0f913565a575e11480aa6fad91c2178', '166ac38ac674cb863765f45dab414c1c', 'hello', 1, 1, 1584267536),
(3, 'a0f913565a575e11480aa6fad91c2178', '166ac38ac674cb863765f45dab414c1c', 'ok', 1, 1, 1584267546),
(4, 'a0f913565a575e11480aa6fad91c2178', '166ac38ac674cb863765f45dab414c1c', '1', 1, 1, 1584267685),
(5, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', '2', 1, 1, 1584267691),
(6, 'a0f913565a575e11480aa6fad91c2178', '166ac38ac674cb863765f45dab414c1c', '3', 1, 1, 1584267696),
(7, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', 'j', 1, 1, 1584267742),
(8, 'a0f913565a575e11480aa6fad91c2178', '166ac38ac674cb863765f45dab414c1c', 'hi', 1, 1, 1584267749),
(9, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', 'hello', 1, 1, 1584267754),
(10, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', 'hi', 1, 1, 1584267806),
(11, 'a0f913565a575e11480aa6fad91c2178', '166ac38ac674cb863765f45dab414c1c', 'heelo', 1, 1, 1584267817),
(12, 'a0f913565a575e11480aa6fad91c2178', '166ac38ac674cb863765f45dab414c1c', 'm', 1, 1, 1584267841),
(13, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', 'h', 1, 1, 1584267845),
(14, 'a0f913565a575e11480aa6fad91c2178', '166ac38ac674cb863765f45dab414c1c', 'hi', 1, 1, 1584267895),
(15, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', 'hi', 1, 1, 1584267898),
(16, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', 'hi', 1, 1, 1584267935),
(17, 'a0f913565a575e11480aa6fad91c2178', '166ac38ac674cb863765f45dab414c1c', '1', 1, 1, 1584267939),
(18, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', 'hi', 1, 1, 1584268083),
(19, 'a0f913565a575e11480aa6fad91c2178', '166ac38ac674cb863765f45dab414c1c', 'heelo', 1, 1, 1584268086),
(20, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', 'ok', 1, 1, 1584268090),
(21, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', 'ygu', 1, 1, 1584268092),
(22, 'a0f913565a575e11480aa6fad91c2178', '166ac38ac674cb863765f45dab414c1c', 'http://localhost/chatroom/upload/pm_chat_uploads/thumbnails/thumb_x_sm_291113a0f913565a575e11480aa6fad91c21781584268146.png hi', 1, 1, 1584268146),
(23, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', 'L', 1, 1, 1584268152),
(24, '166ac38ac674cb863765f45dab414c1c', 'a0f913565a575e11480aa6fad91c2178', 'hg', 0, 1, 1584268702),
(25, '166ac38ac674cb863765f45dab414c1c', '6e58f64ee69bff1005c04069044409b7', 'hi', 0, 1, 1584374673),
(26, '166ac38ac674cb863765f45dab414c1c', '0680cb2d0343b161134686e5924da9d4', 'hi', 0, 0, 1588694500),
(27, '166ac38ac674cb863765f45dab414c1c', '0680cb2d0343b161134686e5924da9d4', 'hi', 0, 0, 1588694604),
(28, '166ac38ac674cb863765f45dab414c1c', '0680cb2d0343b161134686e5924da9d4', 'hi', 0, 0, 1588694667),
(29, '166ac38ac674cb863765f45dab414c1c', '0680cb2d0343b161134686e5924da9d4', 'hi', 0, 0, 1588694738),
(30, '166ac38ac674cb863765f45dab414c1c', '0680cb2d0343b161134686e5924da9d4', 'gfdgdffd', 0, 0, 1588694791),
(31, '166ac38ac674cb863765f45dab414c1c', '0680cb2d0343b161134686e5924da9d4', 'fdfd', 0, 0, 1588694829),
(32, '166ac38ac674cb863765f45dab414c1c', '0680cb2d0343b161134686e5924da9d4', 'ewewew', 0, 0, 1588694899),
(33, '166ac38ac674cb863765f45dab414c1c', '0680cb2d0343b161134686e5924da9d4', 'tr', 0, 0, 1588694931),
(34, '166ac38ac674cb863765f45dab414c1c', '0680cb2d0343b161134686e5924da9d4', 'fd', 0, 0, 1588695023),
(35, '166ac38ac674cb863765f45dab414c1c', '0680cb2d0343b161134686e5924da9d4', 'fd', 0, 0, 1588695092);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_id` text NOT NULL,
  `room_name` text NOT NULL,
  `room_desc` text NOT NULL,
  `room_type` int(11) NOT NULL DEFAULT 0,
  `icon` text NOT NULL,
  `room_created` int(11) NOT NULL,
  `creator_user_id` text NOT NULL,
  `wlcm_msg` text NOT NULL,
  `who_can_enter` int(11) NOT NULL,
  `category` text NOT NULL,
  `room_pass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_id`, `room_name`, `room_desc`, `room_type`, `icon`, `room_created`, `creator_user_id`, `wlcm_msg`, `who_can_enter`, `category`, `room_pass`) VALUES
(41, '72bb59f4a7d9c28950b6337edd841cb9', 'BootStrap', 'syhjnwe', 1, '', 1560771372, '1494407d5c129e2b951fc014b350f629', 'rehjkec eurw iuw3be 2j3ub2 3b2', 0, '0', '1f3870be274f6c49b3e31a0c6728957f'),
(42, 'd45b7843304e2b7629aa42017020fac2', 'PHP', 'iurs esiubew kjbieuw ewuhwe', 0, '', 1560782491, '1494407d5c129e2b951fc014b350f629', 'iurs esiubew kjbieuw ewuhwe', 0, '0', 'd41d8cd98f00b204e9800998ecf8427e'),
(44, '0552e91710dff478ab74253cd9ba9659', 'SEO', 'Search Engine Oprimization', 0, '', 1561404573, '1494407d5c129e2b951fc014b350f629', 'Search engine optimization...', 0, '0', 'd41d8cd98f00b204e9800998ecf8427e'),
(45, '249c9139eecb2d04a5b434107f83056d', 'N e W R oo M', 'fdyghbjd', 0, '', 1561472690, '1494407d5c129e2b951fc014b350f629', 'ybhjre', 0, '0', 'd41d8cd98f00b204e9800998ecf8427e'),
(49, 'b9f8812a6522628ed2956e4c6ad25ea0', 'Friends', 'For Friends', 0, '', 1565069859, '166ac38ac674cb863765f45dab414c1c', 'Welcome...', 0, '2', 'd41d8cd98f00b204e9800998ecf8427e'),
(50, '76f16189c2796c491ed9091a24fdbb4b', 'Developers', 'For developers', 0, '', 1565073364, '166ac38ac674cb863765f45dab414c1c', 'Welcome...', 0, '0', 'd41d8cd98f00b204e9800998ecf8427e'),
(51, '001d9331c409250292ba4c5121da6c6b', 'BIT_roommates', 'This room is for bit studens.', 1, '', 1567347313, '166ac38ac674cb863765f45dab414c1c', 'Welcome here', 0, '2', '5c06faa01f43f28b98b64473331bfdb9');

-- --------------------------------------------------------

--
-- Table structure for table `room_chat`
--

CREATE TABLE `room_chat` (
  `id` int(11) NOT NULL,
  `room_id` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `user_id` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `msg` mediumtext COLLATE utf8mb4_bin NOT NULL,
  `msg_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `room_chat`
--

INSERT INTO `room_chat` (`id`, `room_id`, `user_id`, `msg`, `msg_time`) VALUES
(23, '76f16189c2796c491ed9091a24fdbb4b', '166ac38ac674cb863765f45dab414c1c', 'wee', 1584365011),
(24, '76f16189c2796c491ed9091a24fdbb4b', '4410e1a1bc49af5df4b4340c0c478f09', 'ewew', 1584365013),
(26, '76f16189c2796c491ed9091a24fdbb4b', '4410e1a1bc49af5df4b4340c0c478f09', 'weeeeeeeee', 1584365019),
(36, '76f16189c2796c491ed9091a24fdbb4b', '3061fed71192ce2f29ee91ee832eba3e', 'hi', 1588741417),
(37, '76f16189c2796c491ed9091a24fdbb4b', '3061fed71192ce2f29ee91ee832eba3e', '1', 1588741432),
(38, '76f16189c2796c491ed9091a24fdbb4b', '166ac38ac674cb863765f45dab414c1c', '2', 1588741440),
(39, '76f16189c2796c491ed9091a24fdbb4b', '3061fed71192ce2f29ee91ee832eba3e', '3', 1588741502),
(40, '76f16189c2796c491ed9091a24fdbb4b', '166ac38ac674cb863765f45dab414c1c', '4', 1588741511),
(41, '76f16189c2796c491ed9091a24fdbb4b', '3061fed71192ce2f29ee91ee832eba3e', 'http://localhost/chatroom/upload/room_chat_uploads/thumbnails/thumb_x_sm_8155803061fed71192ce2f29ee91ee832eba3e1588741525.png ', 1588741525),
(44, '76f16189c2796c491ed9091a24fdbb4b', '166ac38ac674cb863765f45dab414c1c', 'http://localhost:8078/chatroom/upload/room_chat_uploads/thumbnails/thumb_x_sm_42606166ac38ac674cb863765f45dab414c1c1588741612.jpg ', 1588741612),
(45, '76f16189c2796c491ed9091a24fdbb4b', '166ac38ac674cb863765f45dab414c1c', 'G', 1588741623),
(46, '76f16189c2796c491ed9091a24fdbb4b', '3061fed71192ce2f29ee91ee832eba3e', '5', 1588741638),
(47, '76f16189c2796c491ed9091a24fdbb4b', '166ac38ac674cb863765f45dab414c1c', '8', 1588741641),
(48, '76f16189c2796c491ed9091a24fdbb4b', '166ac38ac674cb863765f45dab414c1c', 'http://localhost:8078/chatroom/upload/room_chat_uploads/thumbnails/thumb_x_sm_893710166ac38ac674cb863765f45dab414c1c1588741652.jpg Ghh', 1588741652),
(49, '76f16189c2796c491ed9091a24fdbb4b', '166ac38ac674cb863765f45dab414c1c', 'http://localhost:8078/chatroom/upload/room_chat_uploads/3977166ac38ac674cb863765f45dab414c1c1588741756.mp4 ', 1588741756),
(58, '76f16189c2796c491ed9091a24fdbb4b', '3061fed71192ce2f29ee91ee832eba3e', 'http://localhost/chatroom/upload/room_chat_uploads/thumbnails/thumb_x_sm_7448983061fed71192ce2f29ee91ee832eba3e1588742148.png ', 1588742148),
(59, '76f16189c2796c491ed9091a24fdbb4b', '3061fed71192ce2f29ee91ee832eba3e', 'http://localhost/chatroom/upload/room_chat_uploads/thumbnails/thumb_x_sm_6619643061fed71192ce2f29ee91ee832eba3e1588742282.jpg ', 1588742282),
(60, '76f16189c2796c491ed9091a24fdbb4b', '3061fed71192ce2f29ee91ee832eba3e', 'http://localhost/chatroom/upload/room_chat_uploads/thumbnails/thumb_x_sm_4250843061fed71192ce2f29ee91ee832eba3e1588742407.png ', 1588742407);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `token_id` text NOT NULL,
  `session_id` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `age` int(11) NOT NULL DEFAULT 18,
  `gender` int(11) NOT NULL DEFAULT 1,
  `profile_pic` text NOT NULL,
  `cover_pic` text NOT NULL,
  `language` text NOT NULL,
  `online` int(11) NOT NULL DEFAULT 1,
  `last_active` int(11) NOT NULL DEFAULT 0,
  `bio` text NOT NULL,
  `account_created` text NOT NULL,
  `verfied` int(11) NOT NULL DEFAULT 0,
  `theme` int(11) NOT NULL DEFAULT 0,
  `pm_status` int(11) NOT NULL DEFAULT 1,
  `active_room` text NOT NULL,
  `user_rank` int(11) NOT NULL DEFAULT 1,
  `country` text NOT NULL,
  `vip_status` int(11) NOT NULL DEFAULT 0,
  `mood` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `token_id`, `session_id`, `username`, `email`, `password`, `age`, `gender`, `profile_pic`, `cover_pic`, `language`, `online`, `last_active`, `bio`, `account_created`, `verfied`, `theme`, `pm_status`, `active_room`, `user_rank`, `country`, `vip_status`, `mood`) VALUES
(1, '166ac38ac674cb863765f45dab414c1c', 'cBsBPxNLx01tYgwqqI3tI6:APA91bEs9f_VzbT91vMvPPytRc9n-YXs0NlEdlQnQqbvnPDqZArm0uv5etMNRG4C88W52LSSEWQb-Naq6v9pRib_E2BD5y-XHbT3p0qwTWhplZllEQpeRxRv5-IZQsRF3K-aRu6CjPw4', '1knkn90bg263bmpbnemi4f2ukj', 'manish', 'manish@mychathub.in', 'e8e525f494cff33f5b8c36bd37e346ee', 18, 1, '886284166ac38ac674cb863765f45dab414c1c1588515981.png', '739504166ac38ac674cb863765f45dab414c1c1584384575.jpg', 'english', 1, 1589002157, 'edre', '1563358165', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 1, 'India', 1, 'Coding'),
(2, '20804296b311db02887e573d0a8aa966', '', '', '(GUEST-manish00_751563383262)', '', '', 18, 1, '', '', '', 1, 1563384305, '', '1563383262', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(3, '9f8397b40b23141c5717033a7765e9a5', '', '', '(GUEST-newUser_281563384361)', '', '', 18, 1, '', '', '', 1, 1563384374, '', '1563384361', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(4, '47f73cbd22fe91e90f95cd210f94f75b', '', '', '(GUEST-rwfhiw_831563384584)', '', '', 18, 1, '', '', '', 1, 1563384590, '', '1563384584', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(5, 'b837dd47dce82ff914271bedca3d479f', '', '', '(GUEST-ewihknlwe_331563385072)', '', '', 18, 1, '', '', '', 1, 1563385077, '', '1563385072', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(6, '0a8037e0792b6b78ddf1de6ca2e50c99', '', '', '(GUEST-NewGuest_201563386510)', '', '', 18, 1, '', '', '', 1, 1563387209, '', '1563386510', 0, 0, 1, 'd45b7843304e2b7629aa42017020fac2', 0, '0', 0, ''),
(7, '0883939756b719e76163ff24b31d2bb0', '', '', '(GUEST-Chatbot_971563387438)', '', '', 18, 1, '', '', '', 1, 1563388702, '', '1563387438', 0, 0, 1, '', 0, '0', 0, ''),
(8, '831c836a2d6a5eb58d7e7ecfc85853b3', '', '', '(GUEST-Harsh_561563432659)', '', '', 18, 1, '', '', '', 1, 1563432720, '', '1563432659', 0, 0, 1, 'd45b7843304e2b7629aa42017020fac2', 0, '0', 0, ''),
(9, '654acfa3f5f7625e59e945a16d25431d', '', '', '(GUEST-DemoUser_561563440436)', '', '', 18, 1, '', '', '', 1, 1563443866, '', '1563440436', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(10, 'adfb49c1c3d74d3f27e1f7d6e4ebfcfc', '', '', '(GUEST-AwsmUser_561563453537)', '', '', 18, 1, '', '', '', 1, 1563475022, '', '1563453537', 0, 0, 1, '0552e91710dff478ab74253cd9ba9659', 0, '0', 0, ''),
(11, '19c49708d348aae8d2ce655dc8afee2d', '', '', '(GUEST-SakruTheGreat_361563543440)', '', '', 18, 1, '', '', '', 1, 1563543604, '', '1563543440', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(12, 'ad0fbe545b79b8217eee219c3baf6356', '', '', '(GUEST-Sid_861563543483)', '', '', 18, 1, '', '', '', 1, 1563543514, '', '1563543483', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(13, '0067f85fbbdb17a1a1de4c31c9868019', '', '', '(GUEST-Harsh gupta_581563543506)', '', '', 18, 1, '', '', '', 1, 1563543690, '', '1563543506', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(14, '649ebfe2bcb4043e4b004d9bafc889cf', '', '', '(GUEST-Sidd_311563543562)', '', '', 18, 1, '', '', '', 1, 1563543592, '', '1563543562', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(15, '52e8e8bc83e336d9093f4d9a0abac289', '', '', '(GUEST-Shakru_431563543631)', '', '', 18, 1, '', '', '', 1, 1563543904, '', '1563543631', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(16, 'bc3fe7e9bd2f986fe07874cfd103cb97', '', '', '(GUEST-hbrehs_941563561303)', '', '', 18, 1, '', '', '', 1, 1563561303, '', '1563561303', 0, 0, 1, '', 0, '0', 0, ''),
(17, '331d7022f5eaee0a00441c0a42ae488f', '', '', '(GUEST-Gjjv_361563563751)', '', '', 18, 1, '', '', '', 1, 1563563751, '', '1563563751', 0, 0, 1, '', 0, '0', 0, ''),
(18, '012fa5be7f86118f84f0e21c697d1422', '', '', '(GUEST-Ydhgj_331563599614)', '', '', 18, 1, '', '', '', 1, 1563600844, '', '1563599614', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(19, '91806c07ab25c2779fddad35756beae7', '', '', '(GUEST-Asgh_361563599776)', '', '', 18, 1, '', '', '', 1, 1563599807, '', '1563599776', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(20, '186c24a817d65cddc11fe09fc11d33eb', '', '', '(GUEST-Ert_811563599864)', '', '', 18, 1, '', '', '', 1, 1563600231, '', '1563599864', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(21, '9b9154b1e1d3e5cae62aa0f34eef3c70', '', '', '(GUEST-jy6uteru_151563600739)', '', '', 18, 1, '', '', '', 1, 1563604160, '', '1563600739', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(22, '617f6e87557b90852ed1917f37ceb8c5', '', '', '(GUEST-Sean10_381563712371)', '', '', 18, 1, '', '', '', 1, 1563712402, '', '1563712371', 0, 0, 1, 'd45b7843304e2b7629aa42017020fac2', 0, '0', 0, ''),
(23, 'df2210920108aa6b7795cd5713a5de94', '', '', '(GUEST-Sudha_471563936368)', '', '', 18, 1, '', '', '', 1, 1563936431, '', '1563936368', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(24, '080b0de1836e46391a1e22952dd4d21f', '', '', '(GUEST-Rjn2126_651563945099)', '', '', 18, 1, '', '', '', 1, 1563945334, '', '1563945099', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(25, '8b12030ccd0e386ce8e6ff23be3e4ece', '', '', '(GUEST-Jenny2126_211563945370)', '', '', 18, 1, '', '', '', 1, 1563945538, '', '1563945370', 0, 0, 1, '', 0, '0', 0, ''),
(26, '9b3e93289b83da1d273ad3c1d8229e6b', '', '', '(GUEST-anyone_591564037108)', '', '', 18, 1, '', '', '', 1, 1564037200, '', '1564037108', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(27, 'c375a77acaab95cae6e2834ca0b0829f', '', '', '(GUEST-njh_671564037850)', '', '', 18, 1, '', '', '', 1, 1564037859, '', '1564037850', 0, 0, 1, '0552e91710dff478ab74253cd9ba9659', 0, '0', 0, ''),
(28, '157b927f2ca9a090026eb37e8f58a5e6', '', '', '(GUEST-Guest_651564303464)', '', '', 18, 1, '', '', '', 1, 1564312077, '', '1564303464', 0, 0, 1, '', 0, '0', 0, ''),
(29, '9ff8c90aa604ab061b2740416bd8d62a', '', '', '(GUEST-Guest2_451564312116)', '', '', 18, 1, '', '', '', 1, 1564312147, '', '1564312116', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(30, 'b75006bae4ae241587101b70b6c65db5', '', '', '(GUEST-Guest3_521564312175)', '', '', 18, 1, '', '', '', 1, 1564313345, '', '1564312175', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(31, 'ff1efa810b23ab26ee08b57033ee990b', '', '', '(GUEST-Guest4_641564313368)', '', '', 18, 1, '', '', '', 1, 1564313548, '', '1564313368', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(32, '74b917f4a23281ad0a6cd78e1ead3431', '', '', '(GUEST-Guest5_461564313561)', '', '', 18, 1, '', '', '', 1, 1564313861, '', '1564313561', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(33, '84e5169eba151ed8bbec30434bb866e7', '', '', '(GUEST-Guest6_431564313875)', '', '', 18, 1, '', '', '', 1, 1564314086, '', '1564313875', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(34, '94c6862463ffffeffa04fd2c333cfb96', '', '', '(GUEST-Guest7_881564314424)', '', '', 18, 1, '', '', '', 1, 1564314426, '', '1564314424', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(35, 'c71b921c96d57a26e94d23c473d37b41', '', '', '(GUEST-Guest8_951564314449)', '', '', 18, 1, '', '', '', 1, 1564315081, '', '1564314449', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(36, 'd8d79207c453ecad879ff62e4f4f4b62', '', '', '(GUEST-guest9_951564373468)', '', '', 18, 1, '', '', '', 1, 1564425689, '', '1564373468', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(37, 'e8b06d727b67bdeb22b4385fdc43e381', '', '', '(GUEST-guest10_701564373571)', '', '', 18, 1, '', '', '', 1, 1564376282, '', '1564373571', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(38, 'b304e079102aaabef0119dac88009380', '', '', '(GUEST-Guest11_341564377747)', '', '', 18, 1, '', '', '', 1, 1564398454, '', '1564377747', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(39, 'b215bb7e5eae408d2146440703bc5598', '', '', '(GUEST-guest12_131564397158)', '', '', 18, 1, '', '', '', 1, 1564399469, '', '1564397158', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(40, 'c58bcc3029dec40b1587c2160cd47937', '', '', '(GUEST-Guest13_971564403929)', '', '', 18, 1, '', '', '', 1, 1564411110, '', '1564403929', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(41, '0b455c471e8de06444340ae7c86f6ea2', '', '', '(GUEST-Guest14_401564412936)', '', '', 18, 1, '', '', '', 1, 1564416007, '', '1564412936', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(42, '818f910e94c9230f2f735d8e0ca29bdb', '', '', '(GUEST-Guest17_571564419395)', '', '', 18, 1, '', '', '', 1, 1564423883, '', '1564419395', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(43, '627bf295e4213d395baa54e33555f3bc', '', '', '(GUEST-Guest18_871564472898)', '', '', 18, 1, '', '', '', 1, 1564474311, '', '1564472898', 0, 0, 1, '72bb59f4a7d9c28950b6337edd841cb9', 0, '0', 0, ''),
(44, '8490b34a3eff6b2069dd44318a66360b', '', '', '(GUEST-Ggsstt_301564473475)', '', '', 18, 1, '', '', '', 1, 1564474083, '', '1564473475', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(45, '1dec16448c69aabbf3b093e92d14be04', '', '', '(GUEST-SuperBoi_161564473559)', '', '', 18, 1, '', '', '', 1, 1564474193, '', '1564473559', 0, 0, 1, '', 0, '0', 0, ''),
(46, '05d83d0c1989bb71c9ef5c74a55b150e', '', '', '(GUEST-ytdy_511564473937)', '', '', 18, 1, '', '', '', 1, 1564507944, '', '1564473937', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(47, 'eab4189d404f27efa933f1c0f282bbac', '', '', 'Shekhar', 'shekharnag7867@gmail.com', 'a6f0801dc3e6f79265ffe3aaa88a6208', 18, 1, '', '', '', 1, 1564938807, '', '1564480137', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 1, '0', 0, ''),
(48, '58aba494f4cb4a79744f4bd78379f4ee', '', '', '(GUEST-Guest19_671564519652)', '', '', 18, 1, '', '', '', 1, 1564520719, '', '1564519652', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(49, '0095b02d2631e056f611ff88c85cf589', '', '', '(GUEST-Guest20_731564541567)', '', '', 18, 1, '', '', '', 1, 1564541573, '', '1564541567', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(50, '58634c412fddf3fd6e7109197e0db60a', '', '', '(GUEST-Guest21_921564541664)', '', '', 18, 1, '', '', '', 1, 1564541667, '', '1564541664', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(51, '499c7a75a63d72d1bb59f963f00b7e12', '', '', '(GUEST-Guest22_951564541749)', '', '', 18, 1, '', '', '', 1, 1564541750, '', '1564541749', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(52, '0680cb2d0343b161134686e5924da9d4', 'cBsBPxNLx01tYgwqqI3tI6:APA91bEs9f_VzbT91vMvPPytRc9n-YXs0NlEdlQnQqbvnPDqZArm0uv5etMNRG4C88W52LSSEWQb-Naq6v9pRib_E2BD5y-XHbT3p0qwTWhplZllEQpeRxRv5-IZQsRF3K-aRu6CjPw4', 'l3rc248slde9stktd65i2gpgok', 'Manish2', 'App@mychathub.in', 'e8e525f494cff33f5b8c36bd37e346ee', 18, 1, '', '', '', 1, 1588999980, '', '1564541824', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 1, '0', 0, ''),
(53, '9c3ad1913d530dea87e0e84df9ded593', '', '', '(GUEST-Guest22_861564679007)', '', '', 18, 1, '', '', '', 0, 1564679017, '', '1564679007', 0, 0, 1, '', 0, '0', 0, ''),
(54, '0ef4c9e8ba40eb1f6cafe6e29ceff6a8', '', '', '(GUEST-Opera_user_801564768675)', '', '', 18, 1, '', '', '', 1, 1564769762, '', '1564768675', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(55, 'f2dbc725d1cb01ceab091674c91268bb', '', '', '(GUEST-new_guest_841564795203)', '', '', 18, 1, '', '', '', 1, 1564795384, '', '1564795203', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(56, '5539723db6fb3a86886ebfb0467583fa', '', '', '(GUEST-new_guest_961564795999)', '', '', 18, 1, '', '', '', 1, 1564796125, '', '1564795999', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(57, '53a95bd3162d44f58334bb0ffad9f169', '', '', '(GUEST-new_guest_931564796308)', '', '', 18, 1, '', '', '', 1, 1564796344, '', '1564796308', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(79, '853dc7278e18b32a5839fd1fb49bfa1c', '', '', '(GUEST-tegs_931565066143)', '', '', 18, 1, '', '', '', 0, 1565066147, '', '1565066143', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(80, '00846adc75cbb3a51005421279038905', '', '', '(GUEST-ewfa_111565066163)', '', '', 18, 1, '', '', '', 1, 1565066200, '', '1565066163', 0, 0, 1, '', 0, '0', 0, ''),
(81, 'a5b1e97554e0f5d99d4597c641edb35f', '', '', '(GUEST-tyjh_911565066243)', '', '', 18, 1, '', '', '', 0, 1565066304, '', '1565066243', 0, 0, 1, '', 0, '0', 0, ''),
(82, '0b00c866d49f3915e015261f93f05315', '', '', '(GUEST-ewad_181565066394)', '', '', 18, 1, '', '', '', 0, 1565066396, '', '1565066394', 0, 0, 1, '', 0, '0', 0, ''),
(83, '0bb03c3b503e0a03b51ffc06b43c40d4', '', '', '(GUEST-yghj_241565066523)', '', '', 18, 1, '', '', '', 0, 1565066525, '', '1565066523', 0, 0, 1, '', 0, '0', 0, ''),
(84, '23769719774e52e2bf47954a5b996b85', '', '', '(GUEST-hujk_321565066853)', '', '', 18, 1, '', '', '', 0, 1565066857, '', '1565066853', 0, 0, 1, '', 0, '0', 0, ''),
(85, 'c1b04529561d6e7334cae02a59089766', '', '', '(GUEST-jhk_761565066872)', '', '', 18, 1, '', '', '', 0, 1565066888, '', '1565066872', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(86, 'c96ff617c95e5357589bed0508963c8f', '', '', '(GUEST-hjk_251565066904)', '', '', 18, 1, '', '', '', 0, 1565066909, '', '1565066904', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(87, '40e916a3de2d70c247d0c9385c8f3873', '', '', '(GUEST-hteds_821565067154)', '', '', 18, 1, '', '', '', 0, 1565067235, '', '1565067154', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(88, '85eecf8980305c43789ca8fe44058dbd', '', '', '(GUEST-new_guest_621565234407)', '', '', 18, 1, '', '', '', 1, 1565238057, '', '1565234407', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(89, '24d153380330cb8e2541dfc280c0a1ae', '', '', '(GUEST-guest_761565287053)', '', '', 18, 1, '', '', '', 1, 1565287061, '', '1565287053', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(90, 'c97a55f193add44d16b9ede4d09ac2ea', '', '', '(GUEST-guest_2_261565287163)', '', '', 18, 1, '', '', '', 1, 1565287163, '', '1565287163', 0, 0, 1, '', 0, '0', 0, ''),
(91, '470bdb071c7863628888b894b432cf51', '', '', '(GUEST-guest_3_851565287193)', '', '', 18, 1, '', '', '', 1, 1565290290, '', '1565287193', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(92, 'e036477e21f1c214c31b8942c0344708', '', '', '(GUEST-Manish4_461565651476)', '', '', 18, 1, '', '', '', 1, 1565651666, '', '1565651476', 0, 0, 1, '', 0, '0', 0, ''),
(93, '23928d2325847474dcc0ee6a5928ce61', '', '', '(GUEST-edtrfgy_631565651539)', '', '', 18, 1, '', '', '', 1, 1565652896, '', '1565651539', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(94, '40e935b80988ef3b7ec275f5f302e6e1', '', '', '(GUEST-Ydusjs_511565651692)', '', '', 18, 1, '', '', '', 1, 1565652113, '', '1565651692', 0, 0, 1, '', 0, '0', 0, ''),
(95, 'e49b608b9408919886f302ff5a8ea7b4', '', '', '(GUEST-Vhhcc_251565652304)', '', '', 18, 1, '', '', '', 1, 1565652335, '', '1565652304', 0, 0, 1, '', 0, '0', 0, ''),
(96, '63a2ebc06da96a797c869a7c2c26ec24', '', '', '(GUEST-Jnvc_501565652396)', '', '', 18, 1, '', '', '', 1, 1565652479, '', '1565652396', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(97, '765737bb576c0c935579f0adf0901717', '', '', '(GUEST-Hvbv_731565652609)', '', '', 18, 1, '', '', '', 1, 1565653154, '', '1565652609', 0, 0, 1, '', 0, '0', 0, ''),
(98, 'a20d1778ae60713a7e73aea5e72601bf', '', '', '(GUEST-yuhjk_561565652972)', '', '', 18, 1, '', '', '', 1, 1565653529, '', '1565652972', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(99, '806aa1731309421915fb17afc682abed', '', '', '(GUEST-Chrome_221565719856)', '', '', 18, 1, '', '', '', 1, 1565719860, '', '1565719856', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(100, '6bbe88b20c166e1ff4b3a880c1afb2e2', '', '', '(GUEST-Chrome IG_861565719890)', '', '', 18, 1, '', '', '', 1, 1565719892, '', '1565719890', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(101, '6ae56feb8f7ff9b8043ea0ff7a9bff50', '', '', '(GUEST-chrome deskop IG_211565719919)', '', '', 18, 1, '', '', '', 1, 1565720100, '', '1565719919', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(102, '6531a6e9be8779c8f5b5b338610851aa', '', '', '(GUEST-Opera_1001565719955)', '', '', 18, 1, '', '', '', 1, 1565719985, '', '1565719955', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(103, '31e0e31386b0f8d53b974c3d8f94e520', '', '', '(GUEST-Chrome android manish_691565720010)', '', '', 18, 1, '', '', '', 1, 1565720371, '', '1565720010', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(104, '2385ea462433814de54de118515f1dfa', '', '', '(GUEST-Opera IG_611565720013)', '', '', 18, 1, '', '', '', 1, 1565720097, '', '1565720013', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(105, '979f1906bfa196ecd6ed331927eeb334', '', '', '(GUEST-wertf_471565720198)', '', '', 18, 1, '', '', '', 1, 1565722733, '', '1565720198', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(106, '5eb2136a11ba9ce54f6269cadac5e4bf', '', '', '(GUEST-Bvbb_791565721810)', '', '', 18, 1, '', '', '', 1, 1565721996, '', '1565721810', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(107, '45302f81803b0b3941f6c3e9410f9799', '', '', '(GUEST-Rahul_661567347166)', '', '', 18, 1, '', '', '', 1, 1567347584, '', '1567347166', 0, 0, 1, '001d9331c409250292ba4c5121da6c6b', 0, '0', 0, ''),
(108, '23baf1eb9b042021d3f53ac6e0782f70', '', '', '(GUEST-Shivam_831567347190)', '', '', 18, 1, '', '', '', 1, 1567347570, '', '1567347190', 0, 0, 1, '001d9331c409250292ba4c5121da6c6b', 0, '0', 0, ''),
(109, '27c7d5101d7213d53578e7ca6ce95673', '', '', 'shivam00', 'hjdvtj@gmail.com', 'edcd452094435430d3e81e58e7b4ea6d', 18, 1, '', '', '', 1, 1567348306, '', '1567347661', 0, 0, 1, '001d9331c409250292ba4c5121da6c6b', 1, '0', 0, ''),
(110, 'b66eed018c4bc96b64e5959725f160cd', '', '', 'Rahul', 'ghsjsgeh@gmail.com', '25d55ad283aa400af464c76d713c07ad', 18, 1, '', '', '', 1, 1567347801, '', '1567347776', 0, 0, 1, '001d9331c409250292ba4c5121da6c6b', 1, '0', 0, ''),
(111, 'b5879df185f2679450d092c6fa79dbac', '', '', '(GUEST-HYDRA0505_191569680739)', '', '', 18, 1, '', '', '', 1, 1569680987, '', '1569680739', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(112, '7b30ad92a011e6603e92e6ffe72ea4e6', '', '', '(GUEST-dark_knight_591570902739)', '', '', 18, 1, '', '', '', 1, 1570912705, '', '1570902739', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 0, '0', 0, ''),
(113, '4b3aba06d80b0b827cc200bff31ee8d8', '', '', '(GUEST-Sonu_841571073088)', '', '', 18, 1, '', '', '', 1, 1571073387, '', '1571073088', 0, 0, 1, 'b9f8812a6522628ed2956e4c6ad25ea0', 0, '0', 0, ''),
(114, 'ec1e48d394ebd65dd58d126ef3de1287', '', '', 'larry', 'larry@gm.com', 'e8e525f494cff33f5b8c36bd37e346ee', 18, 1, '', '', '', 1, 1571279290, '', '1571275528', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 1, '0', 0, ''),
(115, '3b6f188a9d1a9396715734aa36cc5430', '', '', '(GUEST-rtgh_161575750600)', '', '', 18, 1, '', '', '', 1, 1575755014, '', '1575750600', 0, 0, 1, '249c9139eecb2d04a5b434107f83056d', 0, '0', 0, ''),
(116, 'b107a1fd11c05c9925d6588e42ddb9ce', '', '', '(GUEST-gvhb_181584102612)', '', '', 18, 1, '', '', '', 1, 1584104893, '', '1584102612', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 0, '0', 0, ''),
(117, '50967b97837cbca0d751fc3bb29570b2', '', '', '(GUEST-tyguh_941584121078)', '', '', 18, 1, '', '', '', 1, 1584121081, '', '1584121078', 0, 0, 1, 'b9f8812a6522628ed2956e4c6ad25ea0', 0, '0', 0, ''),
(118, 'f60b97cd3df2de6639533bd508923fe7', '', '', '(GUEST-newuser_751584205209)', '', '', 18, 1, '', '', '', 1, 1584212956, '', '1584205209', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 0, '0', 0, ''),
(119, '760a4804d0bcfc4af5d7fd77d0b6197b', '', '', 'manish3', 'tfyguhi@gma.ck', 'e8e525f494cff33f5b8c36bd37e346ee', 18, 1, '', '', '', 1, 1584213041, '', '1584213040', 0, 0, 1, '', 1, '0', 0, ''),
(120, 'e65b116d30dde7d20e45bb9d95c69bf3', '', '', '(GUEST-manish4_611584213060)', '', '', 18, 1, '', '', '', 1, 1584219724, '', '1584213060', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 0, '0', 0, ''),
(121, '3b6790d92edb0ca37116bdfae7fef910', '', '', '(GUEST-rfgthyj_391584213620)', '', '', 18, 1, '', '', '', 1, 1584213697, '', '1584213620', 0, 0, 1, '', 0, '0', 0, ''),
(122, '0bb44cdd299bb72b0713599083b34e44', '', '', '(GUEST-trg_671584217404)', '', '', 18, 1, '', '', '', 1, 1584218299, '', '1584217404', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 0, '0', 0, ''),
(123, 'a0f913565a575e11480aa6fad91c2178', '', '', '(GUEST-ewfw_651584265673)', '', '', 18, 1, '', '', '', 1, 1584297661, '', '1584265673', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 0, '0', 0, ''),
(124, 'b4df90ca4b686231e0f4ffb3630fa12a', '', '', '(GUEST-manish4_751584354580)', '', '', 18, 1, '', '', '', 1, 1584361975, '', '1584354580', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 0, '', 0, ''),
(125, '4410e1a1bc49af5df4b4340c0c478f09', '', '', '(GUEST-fytff_481584364685)', '', '', 18, 1, '', '', '', 1, 1584381365, '', '1584364685', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 0, '', 0, ''),
(126, '6e58f64ee69bff1005c04069044409b7', '', '', '(GUEST-tfygjhk_601584366168)', '', '', 18, 1, '', '', '', 1, 1584387065, '', '1584366168', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 0, '', 0, ''),
(127, '54a19881645a9da6ab160dfaf62afe80', '', '', '(GUEST-jhbhbhbhbb_581588242220)', '', '', 18, 1, '', '', '', 1, 1588242220, '', '1588242220', 0, 0, 1, '', 0, '', 0, ''),
(128, '30f4edde26844a9162858a1625baa825', '', '', 'ewewew', 'ewewew@4f.corn', 'a418e4306721da3afaa832c511fba6ed', 18, 1, '', '', '', 1, 1588244186, '', '1588244132', 0, 0, 1, '', 1, '', 0, ''),
(129, 'b536dad22f7b3ba21089be8231776a9d', '', '', '(GUEST-vhggg_311588339983)', '', '', 18, 1, '', '', '', 1, 1588339983, '', '1588339983', 0, 0, 1, '', 0, '', 0, ''),
(130, '0f756ac49062b1ff4890b043c794689c', '', '', '(GUEST-wrewrwer_161588339996)', '', '', 18, 1, '', '', '', 1, 1588339996, '', '1588339996', 0, 0, 1, '', 0, '', 0, ''),
(131, '1ca9cdc7daf116a37ffa1cff25c93d23', '', '', 'guygg', 'ugiugi@uhuih.yfu', '47fb954a047cc2072937daf20577b6e2', 18, 1, '', '', '', 1, 1588340566, '', '1588340566', 0, 0, 1, '', 1, '', 0, ''),
(132, '2793684468e461de5d2b3509ceeedec8', '', '', 'jgugi', 'khkhiuh@ygugu.jygu', 'be7d6ea830da47089f0ad883bfa39a25', 18, 1, '', '', '', 1, 1588340588, '', '1588340587', 0, 0, 1, '', 1, '', 0, ''),
(133, '3d547252ccfcb8c6d4247808763bed3b', '', '', '(GUEST-t35t34w_651588515892)', '', '', 18, 1, '', '', '', 1, 1588515944, '', '1588515892', 0, 0, 1, '', 0, '', 0, ''),
(134, '0a4283a37d0c1be1151cdfb6b4e39b0a', '', '', '(GUEST-Hsbbsbab_971588652106)', '', '', 18, 1, '', '', '', 1, 1588652107, '', '1588652106', 0, 0, 1, '', 0, '', 0, ''),
(135, '3061fed71192ce2f29ee91ee832eba3e', 'dfeAA1rS0yPVacS9QYeQG0:APA91bEOrXGyhdhDor38TS9NMWq--aWW3nUl3G64_joh7HHmWfSm3usXQ1Ief0lACQFaNNVgJ2Pimjp7OFGN_TmlF6XMidvvBWRYMMQrLAGSnoqe-mzCLqMB2nmiuA_DBbYYGwjw22Ku', '', 'manish22', 'dew@frwf.cew', 'e8e525f494cff33f5b8c36bd37e346ee', 18, 1, '', '', '', 1, 1588768933, '', '1588741408', 0, 0, 1, '76f16189c2796c491ed9091a24fdbb4b', 1, '', 0, ''),
(136, 'b7e71265798405edd08a213939ae357f', '', '', '(GUEST-Test_161588956543)', '', '', 18, 1, '', '', '', 1, 1588956556, '', '1588956543', 0, 0, 1, '', 0, '', 0, ''),
(137, '3bde33ccc11f7b475889852bfdd32578', '', '', '(GUEST-ewewe_491588958369)', '', '', 18, 1, '', '', '', 1, 1588958370, '', '1588958369', 0, 0, 1, '', 0, '', 0, ''),
(138, '4e007ddfd017dc5f1ae96277eafd65e8', '', '', '(GUEST-test_941588994829)', '', '', 18, 1, '', '', '', 1, 1588994829, '', '1588994829', 0, 0, 1, '', 0, '', 0, ''),
(139, 'bdb78ea1c52ca0ec047c6d50b00e2899', '', '', '(GUEST-test2_681588995404)', '', '', 18, 1, '', '', '', 1, 1588995735, '', '1588995404', 0, 0, 1, '', 0, '', 0, ''),
(140, '09c0dbcb5d90c950f19be86647665cc8', '', '', '(GUEST-test_441588995763)', '', '', 18, 1, '', '', '', 1, 1588996004, '', '1588995763', 0, 0, 1, '', 0, '', 0, ''),
(141, '3e729754359d1e84612a1fa8b6ca1fd9', '', '', '(GUEST-test4_891588996024)', '', '', 18, 1, '', '', '', 1, 1588997315, '', '1588996024', 0, 0, 1, '', 0, '', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `block_list`
--
ALTER TABLE `block_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_chats`
--
ALTER TABLE `personal_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_chat`
--
ALTER TABLE `room_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `block_list`
--
ALTER TABLE `block_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_chats`
--
ALTER TABLE `personal_chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `room_chat`
--
ALTER TABLE `room_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
