<?php
    session_start();
    include('includes/trainer.php');

    if(isset($_SESSION['email'])){
        $fname = $_SESSION['fname'];
    }

    if(isset($_POST['add'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $fullname= $fname." ".$lname;
        $contact_num = $_POST['contact'];
        $email = $_POST['email'];
        $trainer_type = $_POST['type'];
        $gender = $_POST['gender'];

        $add = new trainerAdmin();

        if(!$add->addTrainer($fname, $lname, $contact_num, $email, $trainer_type, $gender)){
            echo "Failed to insert!".mysqli_error($add->conn);
        }
    }

        if(isset($_POST['update'])){
                $id = $_POST['update'];
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $fullname= $fname." ".$lname;
                $contact_num = $_POST['contact'];
                $email = $_POST['email'];
                $trainer_type = $_POST['type'];
                $gender = $_POST['gender'];

            $update = new trainerAdmin();

            if(!$update->editTrainer($id, $fname, $lname, $contact_num, $email, $trainer_type, $gender)){
                echo "Failed to update!".mysqli_error($update->conn);
            }
        }

        if(isset($_GET['delete'])){
            $id = $_GET['delete'];

            $delete = new trainerAdmin();

            if(!$delete->deleteTrainer($id)){
                echo "Failed to delete!".mysqli_error($delete->conn);
            }
        }
?>

<!DOCTYPE html>
    <head>
    <title>Admin Trainer</title>
        <meta name="description" content="Sufee Admin - HTML5 Admin Template">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-icon.png">
        <link rel="shortcut icon" href="favicon.ico">

        <link rel="stylesheet" href="assets/css/normalize.css">
        <link rel="stylesheet" href="assets/css/bootstrap.css">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/flag-icon.min.css">
        <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
        <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
        <link rel="stylesheet" href="assets/scss/style.css">
        <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
        <script src="assets/js/dashboard.js"></script>
        <script src="assets/js/widgets.js"></script>
        <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
        <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
        <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
        <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
        <script>
            ( function ( $ ) {
                "use strict";

                jQuery( '#vmap' ).vectorMap( {
                    map: 'world_en',
                    backgroundColor: null,
                    color: '#ffffff',
                    hoverOpacity: 0.7,
                    selectedColor: '#1de9b6',
                    enableZoom: true,
                    showTooltip: true,
                    values: sample_data,
                    scaleColors: [ '#1de9b6', '#03a9f5' ],
                    normalizeFunction: 'polynomial'
                } );
            } )( jQuery );
        </script>

        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

        <style>
            .admin-name{
                color: #000;
                font-size:16px;
            }

            .modal-dialog-view{
                width:90% !important;
            }
            input, select, textarea{
                width: 90%;
                margin-bottom: 10px;
            }
            .view-modal{
                width: 170% !important;
                position:
            }
            .view-modal{
                margin-left:-35%;
            }
        </style>
    </head>
    <body> 
        <?php include('header_admin.php'); ?>
        
        <div class="content mt-3 container">
            <h3>Trainer</h3>
            <br>
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Trainer</button>
            <br><br>      
            <table class="table table-striped">

                <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                <?php
                    $display = new trainerAdmin();
                    $stm = "SELECT * FROM `trainer`";

                    if($res = mysqli_query($display->conn, $stm)){
                        while($row = mysqli_fetch_assoc($res)){

                                $id = $row['id'];
                                $fname = $row['fname'];
                                $lname = $row['lname'];
                                $fullname= $fname." ".$lname;
                                $contact_num = $row['contact_num'];
                                $email = $row['email'];
                                $trainer_type = $row['trainer_type'];
                                $gender = $row['gender'];
                                $date_employed = $row['date_employed'];

                                echo '<tr>
                                    <td>'.$row['fname']." ".$row['lname'].'</td>
                                    <td>'.$row['trainer_type'].'</td>
                                    <td>'.$row['email'].'</td>
                                    <td>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#viewTrainer'.$id.'">View</button> 
                                        
                                         <button class="btn btn-warning" data-toggle="modal" data-target="#editTrainer'.$id.'">Edit</button> 

                                        <button class="btn btn-danger"data-toggle="modal" data-target="#deleteTrainer'.$id.'">Delete</button>
                                    </td>
                                </tr>';

                                echo '<div id="viewTrainer'.$id.'" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title">Basic Information</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-4"><strong>Full Name</strong></div>
                                                    <div class="col-sm-8">'.$fname.' '.$lname.'</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4"><strong>Gender</strong></div>
                                                    <div class="col-sm-8">'.$gender.'</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4"><strong>Trainer Type</strong></div>
                                                    <div class="col-sm-8">'.$trainer_type.'</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4"><strong>Date Started</strong></div>
                                                    <div class="col-sm-8">'.$date_employed.'</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4"><strong>Contact Number</strong></div>
                                                    <div class="col-sm-8">'.$contact_num.'</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4"><strong>Email</strong></div>
                                                    <div class="col-sm-8">'.$email.'</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    
                                        </div>
                                    </div>';

                                echo '<div id="editTrainer'.$id.'" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Class Service</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post">
                                                <input class="input-edit" type="text" name="fname" placeholder="First Name" value="'.$fname.'" required/><br>
                                                <input class="input-edit" type="text" name="lname" placeholder="Last Name" value="'.$lname.'" required/><br>
                                                    <select class="select-gender-edit" name="type">
                                                        <option value="#" disabled selected>Trainer Type</option>
                                                        <option value="regular" '.(($trainer_type == 'regular')?'selected':'').'>Regular</option>
                                                        <option value="pilates" '.(($trainer_type == 'pilates')?'selected':'').'>Pilates</option>
                                                        <option value="cardio" '.(($trainer_type == 'cardio')?'selected':'').'>Cardio</option>
                                                        <option value="bodybuilding" '.(($trainer_type == 'bodybuilding')?'selected':'').'>Body Building</option>
                                                        <option value="yoga" '.(($trainer_type == 'yoga')?'selected':'').'>Yoga</option>
                                                    </select><br>
                                                    <input class="input-edit" type="text" name="contact" placeholder="Contact Number" value="'.$contact_num.'" required/><br>
                                                    <input class="input-edit" type="text" name="email" placeholder="Email" value="'.$email.'" required/><br>
                                                    <select select class="select-gender-edit" name="gender">
                                                        <option value="#" disabled selected>Gender</option>
                                                        <option value="male" '.(($gender == 'male')?'selected':'').'>Male</option>
                                                        <option value="female" '.(($gender == 'female')?'selected':'').'>Female</option>
                                                    </select>
                    
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="update" value="'.$id.'">Submit</button>

                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    
                                        </div>
                                    </div>';

                              echo '<div id="deleteTrainer'.$id.'" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                    
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Trainer</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this trianer?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="?delete='.$id.'"><button class="btn btn-primary">Yes</button></a>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            </div>
                                        </div>
                                    
                                        </div>
                                    </div>';
                        }
                    }
                ?>
                
                </tbody>
            </table>
            </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Trainer</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                <form action="" method="post">
                            <input class="input-edit" type="text" name="fname" placeholder="First Name" required/><br>
                            <input class="input-edit" type="text" name="lname" placeholder="Last Name" required/><br>
                                <select class="select-gender-edit" name="type">
                                    <option value="#" disabled selected>Trainer Type</option>
                                    <option value="regular">Regular</option>
                                    <option value="pilates">Pilates</option>
                                    <option value="cardio">Cardio</option>
                                    <option value="bodybuilding">Body Building</option>
                                    <option value="yoga">Yoga</option>
                                </select><br>
                                <input class="input-edit" type="text" name="contact" placeholder="Contact Number" required/><br>
                                <input class="input-edit" type="text" name="email" placeholder="Email" required/><br>
                                <select select class="select-gender-edit" name="gender">
                                    <option value="#" disabled selected>Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" name="add">Submit</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                </div>
            </div>

        </div>
    </div>
       
    </body>
</html>