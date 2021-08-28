
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*{shu}{ju}{biao} `prefix_admin` {de}{jie}{gou}*/

DROP TABLE IF EXISTS `prefix_admin`;

CREATE TABLE `prefix_admin` (
  `in_adminid` int(11) NOT NULL AUTO_INCREMENT,
  `in_adminname` varchar(255) NOT NULL,
  `in_adminpassword` varchar(255) NOT NULL,
  `in_loginip` varchar(255) DEFAULT NULL,
  `in_loginnum` int(11) NOT NULL,
  `in_logintime` datetime DEFAULT NULL,
  `in_islock` int(11) NOT NULL,
  `in_permission` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`in_adminid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET={charset};

/*{shu}{ju}{biao} `prefix_user` {de}{jie}{gou}*/

DROP TABLE IF EXISTS `prefix_user`;

CREATE TABLE `prefix_user` (
  `in_userid` int(11) NOT NULL AUTO_INCREMENT,
  `in_username` varchar(255) NOT NULL,
  `in_userpassword` varchar(255) NOT NULL,
  `in_mobile` varchar(255) DEFAULT NULL,
  `in_qq` varchar(255) DEFAULT NULL,
  `in_firm` varchar(255) DEFAULT NULL,
  `in_job` varchar(255) DEFAULT NULL,
  `in_regdate` datetime DEFAULT NULL,
  `in_loginip` varchar(255) DEFAULT NULL,
  `in_logintime` datetime DEFAULT NULL,
  `in_islock` int(11) NOT NULL,
  `in_points` int(11) NOT NULL,
  PRIMARY KEY (`in_userid`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET={charset};

/*{shu}{ju}{biao} `prefix_app` {de}{jie}{gou}*/

DROP TABLE IF EXISTS `prefix_app`;

CREATE TABLE `prefix_app` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_name` varchar(255) NOT NULL,
  `in_bid` varchar(255) DEFAULT NULL,
  `in_mnvs` varchar(255) DEFAULT NULL,
  `in_bsvs` varchar(255) DEFAULT NULL,
  `in_bvs` varchar(255) DEFAULT NULL,
  `in_type` int(11) NOT NULL,
  `in_nick` varchar(255) DEFAULT NULL,
  `in_team` varchar(255) DEFAULT NULL,
  `in_form` varchar(255) DEFAULT NULL,
  `in_icon` varchar(255) DEFAULT NULL,
  `in_plist` varchar(255) NOT NULL,
  `in_hits` int(11) NOT NULL,
  `in_size` varchar(255) DEFAULT NULL,
  `in_kid` int(11) NOT NULL,
  `in_sign` int(11) NOT NULL,
  `in_resign` int(11) NOT NULL,
  `in_link` varchar(255) DEFAULT NULL,
  `in_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET={charset};

/*{shu}{ju}{biao} `prefix_key` {de}{jie}{gou}*/

DROP TABLE IF EXISTS `prefix_key`;

CREATE TABLE `prefix_key` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_tid` int(11) NOT NULL,
  `in_code` varchar(255) NOT NULL,
  `in_state` int(11) NOT NULL,
  `in_time` int(11) NOT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET={charset};

/*{shu}{ju}{biao} `prefix_buylog` {de}{jie}{gou}*/

DROP TABLE IF EXISTS `prefix_buylog`;

CREATE TABLE `prefix_buylog` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_title` varchar(255) NOT NULL,
  `in_tid` int(11) NOT NULL,
  `in_money` int(11) NOT NULL,
  `in_lock` int(11) NOT NULL,
  `in_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET={charset};

/*{shu}{ju}{biao} `prefix_paylog` {de}{jie}{gou}*/

DROP TABLE IF EXISTS `prefix_paylog`;

CREATE TABLE `prefix_paylog` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_title` varchar(255) NOT NULL,
  `in_points` int(11) NOT NULL,
  `in_money` int(11) NOT NULL,
  `in_lock` int(11) NOT NULL,
  `in_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET={charset};

/*{shu}{ju}{biao} `prefix_signlog` {de}{jie}{gou}*/

DROP TABLE IF EXISTS `prefix_signlog`;

CREATE TABLE `prefix_signlog` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_aid` int(11) NOT NULL,
  `in_aname` varchar(255) NOT NULL,
  `in_uid` int(11) NOT NULL,
  `in_uname` varchar(255) NOT NULL,
  `in_status` int(11) NOT NULL,
  `in_step` varchar(255) NOT NULL,
  `in_percent` int(11) NOT NULL,
  `in_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET={charset};

/*{shu}{ju}{biao} `prefix_mail` {de}{jie}{gou}*/

DROP TABLE IF EXISTS `prefix_mail`;

CREATE TABLE `prefix_mail` (
  `in_id` int(11) NOT NULL AUTO_INCREMENT,
  `in_uid` int(11) NOT NULL,
  `in_ucode` varchar(255) NOT NULL,
  `in_addtime` datetime DEFAULT NULL,
  PRIMARY KEY (`in_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET={charset};
