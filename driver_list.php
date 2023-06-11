<!DOCTYPE html>
<html>
<head>
    <title>List View App template for social app</title>
<!--
    This template can be used for simple list view application that has a main view with list and detail view for each list item, for applications like Mail app, Messages App or Twitter app.
    This template has image and text sections for each list item, which can be used for creating social app with profile image and text.
-->  
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0;" />
    
    <link rel="stylesheet" type="text/css" href="appframework/af.ui.css" />
    <link rel="stylesheet" type="text/css" href="appframework/icons.css" />
    <script type="text/javascript" charset="utf-8" src="appframework/appframework.ui.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>    
        function onDeviceReady(){ 
            $.ui.launch();
            intel.xdk.device.hideSplashScreen();
        }
        document.addEventListener("intel.xdk.device.ready", onDeviceReady, false);
    </script>
<!-- end Intel XDK code -->
    
    <script>   
        $.ui.autoLaunch = false; 
        $.ui.backButtonText = "Back";
                
        $(document).ready(function(){
            $.ui.launch();
        });
    </script>
    <style>
/* css for custom list item, modify as needed */        
#afui #listview .list li {padding:10px 20px 10px 10px}
.list-image {float:left;width:50px;height:50px}
.list-text {margin-left:60px;min-height:50px}        
    </style>    
</head>
<body> 
<div id="afui">
    <div id="content" style="">
        
    <!--List View Page-->
        <div class="panel" title="Title" id="listview" data-footer="none" selected="true">
            <ul class="list" >
                <li>
                    <a href="#item1">
                        <img class="list-image" src="data/male_user_icon.svg" />
                        <div class="list-text"><b>username1</b><br>Placeholder text for this list item 1. This sections can modified for your need.</div>
                    </a>
                </li>
               
                </li>                
            </ul>
        </div>
        
    <!--Detail View Pages for each list items-->
        <div id="display_info">
            <div class="panel" title="Item 1" id="item1" data-footer="none">
                <p>This is detail view for Item 1</p>
            </div>
            
        </div>
       
       
    </div>
</div>
<?php include "script.php"; ?>
</body>
</html>    