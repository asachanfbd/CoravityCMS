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
  
  /*PHP file inclusion contains table name with structures*/
  require_once('mysql.php');

  $profiler=new profiler(FALSE);
  if(file_exists($REF."/config/dbconfig.php")){
      $conf=getdbconfig();
  }else{
      header("Location: install.php");
      exit();
  }
  
 
  $host=$conf['hostname']; /*host name*/
  $uname=$conf['username']; /*user name*/
  $pass=$conf['password']; /*password*/
  $dbname=$conf['database']; /*database name*/  
  

  $db=new db($dbname, $host, $uname, $pass);/*initialization in case of server is not on localhost*/
  
  /*Object Instantiation for classes*/
  $error=new error();
  $user=new user();
  //$newsupdates=new newsupdates();
  set_error_handler(array($error, 'report'));
  $contentpages=new pages();
  $stats=new stats();
  $view=new view();
?>