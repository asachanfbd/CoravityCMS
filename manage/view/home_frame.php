<!DOCTYPE html>
<html>
<head>
    <title>[#:@`pagetitle`]</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="styles/home.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.cycle.lite.js"></script>
    <?php //echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>'; ?>
</head>
<body>
    <div id="maincontainer">
        <div id="bodycontainer">
            <section class="right sidebar">
                <div style="padding-left: 20px;">
                <div class="searchbox right">
                    <div id="searchdiv">
                        <form action="" method="get">
                            <input type="text" name="user" />
                            <input type="submit" value="Search" />
                        </form>
                    </div>
                    <ul class="horizontal nav right">
                        <li><a href="?page=contact">Contact Us</a></li>
                        <li><a href="http://srv.chat4support.com/main.asp?sid=24203&sTag=BRAINTOUCH&style=0" target="_blank">LiveCHAT</a></li>
                        <li><a href="login.php">User Login</a></li>
                    </ul>
                </div>
                    <nav>
                        [#:@`mainnavigation`]
                    </nav>
                    
                <div style="margin-top: 50px; float: left;">
                    <h3>Our Mission</h3>
                    <p>"Our mission is to enable dedicated communication channel between parents and Institutions to enhance the overall performance of students."</p>
                    <h3>Our Vision</h3>
                    <p>"We want to see our country's education system highly recognised in the world. Where there is complete transparency in between Parents, Students and Institutions."</p>
                </div>
                </div>
            </section>
            <section class="left mainbar">
                <div>
                    <div class="left" style="margin-top: 20px;">
                        <a href="http://www.braintouchonline.com/">
                            <img src="images/logo-name.png">
                        </a>
                    </div>
                    <ul class="horizontal nav right" style="margin: 70px 0 10px 0;">
                        <li><a href="?page=insights&type=mainnavigation">INSIGHTS</a></li>
                        <li><a href="?page=innovation&type=mainnavigation">INNOVATION</a></li>
                        <li><a href="?page=services&type=mainnavigation">SMART NOW</a></li>
                    </ul>
                    <div id="slideshow" class="left" style="position: relative; width: 100%; height: 341px;">
                        <img src="images/1.png" width="100%" style="position: absolute;">
                        <img src="images/2.png" width="100%" style="position: absolute;">
                        <img src="images/3.png" width="100%" style="position: absolute;">
                    </div>
                    <div class="left">
                        <h3>Key benefits</h3>
                        <ul id="bodylist">
                            <li><a href="?page=services&type=mainnavigation">Track Progress & Results</a></li>
                            <li><a href="?page=services&type=mainnavigation">Instant Notification of Results</a></li>
                            <li><a href="?page=services&type=mainnavigation">Graphical Reports</a></li>
                            <li><a href="?page=services&type=mainnavigation">Web-based Access</a></li>
                            <li><a href="?page=services&type=mainnavigation">Student/Alumina Feedback System</a></li>
                            <li><a href="?page=services&type=mainnavigation">Environmental Friendly Solutions</a></li>
                            <li><a href="?page=services&type=mainnavigation">Dedicated Communication Channels</a></li>
                            <li><a href="?page=services&type=mainnavigation">Communication through SMS, Emails</a></li>
                            <li><a href="?page=services&type=mainnavigation">Improve Students' Performance</a></li>
                        </ul>
                    </div>
                    <div id="overview_div" class="left" style="display: none;">
                        <div>
                            <h3>DOWNLOAD FREE WHITEPAPER</h3>
                            <div><img src="images/mc.jpg" alt=""></div>
                            <div class="download"><a href="#">Download<div>></div></a></div>
                        </div>
                        <div>
                            <div class="heading">DOWNLOAD FREE WHITEPAPER</div>
                            <div><img src="images/mc.jpg" alt=""></div>
                            <div class="download"><a href="#">Download<div>></div></a></div>
                        </div>
                        <div>
                            <div class="heading">OFFICE 365 MIGRATION</div>
                            <div><img src="images/mc.jpg" alt=""></div>
                            <div class="download"><a href="#">Read More<div>></div></a></div>
                        </div>
                    </div>
                    <footer class="left">
                       <div>Copyright &copy; 2012 Braintouch Technologies. All Rights Reserved | <a href="?page=termsofuse">Terms of Use</a> | <a href="?page=privacypolicy">Privacy policy</a> | Powered By <a href="http://www.coravity.com/" target="_blank">Coravity Infotech</a></div>
                    </footer>
                </div>
            </section>
        </div>
       </div>  
       <?php
if(!(stristr($_SERVER['HTTP_HOST'], 'localhost'))){
 //echo "<script src='http://web.chat4support.com/weboperator/Operator/banner.aspx?sid=24203'></script>";
}
?>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript">
    $('#slideshow').cycle({
        fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
    });
</script>
</body>
</html>
