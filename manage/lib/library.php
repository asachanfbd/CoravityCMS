<?php
  /**
  * file name:      library.php
  * date:           14-09-2012
  * company:        Coravity Infotech
  * developer:      Sudhanshu Mishra
  * description:    This is php page where all the important classes of the project are included and corresponding object instantiation process takes place.
  */
  
  date_default_timezone_set('Asia/Calcutta');
  
  /*PHP class inclusions*/  
  //require_once("newsupdates.php");
  require_once('profiler.php');
  require_once('stats.php');
  require_once('db.php');
  require_once('error.php');
  require_once('pages.php');
  require_once('view.php');
  require_once('commonfunctions.php');
  require_once("user.php");
  require_once("dashboard.php");
  require_once("enquiry.php");
  
  /*PHP file inclusion contains table name with structures*/
  require_once('mysql.php');
  $requireinstallations = false;
  $profiler=new profiler(FALSE);

  $host=''; /*host name*/
  $uname=''; /*user name*/
  $pass=''; /*password*/
  $dbname=''; /*database name*/  
  
  if((stristr($_SERVER['HTTP_HOST'], 'localhost'))){
      /*in case the database is located on the localhost*/
      $dbname='demogit1';
      $db=new db($dbname);
  }
  else{
      $db=new db($dbname, $host, $uname, $pass);/*initialization in case of server is not on localhost*/
  }
  
  /**
  * Checking for installation status. If database got connected it means installation is already done.
  */
  error_reporting(E_ERROR | E_PARSE);
  if(!$db->dbconnect()){
      $requireinstallations = true;
  }else{
      $stats=new stats();
  }
  error_reporting(E_ALL);
  
  /*Object Instantiation for classes*/
  $error=new error();
  set_error_handler(array($error, 'report'));
  $user=new user();
  $contentpages=new pages();
  $view=new view();
?>