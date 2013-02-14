<?php
    $array_of_tables=array(
        'errorlog'=>'
         CREATE TABLE IF NOT EXISTS `errorlog` (
         `ERRORID` varchar(35) NOT NULL,
         `ERRORNO` varchar(30) NOT NULL,
         `ERRORFILE` varchar(500) NOT NULL,
         `ERRORLINE` int(11) NOT NULL,
         `ERRORMSG` text NOT NULL,
         `ERRORVARS` longtext NOT NULL,
         `added` int(15) NOT NULL,
        `modified` int(15) NOT NULL,
         PRIMARY KEY (`ERRORID`)
         )',
         'raw_stats'=>'
         CREATE TABLE IF NOT EXISTS `raw_stats` (
              `BROWSER_ID` varchar(32) NOT NULL,
              `HTTP_USER_AGENT` varchar(60) NOT NULL,
              `REMOTE_ADDRESS` varchar(60) NOT NULL,
              `HTTP_REFERER` varchar(60) NOT NULL,
              `added` int(15) NOT NULL,
              `modified` int(15) NOT NULL,
              PRIMARY KEY (`BROWSER_ID`)
         )',
         'refined_stats'=>'
         CREATE TABLE IF NOT EXISTS `refined_stats` (
              `ID` varchar(32) NOT NULL,
              `HTTP_USER_AGENT` varchar(60) NOT NULL,
              `agent_type` varchar(30) NOT NULL,
              `agent_name` varchar(30) NOT NULL,
              `agent_version` varchar(30) NOT NULL,
              `os_name` varchar(30) NOT NULL,
              `browser_refined` tinyint(1) NOT NULL,
              `added` int(15) NOT NULL,
              `modified` int(15) NOT NULL,
              PRIMARY KEY (`ID`)
         )',
         'ip2location'=>'
         CREATE TABLE IF NOT EXISTS `ip2location` (
              `BROWSER_ID` varchar(32) NOT NULL,
              `cityName` varchar(30) NOT NULL,
              `regionName` varchar(30) NOT NULL,
              `countryName` varchar(30) NOT NULL,
              `countryCode` varchar(30) NOT NULL,
              `zipCode` varchar(30) NOT NULL,
              `latitude` varchar(30) NOT NULL,
              `longitude` varchar(30) NOT NULL,
              `timeZone` varchar(30) NOT NULL,
              `added` int(15) NOT NULL,
              `modified` int(15) NOT NULL,
              PRIMARY KEY (`BROWSER_ID`)
         )',
         'visitordb'=>'
         CREATE TABLE IF NOT EXISTS `visitordb`(
            `BROWSER_ID` varchar(32) NOT NULL,
            `Visitor_ID` varchar(32) NOT NULL,
            `Visited_URL` varchar(100) NOT NULL,
            `added` int(15) NOT NULL,
            `modified` int(15) NOT NULL,
            PRIMARY KEY (`Visitor_ID`)
         )',
         'pages'=>'
         CREATE TABLE IF NOT EXISTS `pages` (
         `id` varchar(32) NOT NULL,
        `type` varchar(200) NOT NULL DEFAULT \'mainnavigation\',
        `name` varchar(50) NOT NULL,
        `title` text NOT NULL,
        `content` longtext NOT NULL,
        `headerimg` varchar(200) NOT NULL DEFAULT \'images/defaultsmallslide.jpg\',
        `editedby` text NOT NULL,
        `seotags` mediumtext NOT NULL,
        `added` int(15) NOT NULL,
        `modified` int(15) NOT NULL,
        PRIMARY KEY (`id`)
        )'
    );

 ?>