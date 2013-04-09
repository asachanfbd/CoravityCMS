
<!DOCTYPE html>
<html>
<head>
    <title>[#:@`pagetitle`]</title>
 <!--   <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.autogrowtextarea.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
</head>
<body>
<div style="background: rgba(0,0,0,0.5); left:0px; right:0px; top: 0px; bottom: 0px; position: fixed; display: none;">
<div style="background: #fff url('images/underconstruction-bg.png') no-repeat center center;  width: 250px; height:250px; margin:100px auto; border: 1px solid #000; text-align: right;">
    <a href="#underConstructionMsgClose" style="padding:10px 20px;display: block;" onclick="$(this).parent('div').parent('div').fadeOut();return false;">[Close]</a>
</div>
</div>

    <div id="inner-main-div">
        <section id="header">
            <div id="head-left">
                <img src="images/logo-name.png">      
            </div>
            <div id="head-right">
                <img src="images/header-right.png">      
            </div>
        </section>
    
        <nav id="mainnav">
            [#:@`mainnavigation`]
        </nav>
        <section id="mainbody">
            [#:@`mainbody`]
        </section>
        <footer>
            <div>&copy; 2012 BrainTouch Technologies</div>
        </footer>
    </div>
    
<script type="text/javascript" src="js/main.js"></script>

</body>
</html>
