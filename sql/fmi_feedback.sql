/*
SQLyog Community v9.20 
MySQL - 5.5.13-log : Database - fmi-feedback
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`fmi-feedback` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `fmi-feedback`;

/*Table structure for table `courses` */

CREATE TABLE `courses` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=400 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `feedback` */

CREATE TABLE `feedback` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `positive_text` text COLLATE utf8_unicode_ci NOT NULL,
  `negative_text` text COLLATE utf8_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  KEY `FK_feedback` (`student_id`),
  CONSTRAINT `FK_feedback` FOREIGN KEY (`student_id`) REFERENCES `students` (`uid`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `question_to_feedback` */

CREATE TABLE `question_to_feedback` (
  `feedback_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  UNIQUE KEY `question_feedback` (`feedback_id`,`question_id`),
  KEY `FK_question_to_feedback` (`question_id`),
  CONSTRAINT `FK_to_feedback` FOREIGN KEY (`feedback_id`) REFERENCES `feedback` (`uid`) ON DELETE CASCADE,
  CONSTRAINT `FK_question_to_feedback` FOREIGN KEY (`question_id`) REFERENCES `questions` (`uid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `questions` */

CREATE TABLE `questions` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `students` */

CREATE TABLE `students` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `student_unique` (`name`,`subject_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `subject_to_course` */

CREATE TABLE `subject_to_course` (
  `subject_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  UNIQUE KEY `subject_course` (`subject_id`,`course_id`),
  KEY `FK_to_course` (`course_id`),
  CONSTRAINT `FK_to_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`uid`) ON DELETE CASCADE,
  CONSTRAINT `FK_to_subject` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`uid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `subjects` */

CREATE TABLE `subjects` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `teacher_to_course` */

CREATE TABLE `teacher_to_course` (
  `course_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  UNIQUE KEY `course_teacher` (`course_id`,`teacher_id`),
  KEY `FK_teacher` (`teacher_id`),
  CONSTRAINT `FK_t_to_course` FOREIGN KEY (`course_id`) REFERENCES `courses` (`uid`) ON DELETE CASCADE,
  CONSTRAINT `FK_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`uid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Table structure for table `teachers` */

CREATE TABLE `teachers` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
