<!DOCTYPE html>
<html>
<head>
    <title>[#:@`pagetitle`]</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="styles/afterlogin.css">
    <link rel="stylesheet" type="text/css" href="styles/class-box.css">
    <link href="styles/ots/jquery-ui-1.9.2.custom.css" rel="stylesheet">
    <script src="js/jquery-1.8.3.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery.color.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
</head>
<body>
    [#:@`loginbar`]
    <div id="maincontainer">
        [#:@`subnav`]
        <div id="bodycontainer">
            <nav>
                [#:@`mainnavigation`]
            </nav>
            <section id="mainbody">
                <div>
                    [#:@`mainbody`]
                </div>
            
            </section>
            <footer>
               <div>[#:@`footer`]</div>
            </footer> 
        </div>
       </div>  
       <div class="bottom_line"></div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
