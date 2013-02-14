<!DOCTYPE html>
<html>
<head>
    <title>[#:@`pagetitle`]</title>
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="styles/internal.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <?php //echo '<script type="text/javascript" src="https://www.google.com/jsapi"></script>'; ?>
</head>
<body>
<div style="background: rgba(0,0,0,0.5); left:0px; right:0px; top: 0px; bottom: 0px; position: fixed; display: none;">
    <div style="background: #fff url('images/underconstruction-bg.png') no-repeat center center;  width: 250px; height:250px; margin:100px auto; border: 1px solid #000; text-align: right;">
        <a href="#underConstructionMsgClose" style="padding:10px 20px;display: block;" onclick="$(this).parent('div').parent('div').fadeOut();return false;">[Close]</a>
    </div>
</div>
<div id="maincontainer">
    <header>
        <section class="left sidebar">
            <div>
                <a href="http://www.braintouchonline.com/">
                    <img src="images/logo-name.png" width="100%">
                </a>
            </div>
        </section>
        <section class="left mainbar">
            <div>
                <ul class="horizontal nav right" style="margin-top: 70px;">
                    <li><a href="?page=insights&type=mainnavigation">INSIGHTS</a></li>
                    <li><a href="?page=innovation&type=mainnavigation">INNOVATION</a></li>
                    <li><a href="?page=services&type=mainnavigation">SMART NOW</a></li>
                </ul>
            </div>
        </section>
        <section class="right sidebar" style="margin-top: 30px;">
            <div>
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
            <?php
                if(!(stristr($_SERVER['HTTP_HOST'], 'localhost'))){
                 //echo "<script src='http://web.chat4support.com/weboperator/Operator/banner.aspx?sid=24203'></script>";
                }
            ?>
                </div>
            </div>
        </section>
    </header>

    <section class="left sidebar">
        <div>
            <div style="min-height: 120px;">
            <ul id="leftsubnav">
                <li><a href="#">Schools Reputation report</a></li>
                <li><a href="#">Annual Stats</a></li>
                <li><a href="#">Annual Schools Reputation report</a></li>
            </ul>
            
            [#:@`subnav`]
            </div>
            <?php 
            if(!$user->iflogin()){
                ?>      
                <div>
                    <h3>Our Mission</h3>
                    <p>"Our mission is to enable dedicated communication channel between parents and Institutions to enhance the overall performance of students."</p>
                    <h3>Our Vision</h3>
                    <p>"We want to see our country's education system highly recognised in the world. Where there is complete transparency in between Parents, Students and Institutions."</p>
                </div>
                <?php
            }
        ?>
        </div>
    </section>
    <section class="left mainbar">
        <div>
            <div>
                <img src="[#:@`headerimg`]" width="100%">
            </div>
            <div>
            <strong style="padding: 10px 0 0 5px; display:block; font-size: 13px;;">[#:@`pagetitle`]</strong>
                [#:@`mainbody`]
            </div>
            <footer class="left">
                <div>Need more information? <a href="?page=contact">Write to us</a></div>
                <div style="padding: 10px 0;">Copyright &copy; 2012 Braintouch Technologies.<br>All Rights Reserved | <a href="?page=termsofuse">Terms of Use</a> | <a href="?page=privacypolicy">Privacy policy</a> | Powered By <a style="text-decoration: none; color: inherit;" href="http://www.coravity.com/" target="_blank">Coravity Infotech</a></div>
            </footer>
        </div>
    </section>
    <section class="right sidebar">
        <div style="padding-left:20px">
            <nav>
                [#:@`mainnavigation`]
            </nav>
            <?php
    if($page != 'login'){
        ?>
            <div id="helpmenu">
                <h3>HOW MAY WE HELP YOU?</h3>
                <ul class="nav vertical" style="padding-left: 10px; background: #f7f7f7;">
                    <li><a href="javascript:window.print()">Print this page</a></li>
                    <li><a href="javascript:mailpage();">Email this page</a></li>
                    <li><a href="?page=contact">Write to us</a></li>
                </ul>
            </div>
            <?php
    }
             ?>
        </div>
    </section>
</div>

<script type="text/javascript" src="js/main.js"></script>

</body>
</html>
