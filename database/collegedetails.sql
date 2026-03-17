-- College Management System Database Export
-- Auto-generated basic structure for Docker testing

SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE IF NOT EXISTS `collegedetails` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `collegedetails`;

-- Admin table
CREATE TABLE IF NOT EXISTS `admin` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`Username`, `Password`) VALUES ('admin', 'stc');

-- Student table
CREATE TABLE IF NOT EXISTS `student` (
  `RegNo` varchar(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Department` varchar(50) DEFAULT NULL,
  `Batch` int(4) DEFAULT NULL,
  `Email-id` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Student',
  `sem` int(2) DEFAULT 1,
  PRIMARY KEY (`RegNo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample students
INSERT INTO `student` VALUES 
('N5BIT0001','R.AADHITYA','B.Sc(IT)',2015,'aadhiadhi24@gmail.com','stc','Student',1),
('N5BIT0002','M.ABDUL MUTHALIF','B.Sc(IT)',2015,'abdul@gmail.com','stc','Student',1),
('N5BIT0003','S.AJITHKUMAR','B.Sc(IT)',2015,'ajith@gmail.com','stc','Student',1);

-- Staff table
CREATE TABLE IF NOT EXISTS `addstaff` (
  `SID` varchar(20) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Department` varchar(50) DEFAULT NULL,
  `Designation` varchar(50) DEFAULT NULL,
  `Emailid` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`SID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample staff
INSERT INTO `addstaff` VALUES 
('BSCCS39','Vignesh Ramamoorthy. H','B.Sc (CS)','Assistant Professor','vigneshramamoorthy@stc.ac.in','123456'),
('bscct19','p.shobana','B.Sc(IT)','Assistant Professor','shobana@stc.ac.in','123'),
('BSCIT002','Murugesan','B.Sc(IT)','Professor','murugesan@stc.ac.in','2');

-- Notes table
CREATE TABLE IF NOT EXISTS `notes` (
  `Batch` varchar(12) DEFAULT NULL,
  `Dept` varchar(20) DEFAULT NULL,
  `sem` int(11) DEFAULT NULL,
  `subject` varchar(60) DEFAULT NULL,
  `notes` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample notes
INSERT INTO `notes` VALUES ('2015','B.Sc(IT)',5,'N5BIT5T44-3','upload/BASE LOGIC.ppt');

-- Events table
CREATE TABLE IF NOT EXISTS `events` (
  `EventID` int(11) NOT NULL AUTO_INCREMENT,
  `EventsMsg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`EventID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `events` VALUES (5,'IT EXPO');

-- Complaints table
CREATE TABLE IF NOT EXISTS `complaint` (
  `Complaint_ID` varchar(10) NOT NULL,
  `Type` varchar(50) DEFAULT NULL,
  `Description` text,
  `Status` varchar(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Batch` varchar(12) DEFAULT NULL,
  `RegNo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Complaint_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample complaints
INSERT INTO `complaint` VALUES 
('c1','clean','not clean','Resolved','2018-02-14','2015','N5BIT0001'),
('c2','discipline','prb','resolved','2018-02-14','2015','N5BIT0001');

-- Attendance table
CREATE TABLE IF NOT EXISTS `2015attendance` (
  `Batch` int(4) DEFAULT NULL,
  `sem` int(2) DEFAULT NULL,
  `RegNo` varchar(20) DEFAULT NULL,
  `tot_working_days` int(3) DEFAULT 0,
  `no_day_present` int(3) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample attendance
INSERT INTO `2015attendance` VALUES 
(2015,1,'N5BIT0001',100,85),
(2015,1,'N5BIT0002',100,90),
(2015,1,'N5BIT0003',100,78);

-- Marks tables
CREATE TABLE IF NOT EXISTS `cycletest_1` (
  `Batch` int(4) DEFAULT NULL,
  `sem` int(2) DEFAULT NULL,
  `RegNo` varchar(20) DEFAULT NULL,
  `Mark` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `cycletest_2` (
  `Batch` int(4) DEFAULT NULL,
  `sem` int(2) DEFAULT NULL,
  `RegNo` varchar(20) DEFAULT NULL,
  `Mark` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `modelexam` (
  `Batch` int(4) DEFAULT NULL,
  `sem` int(2) DEFAULT NULL,
  `RegNo` varchar(20) DEFAULT NULL,
  `Mark` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample marks
INSERT INTO `cycletest_1` VALUES (2015,1,'N5BIT0001','22'),(2015,1,'N5BIT0002','20'),(2015,1,'N5BIT0003','18');
INSERT INTO `cycletest_2` VALUES (2015,1,'N5BIT0001','23'),(2015,1,'N5BIT0002','21'),(2015,1,'N5BIT0003','19');
INSERT INTO `modelexam` VALUES (2015,1,'N5BIT0001','45'),(2015,1,'N5BIT0002','42'),(2015,1,'N5BIT0003','38');

-- Work diary table
CREATE TABLE IF NOT EXISTS `workdiarys` (
  `SID` varchar(20) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Period` varchar(10) DEFAULT NULL,
  `Class` varchar(20) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Topic` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Staff allocation table
CREATE TABLE IF NOT EXISTS `staffallocation` (
  `SID` varchar(20) DEFAULT NULL,
  `Batch` varchar(12) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `sem` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Staff detail table
CREATE TABLE IF NOT EXISTS `staffdetail` (
  `SID` varchar(20) DEFAULT NULL,
  `Qualification` varchar(200) DEFAULT NULL,
  `Domain` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS=1;
