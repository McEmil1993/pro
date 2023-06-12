<!DOCTYPE html>
<?php 
session_start();
if(isset($_SESSION['email'])){
    header('location: home.php');
}

?>
<html>
<head>
    <title>NBTC</title>
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
        <div class="panel" title="NBTC Mobile App" style="padding-left: 50px; padding-right:50px;" id="signin" data-footer="none">
            <div style="text-align:center">
            <br>
            <br>
            <h2>Login Admin</h2>
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

        var database = firebase.database();

        var lastId = 0;
      

        function onc(id){
            var email = $('#email').val();
            var password = $('#password').val();
            var usr = "";
            firebase
                .auth().signInWithEmailAndPassword(email, password)
                .then((userCredential) => {
       
                        firebase.database().ref('AdminUser/' + userCredential.uid).on('value', function(snapshot) {

                            try {
                                var values = snapshot.val();

                                console.log(values.email);
                                alertSucess();
                                        
                                location.href = 'index.php?ses='+values.email;


                            } catch (err) {
                                console.log(err.message);
                                alertWarning();
                                        firebase.auth().signOut();
                                
                            }
                        });


                  
                })
                .catch((error) => {
                    alertCred();
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

        function alertSucess(){
            $("#afui").popup({
                title: "Success",
                message: "Login Success!" ,
                cancelText: "Ok",
                cancelCallback: function(){},
                cancelOnly: true
            });             
        }

        function alertWarning(){
            $("#afui").popup({
                title: "Warning",
                message: "You are not allow to admin login." ,
                cancelText: "Ok",
                cancelCallback: function(){},
                cancelOnly: true
            });             
        }

        function alertCred(){
            $("#afui").popup({
                title: "Warning",
                message: "Please check your credentials." ,
                cancelText: "Ok",
                cancelCallback: function(){},
                cancelOnly: true
            });             
        }

    </script>
</body>
</html>    