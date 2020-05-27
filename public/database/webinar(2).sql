-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 26, 2020 at 01:23 PM
-- Server version: 5.7.26
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webinar`
--

-- --------------------------------------------------------

--
-- Table structure for table `oc_auditray`
--

DROP TABLE IF EXISTS `oc_auditray`;
CREATE TABLE IF NOT EXISTS `oc_auditray` (
  `oca` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `oca_user_type` varchar(255) NOT NULL,
  `oca_user_id` varchar(255) NOT NULL,
  `oca_login` varchar(255) NOT NULL,
  `oca_action` varchar(255) NOT NULL,
  `oca_action_describe` varchar(255) NOT NULL,
  `oca_action_date` varchar(255) NOT NULL,
  `oca_action_time` varchar(255) NOT NULL,
  `oca_ip` varchar(255) NOT NULL,
  `oca_location` varchar(255) NOT NULL,
  `oca_broswer` varchar(255) NOT NULL,
  PRIMARY KEY (`oca`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oc_log`
--

DROP TABLE IF EXISTS `oc_log`;
CREATE TABLE IF NOT EXISTS `oc_log` (
  `ocl` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ocl_id` varchar(50) NOT NULL,
  `ocl_detail` varchar(50) NOT NULL,
  `ocl_date` varchar(50) NOT NULL,
  `ocl_by` varchar(50) NOT NULL,
  PRIMARY KEY (`ocl`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oc_profile`
--

DROP TABLE IF EXISTS `oc_profile`;
CREATE TABLE IF NOT EXISTS `oc_profile` (
  `cp` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cp_dpname` varchar(255) NOT NULL,
  `cp_ptitle` varchar(255) NOT NULL,
  `cp_ftitle` varchar(255) NOT NULL,
  `cp_tel` varchar(255) NOT NULL,
  `cp_phone` varchar(255) NOT NULL,
  `cp_addres` varchar(255) NOT NULL,
  `cp_email` varchar(255) NOT NULL,
  `cp_slogan` longtext NOT NULL,
  `cp_fb` varchar(100) NOT NULL,
  `cp_tw` varchar(100) NOT NULL,
  `cp_ig` varchar(100) NOT NULL,
  `cp_logo` varchar(100) NOT NULL,
  PRIMARY KEY (`cp`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oc_profile`
--

INSERT INTO `oc_profile` (`cp`, `cp_dpname`, `cp_ptitle`, `cp_ftitle`, `cp_tel`, `cp_phone`, `cp_addres`, `cp_email`, `cp_slogan`, `cp_fb`, `cp_tw`, `cp_ig`, `cp_logo`) VALUES
(1, 'LawPavilion', 'LawPavilion Webinar Portal', 'LawPavilion', '+234(1)-453-3620', '+234-805-029-8729', '20, Felicia Koleosho Street,\r\nOff Agbaoku Street, Allen Avenue,\r\nIkeja, Lagos. NG - 100216', 'webinar@lawpavilion.com', 'LawPavilion Business Solutions (formerly Grace InfoTech Limited) is a leading legal IT Research Tools provider whose existence serves to help Lawyers, Judges and Law firms make the most of their legal practice through the provision of cutting edge IT Solutions for the Legal Industry. ', 'lawpavilion', 'lawpavilion', 'lawpavilion', '119366899.png');

-- --------------------------------------------------------

--
-- Table structure for table `oc_speaer`
--

DROP TABLE IF EXISTS `oc_speaer`;
CREATE TABLE IF NOT EXISTS `oc_speaer` (
  `ocs` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ocs_id` varchar(100) NOT NULL,
  `ocs_fullname` varchar(255) NOT NULL,
  `ocs_email` varchar(255) NOT NULL,
  `ocs_telephone` varchar(255) NOT NULL,
  `ocs_category` varchar(255) NOT NULL,
  `ocs_profile` longtext NOT NULL,
  `ocs_image` varchar(255) NOT NULL,
  `ocs_status` varchar(100) NOT NULL,
  PRIMARY KEY (`ocs`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oc_speaer`
--

INSERT INTO `oc_speaer` (`ocs`, `ocs_id`, `ocs_fullname`, `ocs_email`, `ocs_telephone`, `ocs_category`, `ocs_profile`, `ocs_image`, `ocs_status`) VALUES
(1, 'SP202013058', 'Akinbode Oluwadamilare ', 'jokikiola@gmail.com', '2349074352314', '2005134', '<p>Akinbode Oluwadamilare is a PHP Software Developer with 11 year IT experience. Oluwadamilare has passion to add value to businesses and lives with his software solution. Damilare is in his late 20\'s.Â  He is the CEO of Innovative Concept Solution, a company he floated in 2013 and has built affiliation with several organizations within and outside of the country as Lead Developer, Head Technical Services and Consultant on Several Projects.Â  <br>Â <br>Damilare is Professional Software Developer, Database Administrator, and Project Manager in wide range of Web Based Application, Custom Made Solution and with core strength as a Solution Architect.Â  <br>Â <br>11 years Web Veteran, Damilare brings to his team qualitative experience in Web Application Development and project management.Â  <br>Â <br>Damilare worked as Head of Technical Service and Chief Technical Officer with top IT organizations such as Promobile GH-Ghana, Comcity Technologies- Nigeria, Innovative Consynergy Solutions Limited - Nigeria. Also, delivered custom solution to organizations like NAFDAC, Seguro Housing Corporative Limited, Cradlepal Kiddies Limited, Flux Logistix, Nigeria & Uganda.Â  <br>Â <br>My specialties Include: PHP, Python, JavaScript, Java, HTML, CSS, XML, SQL Server, Jquery, Ajax.Â  To mention but few of our client below.Â Â </p><ol><li> National Agency Food and Drug Administration (NAFDAC)Â  </li><li>Seguro Housing Cooperative, NigeriaÂ  </li><li>MackIV Consult & Examplanet, NigeriaÂ </li><li> Blanche Dental Clinic, Nigeria </li><li>Octragon Multi-project Limited, NigeriaÂ  </li><li>Tafric-Invest Nigeria Limited</li><li> Fodal Coop Multipurpose Society Limited </li><li>Promobile GH, Ghana, </li><li>Talents Community, Ghana</li><li>African Initiative Academy, Ghana</li><li>Registrar General Department (RDG), Ghana,Â  </li><li>Allied Markets and Festival Limited </li><li>Flux logistix Nigeria Limited <br></li></ol>', '92912792.jpg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `oc_webinar`
--

DROP TABLE IF EXISTS `oc_webinar`;
CREATE TABLE IF NOT EXISTS `oc_webinar` (
  `ocw` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ocw_id` varchar(255) NOT NULL,
  `ocw_title` varchar(255) NOT NULL,
  `ocw_category` varchar(100) NOT NULL,
  `ocw_date` varchar(100) NOT NULL,
  `ocw_time` varchar(100) NOT NULL,
  `ocw_register` varchar(100) NOT NULL,
  `ocw_link` varchar(255) NOT NULL,
  `ocw_speaker` varchar(255) NOT NULL,
  `ocw_brief` longtext NOT NULL,
  `ocw_rdate` varchar(255) NOT NULL,
  `ocw_status` varchar(255) NOT NULL,
  `ocw_image` varchar(255) NOT NULL,
  PRIMARY KEY (`ocw`),
  UNIQUE KEY `ocw_id` (`ocw_id`),
  KEY `ocw_title` (`ocw_title`),
  KEY `ocw_category` (`ocw_category`),
  KEY `ocw_date` (`ocw_date`),
  KEY `ocw_register` (`ocw_register`),
  KEY `ocw_speaker` (`ocw_speaker`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `oc_webinar_speakers`
--

DROP TABLE IF EXISTS `oc_webinar_speakers`;
CREATE TABLE IF NOT EXISTS `oc_webinar_speakers` (
  `ows` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ows_webinar` varchar(100) NOT NULL,
  `ows_speaker` varchar(255) NOT NULL,
  PRIMARY KEY (`ows`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wb_admin`
--

DROP TABLE IF EXISTS `wb_admin`;
CREATE TABLE IF NOT EXISTS `wb_admin` (
  `wa` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wa_name` varchar(100) NOT NULL,
  `wa_email` varchar(100) NOT NULL,
  `wa_tel` varchar(20) NOT NULL,
  `wa_psd` varchar(255) NOT NULL,
  `wa_status` varchar(100) NOT NULL,
  `wa_session` varchar(255) NOT NULL,
  PRIMARY KEY (`wa`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wb_admin`
--

INSERT INTO `wb_admin` (`wa`, `wa_name`, `wa_email`, `wa_tel`, `wa_psd`, `wa_status`, `wa_session`) VALUES
(1, 'Damilare', 'jokikiola@yahoo.com', '09074352314', 'd7fc563cce3e0d8d1d2e8d65977497bade5d24455b9b7c621b74084933c31bc0', 'Active', 'fd3r7hif27h7plkmh45brnje2l'),
(2, 'Uzoma Akinbode', 'jokikiola@gmail.com', '2348052719950', 'd7fc563cce3e0d8d1d2e8d65977497bade5d24455b9b7c621b74084933c31bc0', 'Active', 'pfr7dgilanamnqcku5v0tpck4v');

-- --------------------------------------------------------

--
-- Table structure for table `wb_category`
--

DROP TABLE IF EXISTS `wb_category`;
CREATE TABLE IF NOT EXISTS `wb_category` (
  `wc` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wc_id` int(11) NOT NULL,
  `wc_category` varchar(255) NOT NULL,
  `wc_status` varchar(10) NOT NULL,
  PRIMARY KEY (`wc`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wb_category`
--

INSERT INTO `wb_category` (`wc`, `wc_id`, `wc_category`, `wc_status`) VALUES
(1, 2005133, 'Technologies', 'Active'),
(2, 2005134, 'Science', 'Active'),
(3, 20051414, 'Digital Marketing', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `wb_contact_us`
--

DROP TABLE IF EXISTS `wb_contact_us`;
CREATE TABLE IF NOT EXISTS `wb_contact_us` (
  `wcu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wcu_name` varchar(100) NOT NULL,
  `wcu_email` varchar(100) NOT NULL,
  `wcu_tel` varchar(100) NOT NULL,
  `wcu_message` longtext NOT NULL,
  `wcu_date` varchar(100) NOT NULL,
  `wcu_ip` varchar(100) NOT NULL,
  `wcu_location` varchar(100) NOT NULL,
  PRIMARY KEY (`wcu`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wb_contact_us`
--

INSERT INTO `wb_contact_us` (`wcu`, `wcu_name`, `wcu_email`, `wcu_tel`, `wcu_message`, `wcu_date`, `wcu_ip`, `wcu_location`) VALUES
(1, 'Akinbode Oluwadamilare', 'jokikiola@yahoo.com', '2349074352313', 'Lagos Nigeria ', '2020-05-15', '::1', 'Unknown'),
(2, 'Akinbode Oluwadamilare', 'jokikiola@yahoo.com', '2349074352313', 'Lagos Nigeria ', '2020-05-15', '::1', 'Unknown');

-- --------------------------------------------------------

--
-- Table structure for table `wb_webinar_register`
--

DROP TABLE IF EXISTS `wb_webinar_register`;
CREATE TABLE IF NOT EXISTS `wb_webinar_register` (
  `wwr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wwr_webinar` varchar(100) NOT NULL,
  `wwr_lname` varchar(100) NOT NULL,
  `wwr_fname` varchar(100) NOT NULL,
  `wwr_email` varchar(100) NOT NULL,
  `wwr_telephone` varchar(100) NOT NULL,
  `wwr_date` varchar(100) NOT NULL,
  `wwr_ip` varchar(100) NOT NULL,
  `wwr_location` varchar(100) NOT NULL,
  PRIMARY KEY (`wwr`),
  KEY `wwr_webinar` (`wwr_webinar`),
  KEY `wwr_lname` (`wwr_lname`),
  KEY `wwr_fname` (`wwr_fname`),
  KEY `wwr_telephone` (`wwr_telephone`),
  KEY `wwr_email` (`wwr_email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wb_web_count`
--

DROP TABLE IF EXISTS `wb_web_count`;
CREATE TABLE IF NOT EXISTS `wb_web_count` (
  `wwc` int(11) NOT NULL AUTO_INCREMENT,
  `wwc_session` varchar(255) NOT NULL,
  `wwc_date` varchar(255) NOT NULL,
  `wwc_browser` varchar(255) NOT NULL,
  `wwc_ip` varchar(255) NOT NULL,
  `wwc_location` varchar(255) NOT NULL,
  PRIMARY KEY (`wwc`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_webinar_count`
--

DROP TABLE IF EXISTS `web_webinar_count`;
CREATE TABLE IF NOT EXISTS `web_webinar_count` (
  `wwct` int(11) NOT NULL AUTO_INCREMENT,
  `wwct_wid` varchar(255) NOT NULL,
  `wwct_session` varchar(255) NOT NULL,
  `wwct_date` varchar(255) NOT NULL,
  `wwct_browser` varchar(255) NOT NULL,
  `wwct_ip` varchar(255) NOT NULL,
  `wwct_location` varchar(255) NOT NULL,
  PRIMARY KEY (`wwct`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
