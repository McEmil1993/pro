<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['email'])){
    header('location: login.php');
}
?>
<html>
<head>
    <title>NBTC</title>
<!--
    This template can be used for simple tab view application that has tabs at the bottom to switch views, for applications like Phone app, Facebook App or Instagram app.
--> 
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0;" />
    
    <link rel="stylesheet" type="text/css" href="appframework/af.ui.css" />
    <link rel="stylesheet" type="text/css" href="appframework/icons.css" />
    <script type="text/javascript" charset="utf-8" src="appframework/appframework.ui.min.js"></script>
    
<!-- Required if packaging to native app using Intel XDK -->    
    
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
        <header id="header1">
            <h1>Drivers</h1>
                
                <a href="#" class="button icon user" onclick="login()" style="float:right"> New</a>
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
        
        <div class="panel" title="Commuter" id="page2" data-tab="tab2">
            <header>
                <h1>Commuter</h1>
            </header>
            <ul class="list" id="table-list-commuter">
                    
                <li>
                    <center>
                        <b>
                            Load Data ....
                        </b>
                        
                    </center>
                </li>                
            </ul>
        </div>
        
        <div class="panel" title="Rate" id="page3" data-tab="tab3">
            <header id="header1">
                <h1>Rates</h1>
                    <a href="#" class="button icon " onclick="vechiletype()"> Vehicle</a>
                    <a href="#" class="button icon user" onclick="basefare()" style="float:right"> Rate</a>
            </header>
            <ul class="list" id="table-list-rates">
                    
                <li>
                    <center>
                        <b>
                            Load Data ....
                        </b>
                        
                    </center>
                </li>                
            </ul>
            <!-- $date = date("D M d Y"); -->
            
            
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
        <a href="#page1" id='tab1' class="icon user" data-transition="none">Drivers</a>
        <a href="#page2" id='tab2' class="icon user" data-transition="none">Commuter</a>
        <a href="#page3" id='tab3' class="icon tag"  data-transition="none">Rate</a>
        <a href="#" id='tab4' onclick="logout1()" class="icon right" data-transition="none">Logout</a>
    </div>
    <div id="ids">
        
    </div>
   
    <!-- RidersInformation -->

</div>
    <script>$('#m1').click(function(){
            console.log(1);
        });</script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
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
                    console.log(value.avatarUrl);
                    if (value.avatarUrl != undefined) {
                        var img = value.avatarUrl;
                    }

                    htmls +='<li>\
                                    <a href="#modal'+count+'" onclick="onc('+count+')" id="mon'+count+'" data-email="'+value.email+'" data-password="'+value.password+'">\
                                        <img class="list-image" src="'+img+'" />\
                                        <div class="list-text"><b>'+value.name+'</b><br>'+value.email+'<br>'+value.phone+'</div>\
                                    </a>\
                                </li>';


                }

                count++;

            });
            if(value===null){
                htmls += '<li><center><h4>No data</h4></center></li>';
            }
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
                                <input name="uid" type="hidden" id="uid'+count2+'"  value="'+index+'"/>\
                                <input name="avatarUrl" type="hidden" id="avatarUrl'+count2+'"  value="'+value.avatarUrl+'"/>\
                                <input name="carType" type="hidden" id="carType'+count2+'"  value="'+value.carType+'"/>\
                                <input name="name" type="text" id="name'+count2+'" placeholder="Name"  value="'+value.name+'"/>\
                                <input name="email" type="text" disabled id="email'+count2+'" placeholder="Email" value="'+value.email+'"/>\
                                <input name="phone" type="text" id="phone'+count2+'" placeholder="Phone" value="'+value.phone+'"/>\
                                <input name="password" type="password" id="password'+count2+'" placeholder="password" value="'+value.password+'"/>\
                                <a class="button block green" href="#" onclick="UpdatePassword('+count2+')" id="register">Submit</a>\
                             </div>';

                            

                    count2++;
                }

            });
            if(value===null){
                htmls1 += '<li><center><h4>No data</h4></center></li>';
            }
            $('#ids').html(htmls1);

          
        });

        database.ref("RidersInformation").on('value', function(snapshot) {
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
                                    <p id="mon'+count+'" data-email="'+value.email+'" data-password="'+value.password+'">\
                                        <img class="list-image" src="'+img+'" />\
                                        <div class="list-text"><b>'+value.name+'</b><br>'+value.email+'<br>'+value.phone+'</div>\
                                    </p>\
                                </li>';


                }

                count++;

            });
            $('#table-list-commuter').html(htmls);


          
        });
        var lastId = 0;
        database.ref("Basefare").on('value', function(snapshot) {
            var value = snapshot.val();
            var htmls = '';
            var htmls1 = '';
            var count = 1;
            var count2 = 1;
          
            $.each(value, function(index, value){
                if(value) {
                    
                    htmls +=' <li onclick="updatebasefare('+index+')"><p>Rate: '+value.rate+'</p><p>Date: '+value.date+'</p> <p>Status: '+value.status+'</p><input type="hidden" id="rate_e'+index+'" value="'+value.rate+'" /><input type="hidden" id="status_e'+index+'" value="'+value.status+'" /></li>';
                               
                }
                 
                lastId = index;
                count++;

            });
            if(value===null){
                htmls += '<li><center><h4>No data</h4></center></li>';
            }
            // console.log(count);
            $('#table-list-rates').html(htmls);

          
        });

       
        function logout1(){
            location.href = 'logout.php';
        }

   
        function onc(id){
            var email = $('#mon'+id).attr('data-email');
            var password = $('#mon'+id).attr('data-password');
            firebase
                .auth().signInWithEmailAndPassword(email, password)
                .then((userCredential) => {
                   
                    var user = userCredential.user;
                    console.log("Sign In SuccessFul!");
                  
                })
                .catch((error) => {
                    // var errorCode = error.code;
                    // $.ui.hideModal();
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

                firebase.database().ref('DriversInformation/' + uid).set(
                    { 
                        avatarUrl: avatarUrl, 
                        carType: carType,
                        email: email,
                        name: name,
                        password: password,
                        phone: phone
                    }
                );
               
        
                console.log('Update SuccessFul password');
                alertSucessUpdate();
            }).catch((error) => {
                firebase.auth().signOut();
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

        function trash(){
            $("#afui").actionsheet(
                [{
                    text: 'Rate',
                    cssClasses: 'red',
                    handler: function () {
                    }
                },{
                    text: 'Remove All',
                    cssClasses: 'red',
                    handler: function () {
                    }
                }]
            );
        }

        function login(){


            $("#afui").popup({
                type:'overlay',
                title: "Add Driver",
                message: "Email: <input type='email' class='af-ui-forms' id='new_email' required><br>Password: <input type='password' id='new_password' class='af-ui-forms' style='webkit-text-security:disc' required><br>Name: <input type='text' id='new_name' class='af-ui-forms' style='webkit-text-security:disc' required><br>Phone: <input type='text' class='af-ui-forms' id='new_phone' style='webkit-text-security:disc' required>",
                cancelText: "Cancel",
                cancelCallback: function(){},
                doneText: "Submit",
                doneCallback: function(){
                    var name = "";
                    var ph = "";
                    var pass = "";
                    // alert($('#new_email').val());
                    if($('#new_email').val() == ""){
                        // $('#new_email').attr('style','border:1px solid red');
                        alertmess('Email');
                        login();
                       
                    }else if($('#new_password').val() == ""){
                        alertmess('Password');
                        login();
                       
                    }else if($('#new_name').val() == ""){
                        alertmess('Name');
                        login();
                       
                    }else if($('#new_phone').val() == ""){
                        alertmess('Phone');
                        login();
                       
                    }else{

                        name = $('#new_name').val();
                        ph = $('#new_phone').val();
                        pass = $('#new_password').val();
                        const promise = firebase.auth().createUserWithEmailAndPassword($('#new_email').val(),pass)
                        .then((userCredential) => {
                            // console.log(userCredential.uid);
                            var asd = userCredential.uid;
                                    firebase.database().ref('DriversInformation/' + asd).set({
                                        avatarUrl:'https://firebasestorage.googleapis.com/v0/b/nbtc-ff2e5.appspot.com/o/images%2Fuser.png?alt=media&token=ccb47963-0cfb-42b8-9f4d-7057ada0bbb2&_gl=1*vualsm*_ga*MTcyNDcwODYyMy4xNjg2NTUwOTUz*_ga_CW55HF8NVT*MTY4NjU1MDk1Mi4xLjEuMTY4NjU1ODc4NC4wLjAuMA..',
                                        carType: '',
                                        email: userCredential.email,
                                        name: name,
                                        password: pass,
                                        phone: ph
                                    });
                            alertSucess();

                        });
                        promise.catch(e => console.log(e.message));

                        
                    }

                },
                cancelOnly: false,
                keepfocus:true

            });             
        }


        function alertmess(name){
            $("#afui").popup({
                title: "Require",
                message: "Please input field "+name ,
                cancelText: "Ok",
                cancelCallback: function(){},
                
                cancelOnly: true
            });             
        }

        function alertSucess(){
            $("#afui").popup({
                title: "Success",
                message: "Add new driver success!" ,
                cancelText: "Ok",
                cancelCallback: function(){},
                cancelOnly: true
            });             
        }

        function alertSucessUpdate(){
            $("#afui").popup({
                title: "Success",
                message: "Update new driver success!" ,
                cancelText: "Ok",
                cancelCallback: function(){},
                cancelOnly: true
            });             
        }

        function basefare(){

            var dt = "<?= date("D M d Y") ?>";

            var createId = Number(lastId) + 1;

            $("#afui").popup({
                title: "Basefare",
                message: "Rate: <input type='number' id='rate' class='af-ui-forms'><br><select name='status' id='status_rate' class='af-ui-forms'><option value='Active'>Active</option><option value='Unactive'>Unactive</option></select><input type='hidden' id='date_now' value='"+dt+"' />",
                cancelText: "Cancel",
                cancelCallback: function(){},
                doneText: "Submit",
                doneCallback: function(){

                    var _rate = $('#rate').val();
                    var _status_rate = $('#status_rate').val();

                    firebase.database().ref('Basefare/' + createId).set({
                        rate: _rate,
                        status: _status_rate,
                        date: dt
                    });

                },
                cancelOnly: false
            });             
        }

        function updatebasefare(id){

            var dt = "<?= date("D M d Y") ?>";
            var st = $('#status_e'+id).val();
            var rt = $('#rate_e'+id).val();
            var ac = "";
            var un = "";
            console.log(st);
            if (st == "Active") {
                un = "";
                ac = "selected";
            } else {
                ac = "";
                un = "selected";
            }

            $("#afui").popup({
                title: "Basefare",
                message: "Rate: <input type='number' id='rate_update' class='af-ui-forms' value='"+rt+"' ><br><select name='status' id='status_rate_update' class='af-ui-forms'><option value='Active' "+ac+" >Active</option><option value='Unactive' "+un+" >Unactive</option></select><input type='hidden' id='date_now_update' value='"+dt+"' /><input type='hidden' id='id_update' value='"+dt+"' />",
                cancelText: "Cancel",
                cancelCallback: function(){},
                doneText: "Submit",
                doneCallback: function(){

                    var _rate = $('#rate_update').val();
                    var _status_rate = $('#status_rate_update').val();

                    firebase.database().ref('Basefare/' + id).set({
                        rate: _rate,
                        status: _status_rate,
                        date: dt
                    });

                },
                cancelOnly: false
            });             
            }
        var lastN = 0;
        function vechiletype(){
            var htm = '';
            var sas = '';
            
            database.ref("Vehicle").on('value', function(snapshot) {
                    var value = snapshot.val();
                    
                    htm += '<ul class="list" id="table-list-rates">';
                    $.each(value, function(index, value){
                        if(value) {
                            
                            htm +='<li style="padding:5px 0px 5px 0px">\
                                        <p >'+value.type+'</p> <a class="icon trash" style="position: absolute;right: 0;top: 12px;" onclick="deletetype('+index+')"></a>\
                                    </li>';
                                    
                        }
                        
                        lastN = index;

                    });
                    if(value===null){
                        htm += '<li><center><p>No data</p></center></li>';
                    }

                    htm += '</ul>'; 

                   

                    $("#afui").popup({
                        title: 'Vehicle',
                        message: htm,
                        doneText: "New type",
                        doneCallback: function(){
                            addtype();
                        },
                        cancelText: "Cancel",
                        cancelCallback: function(){
                            window.location.reload();
                        },
                        cancelOnly: false
                    }); 
                   
                });

                // console.log(sas);
                // console.log(lastN);
                
                        
        }

        function addtype(){
            var createId = Number(lastN) + 1;
            $("#afui").popup({
                title: 'New type vehicle',
                message: "Type: <input type='text' id='type' class='af-ui-forms'><br>",
                cancelText: "Cancel",
                cancelCallback: function(){
                    window.location.reload();
                },
                doneText: "Submit",
                doneCallback: function(){
                    var _type = $('#type').val();
                    firebase.database().ref('Vehicle/' + createId).set({
                        type: _type,
                    });

                    window.location.reload();
                },
                cancelOnly: false
            });   
        }

        function deletetype(id){
            
            $("#afui").popup({
                title: 'Delete type vehicle',
                message: "You want to delete?",
                cancelText: "Cancel",
                cancelCallback: function(){
                    window.location.reload();
                },
                doneText: "Submit",
                doneCallback: function(){
                    firebase.database().ref('Vehicle/' + id).remove();

                    window.location.reload();
                },
                cancelOnly: false
            });   
        }

        


    </script>
    
</body>
</html>  