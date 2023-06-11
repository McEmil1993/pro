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