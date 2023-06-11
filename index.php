<!DOCTYPE html>
<html>
<head>
    <title>Tab View App template</title>
<!--
    This template can be used for simple tab view application that has tabs at the bottom to switch views, for applications like Phone app, Facebook App or Instagram app.
--> 
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0;" />
    
    <link rel="stylesheet" type="text/css" href="appframework/af.ui.css" />
    <link rel="stylesheet" type="text/css" href="appframework/icons.css" />
    <script type="text/javascript" charset="utf-8" src="appframework/appframework.ui.min.js"></script>

<!-- Required if packaging to native app using Intel XDK -->    
    <script src="intelxdk.js"></script>
    <script src="xhr.js"></script>
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
        $.ui.animateHeaders = false;
        $.ui.backButtonText = "Back";       
        $(document).ready(function(){
            $.ui.launch();
        });
    </script>    

<style>
/* css for custom list item, modify as needed */        
#afui #listview .list li {padding:10px 20px 10px 10px}
.list-image {float:left;width:50px;height:50px}
.list-text {margin-left:65px;min-height:50px}        
    </style>    
</head>
<body> 
<div id="afui">
    
    <div id="content" style=""> 
        
    <!--Tab View Pages-->
        <div class="panel" title="Home" id="page1" data-tab="tab1" selected="true">
            <header>
                <h1>Home</h1>
            </header>
            <ul class="list" id="table-list">
                
                <li>
                    <center>
                        <b>
                            Load Data ....
                        </b>
                        
                    </center>
                </li>                
            </ul>
        </div>
        
        <div class="panel" title="Favorites" id="page2" data-tab="tab2">
            <header>
                <h1>Favorites</h1>
            </header>
            <p>This is view for second Tab</p>
        </div>
        
        <div class="panel" title="Messages" id="page3" data-tab="tab3">
            <header>
                <h1>Messages</h1>
            </header>
            <p>This is view for third Tab</p>
        </div>
        
        <div class="panel" title="Profile" id="page4" data-tab="tab4">
            <header>
                <h1>Profile</h1>
            </header>
            <p>This is view for fourth Tab</p>
        </div>
        
    </div>
    <div id="display_info">
        <div class="panel" title="Sample" id="item1" data-footer="none">
            <p>This is detail view for Item 1</p>
        </div>

<!--         
        <div class="panel" title="Sample" id="item2" data-footer="none">
            <p>This is detail view for Item 2</p>
        </div> -->
        
    </div>
    
    <!--Footer with Tabs or Navigation bar -->
    <div id="navbar">
        <a href="#page1" id='tab1' class="icon home" data-transition="none">Home</a>
        <a href="#page2" id='tab2' class="icon heart" data-transition="none">Favorites</a>
        <a href="#page3" id='tab3' class="icon chat" data-transition="none">Messages</a>
        <a href="#page4" id='tab4' class="icon user" data-transition="none">Profile</a>
    </div>
    <div id="ids">
        
    </div>
   
    

</div>

<script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
    <script type="text/javascript">
        // Your web app's Firebase configuration
        const firebaseConfig = {
            apiKey: "AIzaSyD500kjDer_rNwE1zhQ5Mkb6CPq20RHMmU",
            authDomain: "nbtc-ff2e5.firebaseapp.com",
            databaseURL: "https://nbtc-ff2e5-default-rtdb.firebaseio.com",
            projectId: "nbtc-ff2e5",
            storageBucket: "nbtc-ff2e5.appspot.com",
            messagingSenderId: "1046688681767",
            appId: "1:1046688681767:web:8ac204e6eb8e0dcafaa302",
            measurementId: "G-6ZBJ354T8E"
        };

        

        // Initialize Firebase
        const app = firebase.initializeApp(firebaseConfig);

        var database = firebase.database();

        var lastId = 0;
      
        // get post data
        database.ref("DriversInformation").on('value', function(snapshot) {
            var value = snapshot.val();
            var htmls = '';
            var htmls1 = '';
            var count = 1;
            var count2 = 1;
          
            $.each(value, function(index, value){
                if(value) {
                    var img = "user.png";
                    if (value.avatarUrl != undefined) {
                        var img = value.avatarUrl;
                    }

                    htmls +='<li>\
                                    <a href="#modal'+count+'">\
                                        <img class="list-image" src="'+img+'" />\
                                        <div class="list-text"><b>'+value.name+'</b><br>'+value.email+'<br>'+value.phone+'</div>\
                                    </a>\
                                </li>';


                }

                count++;

            });
            $('#table-list').html(htmls);

            $.each(value, function(index, value){
                if(value) {
                    var img = "user.png";
                    if (value.avatarUrl != undefined) {
                        var img = value.avatarUrl;
                    }

                    htmls1 +='<div class="panel" title="Settings" id="modal'+count2+'" modal="true" data-footer="none">\
                                <div style="text-align:center">\
                                <br>\
                                <br>\
                                <h3>Update Driver</h3>\
                                <br>\
                                <br>\
                                </div>\
                                <input name="name" type="text" placeholder="Name"  value="'+value.name+'"/>\
                                <input name="email" type="text" placeholder="Email" value="'+value.email+'"/>\
                                <input name="phoone" type="text" placeholder="Phone" value="'+value.phone+'"/>\
                                <input name="password" type="password" placeholder="password" value="'+value.password+'"/>\
                                <a class="button block green" href="#" id="register">Submit</a>\
                             </div>';

                    count2++;
                }

            });
            $('#ids').html(htmls1);

          
           
        });

    </script>
</body>
</html>  