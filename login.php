<!DOCTYPE html>
<?php 
session_start();
if(isset($_SESSION['email'])){
    header('location: home.php');
}

?>
<html>
<head>
    <title>Single View App template</title>
<!--
    This template can be used for simple application that has just a main view, for applications like Flash light app or Calculator app.
-->    
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0;" />
    
    <link rel="stylesheet" type="text/css" href="appframework/af.ui.css" />
    <link rel="stylesheet" type="text/css" href="appframework/icons.css" />
    <script type="text/javascript" charset="utf-8" src="appframework/appframework.ui.min.js"></script>
 

    <script>    
        function onDeviceReady(){ 
            $.ui.launch();
            intel.xdk.device.hideSplashScreen();
        }
        document.addEventListener("intel.xdk.device.ready", onDeviceReady, false);
    </script>

    <script>   
        $.ui.autoLaunch = false;        
                
        $(document).ready(function(){
            $.ui.launch();
        });
    </script>  
</head>
<body> 
<div id="afui">
    <div id="content" style="">
        <div class="panel" title="Login" id="signin" data-footer="none">
            <div style="text-align:center">
            <br>
            <br>
            <p>This is space for login message</p>
            <br>
            <br>
            </div>
            <input name="email" id="email" type="email" placeholder="Email" />
            <input name="password" id="password" type="password" placeholder="Password" />
            <a class="button block green" href="#" onclick="onc()" id="login">Login</a>
        </div>
    </div>
</div>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/3.7.4/firebase.js"></script>

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

        // var database = firebase.database();

        var lastId = 0;
      
        // get post 
       
        // if(user){
        //     location.href = 'home.php?email=&password=';
        // }

        function onc(id){
            var email = $('#email').val();
            var password = $('#password').val();
            firebase
                .auth().signInWithEmailAndPassword(email, password)
                .then((userCredential) => {
                   
                    var user = userCredential.user;
                    location.href = 'index.php?ses='+email;
                  
                })
                .catch((error) => {
                    // var errorCode = error.code;
                  
                    var errorMessage = error.message;
                    console.log(errorMessage);
                });
            
        }
       
        function UpdatePassword(id) {
            var avatarUrl = $('#avatarUrl'+id).val();
            var carType = $('#carType'+id).val();
            var phone = $('#phone'+id).val();
            var name = $('#name'+id).val();
            var email = $('#email'+id).val();
            var password = $('#password'+id).val();
            var uid = $('#uid'+id).val();
            const user = firebase.auth().currentUser;
        
            user.updatePassword(password).then(() => {
                // Update successful.
                var postData = {
                    avatarUrl: avatarUrl, 
                    carType: carType,
                    email: email,
                    name: name,
                    password: password,
                    phone: phone
                };

                var updatedPost = {};

                updatedPost['/DriversInformation/' + uid] = postData;

                firebase.database().ref().update(updatedPost);
        
                console.log('Update SuccessFul password');
        
            }).catch((error) => {
                var errorMessage = error.message;
                    console.log(errorMessage);
            });

            
           
        }
        function signOut(){
            firebase.auth().signOut().then(() => {
                console.log('Success Sign out!');
                $.ui.hideModal();
            }).catch((error) => {
                var errorMessage = error.message;
                    console.log(errorMessage);
            });

        }

    </script>
</body>
</html>    