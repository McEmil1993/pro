<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="m-3">Admin side</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        ALL Post
                        <div class="float-end">
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#add-modal">Add post</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">carType</th>
                                    <th scope="col">email</th>
                                    <th scope="col">name</th>
                                    <th scope="col">phone</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-list">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <div class="modal fade" id="add-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" ></button>
                </div>
                <div class="modal-body">
                    <form id="add-post" method="post">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" id="content" name="content"></textarea>
                        </div>
                        <button type="button" id="add-submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 
    <div class="modal fade" id="update-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="update-post" method="post">
                        <div class="mb-3">
                            <label for="update-title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="update-title" >
                        </div>
                        <div class="mb-3">
                            <label for="update-content" class="form-label">Content</label>
                            <textarea class="form-control" name="content" id="update-content"></textarea>
                        </div>
                        <button type="button" id="update-button" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-modal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="lead">Are you sure you want to delete this post?</p>
                    <input name="id" id="post-id" type="hidden">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="delete-button" class="btn btn-primary">Delete</button>
                </div>
            </div>
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
            var htmls = [];
            $.each(value, function(index, value){
                if(value) {
                    htmls.push('<tr>\
                        <td>'+ index +'</td>\
                        <td>'+ value.carType +'</td>\
                        <td>'+ value.email +'</td>\
                        <td>'+ value.name +'</td>\
                        <td>'+ value.phone +'</td>\
                        <td><a data-bs-toggle="modal" data-bs-target="#update-modal" class="btn btn-success update-post" data-id="' + index + '">Update</a>\
                        <a data-bs-toggle="modal" data-bs-target="#delete-modal" class="btn btn-danger delete-data" data-id="' + index + '">Delete</a></td>\
                    </tr>');
                }       
                lastId = index;
            });
            $('#table-list').html(htmls);
        });

        // add data
        $('#add-submit').on('click', function() {
            var formData = $('#add-post').serializeArray();
            var createId = Number(lastId) + 1;

            firebase.database().ref('DriversInformation/' + createId).set({
                title: formData[0].value,
                content: formData[1].value,
            });

            // Reassign lastID value
            lastId = createId;
            $("#add-post")[0].reset();
            $("#add-modal").modal('hide');
        });

        // update modal
        var updateID = 0;
        $('body').on('click', '.update-post', function() {
            updateID = $(this).attr('data-id');
            firebase.database().ref('DriversInformation/' + updateID).on('value', function(snapshot) {
                var values = snapshot.val();
                $('#update-title').val(values.title);
                $('#update-content').val(values.content);
            });
        });

        // update post
        $('#update-button').on('click', function() {
            var values = $("#update-post").serializeArray();
            var postData = {
                title : values[0].value,
                content : values[1].value,
            };

            var updatedPost = {};
            updatedPost['/DriversInformation/' + updateID] = postData;

            firebase.database().ref().update(updatedPost);

            $("#update-modal").modal('hide');
            $("#update-post")[0].reset();
        });

        // delete modal
        $("body").on('click', '.delete-data', function() {
            var id = $(this).attr('data-id');
            $('#post-id').val(id);
        });

        // delete post
        $('#delete-button').on('click', function() {
            var id = $('#post-id').val();
            firebase.database().ref('DriversInformation/' + id).remove();

            $('#post-id').val('');
            $("#delete-modal").modal('hide');
        });
    </script>
</body>
</html>