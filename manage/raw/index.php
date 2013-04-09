<?php
  require_once("lib/library.php");
  if(!file_exists("config/dbconfig.php")){
        header("Location: install.php");
        exit();
  }
  if(isset($_GET['logout']) && isset($_COOKIE['ls'])){
      $user->logout($_COOKIE['ls']);
      header("Location: index.php");
  }
  //$profiler->start(false); //passing true will start the profiler logging.
  $data = array();
  $page = '';
  $profiler->add('Checking login.');
  if($user->iflogin()){
      $subnav = '';
      if(isset($_GET['subpage']) && $_GET['subpage'] != ""){
          $subpage = $_GET['subpage'];
      }else{
          $subpage = 'dashboard';
      }
        $nav = array(
             'dashboard'         =>      'Dashboard',
             'enquiry'           =>      'Enquiries',
             'pages'             =>      'Pages',
             'profiles'          =>      'Profile',
             'usermanagment'     =>      'Management',
             'error_explorer'    =>      'Error Explorer'
          );
      
      if($subpage == 'profiles'){
          $data['pagetitle'] = 'Account Settings';
      }else{
          $data['pagetitle'] = $nav[$subpage];
      }
      $data['mainnavigation'] = $view->getsubnav($nav, 'subnav', 'homepage', $subpage);
      $data['loginbar'] = $view->getloginbar();
      $profiler->add('Now including and executing includes.php');
      require_once('includes.php');
      $data['mainbody'] = $body;
      $profiler->add('Completed executing includes.php');
      $data['footer'] = '
      <div>
      Copyright &copy; 2012 Coravity Infotech.
      Powered by 
      <a href="http://www.coravity.com/" target="_blank">Coravity Infotech</a>
      </div>
      <!--<ul>
        <li>For Support Call <b>+91-9711758503</b>&nbsp;&nbsp;&nbsp;</li>
        <li><a href="http://www.coravity.com/?page=contact" target="_blank">Contact Us</a></li>
        <li><a href="http://www.coravity.com/?page=privacypolicy" target="_blank">Privacy Policy</a></li>
        <li><a href="http://www.coravity.com/?page=termsofuse" target="_blank">Terms of Use</a></li>
      </ul>-->
        ';
      echo $view->htmlframe($data, $page);
      
  }
  else{
      require_once('login.php');
  }
  
  $profiler->add('Loaded Html completely.');
  echo $profiler->display();
  
?>