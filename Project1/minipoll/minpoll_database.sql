--
-- Table structure for table `poll_check`
--

CREATE TABLE `poll_check` (
  `pollid` int(11) NOT NULL default '0',
  `ip` varchar(20) NOT NULL default '',
  `time` varchar(14) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------
-- Table structure for table `poll_data`
--

CREATE TABLE `poll_data` (
  `pollid` int(11) NOT NULL default '0',
  `polltext` varchar(50) NOT NULL default '',
  `votecount` int(11) NOT NULL default '0',
  `voteid` int(11) NOT NULL default '0',
  `status` varchar(6) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll_data`
--

INSERT INTO `poll_data` VALUES (1, 'Excellent', 0, 1, NULL);
INSERT INTO `poll_data` VALUES (1, 'Satisfactory', 1, 2, NULL);
INSERT INTO `poll_data` VALUES (1, 'Not Bad', 0, 3, NULL);
INSERT INTO `poll_data` VALUES (1, 'What the hell is this!', 0, 4, NULL);
INSERT INTO `poll_data` VALUES (1, '', 0, 5, NULL);
INSERT INTO `poll_data` VALUES (1, '', 0, 6, NULL);
INSERT INTO `poll_data` VALUES (1, '', 0, 7, NULL);
INSERT INTO `poll_data` VALUES (1, '', 0, 8, NULL);
INSERT INTO `poll_data` VALUES (1, '', 0, 9, NULL);
INSERT INTO `poll_data` VALUES (1, '', 0, 10, NULL);

-- --------------------------------------------------------
--
-- Table structure for table `poll_desc`
--

CREATE TABLE `poll_desc` (
  `pollid` int(11) NOT NULL default '0',
  `polltitle` varchar(100) NOT NULL default '',
  `timestamp` datetime NOT NULL default '0000-00-00 00:00:00',
  `votecount` mediumint(9) NOT NULL default '0',
  `STATUS` varchar(6) default NULL,
  PRIMARY KEY  (`pollid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poll_desc`
--

INSERT INTO `poll_desc` VALUES (1, 'How do you rate this site?', '2006-01-05 00:00:50', 0, 'active');