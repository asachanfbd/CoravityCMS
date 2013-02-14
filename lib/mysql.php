
<?php
/**
*   File Name: mysql.php
*   Date: 27-08-2012
*   Company: Coravity Infotech
*   Developer: Sudhanshu Mishra
*   Description: This file contains all the tables which we want to create on a particular database 
*/

    $array_of_tables=array(
    'errorlog'=>'
     CREATE TABLE IF NOT EXISTS `errorlog` (
     `error_id` varchar(35) NOT NULL,
     `error_no` varchar(30) NOT NULL,
     `error_file` varchar(500) NOT NULL,
     `error_line` int(11) NOT NULL,
     `error_msg` text NOT NULL,
     `error_vars` longtext NOT NULL,
     `added` int(15) NOT NULL,
    `modified` int(15) NOT NULL,
     PRIMARY KEY (`error_id`)
     )',
 
    'nodes' =>'
    CREATE TABLE IF NOT EXISTS `nodes` (
      `node_id` varchar(32) NOT NULL,
      `parent_id` varchar(32) NOT NULL,
      `priority` double NOT NULL,
      `author` varchar(32) NOT NULL DEFAULT \'default\',
      `added` int(15) NOT NULL DEFAULT 0,
      `modified` int(15) NOT NULL DEFAULT 0,
      PRIMARY KEY (`node_id`),
      FOREIGN KEY (`parent_id`) REFERENCES nodes(`node_id`) ON DELETE CASCADE ON UPDATE CASCADE 
     ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ',
    
    'nodestree' =>'
     CREATE TABLE IF NOT EXISTS `nodestree` (
      `node_id` varchar(32) NOT NULL,
      `parent_id` varchar(32) NOT NULL,
      `level` double NOT NULL,
      `added` int(15) NOT NULL DEFAULT 0,
      `modified` int(15) NOT NULL DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
    ',
     
     'rawstats'=>'
     CREATE TABLE IF NOT EXISTS `rawstats` (
          `browser_id` varchar(32) NOT NULL,
          `http_user_agent` varchar(60) NOT NULL,
          `remote_address` varchar(60) NOT NULL,
          `http_referer` varchar(60) NOT NULL,
          `added` int(15) NOT NULL,
          `modified` int(15) NOT NULL,
          PRIMARY KEY (`browser_id`)
     )',
     
     'refinedstats'=>'
     CREATE TABLE IF NOT EXISTS `refinedstats` (
          `id` varchar(32) NOT NULL,
          `http_user_agent` varchar(60) NOT NULL,
          `agent_type` varchar(30) NOT NULL,
          `agent_name` varchar(30) NOT NULL,
          `agent_version` varchar(30) NOT NULL,
          `os_name` varchar(30) NOT NULL,
          `browser_refined` tinyint(1) NOT NULL,
          `added` int(15) NOT NULL,
          `modified` int(15) NOT NULL,
          PRIMARY KEY (`id`)
     )',
     
     'ip2location'=>'
     CREATE TABLE IF NOT EXISTS `ip2location` (
          `browser_id` varchar(32) NOT NULL,
          `city_name` varchar(30) NOT NULL,
          `region_name` varchar(30) NOT NULL,
          `country_name` varchar(30) NOT NULL,
          `country_code` varchar(30) NOT NULL,
          `zip_code` varchar(30) NOT NULL,
          `latitude` varchar(30) NOT NULL,
          `longitude` varchar(30) NOT NULL,
          `time_zone` varchar(30) NOT NULL,
          `added` int(15) NOT NULL,
          `modified` int(15) NOT NULL,
          PRIMARY KEY (`browser_id`)
     )',
     
     'visitordb'=>'
     CREATE TABLE IF NOT EXISTS `visitordb`(
        `browser_id` varchar(32) NOT NULL,
        `visitor_id` varchar(32) NOT NULL,
        `visited_url` varchar(100) NOT NULL,
        `added` int(15) NOT NULL,
        `modified` int(15) NOT NULL,
        PRIMARY KEY (`visitor_id`)
     )',
     
     'objectdefinition'=>'
      CREATE TABLE IF NOT EXISTS `objectdefinition`(
        `object_id` varchar(32) NOT NULL,
        `object_definition` longtext NOT NULL,
        `author` varchar(32) NOT NULL DEFAULT \'default\',
        `added` int(15) NOT NULL,
        `modified` int(15) NOT NULL,
        PRIMARY KEY (`object_id`)
     )',
     
     'objectdata'=>'
     CREATE TABLE IF NOT EXISTS `objectdata`(
        `id` varchar(32) NOT NULL,
        `object_type` varchar(32) NOT NULL,
        `property` varchar(32) NOT NULL,
        `property_content` longtext NOT NULL,
        `author` varchar(32) NOT NULL DEFAULT \'unknown\',
        `added` int(15) NOT NULL,
        `modified` int(15) NOT NULL,
        PRIMARY KEY (`id`, `property`)
     )'
     
     );

 ?>

    
