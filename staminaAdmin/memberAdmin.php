<?php
    session_start();
    include('includes/members.php');

    if(isset($_SESSION['email'])){
        $fname = $_SESSION['fname'];
    }

    if(isset($_GET['block'])){
        $block = new Member();
        $id = $_GET['block'];

        if($block->blockMembers($id)){
            echo "Success!";
            header('location: http://localhost/staminaGym/staminaAdmin/memberAdmin.php');
        }else{
            echo "Failed to block!".mysqli_error($block->conn);
        }
    }

    if(isset($_GET['unblock'])){
        $unblock = new Member();
        $id = $_GET['unblock'];

        if($unblock->unblockMembers($id)){
            echo "Success!";
            header('location: http://localhost/staminaGym/memberAdmin.php');
        }else{
            echo "Failed to block!".mysqli_error($unblock->conn);
        }
    }
?>

<!DOCTYPE html>
    <head>
    <title>Admin Class Service</title>
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
            .table{
                width: 90% !important;
            }
        </style>
    </head>
    <body> 
        <?php include('header_admin.php'); ?>
        
        <div class="content mt-3 container">
            <h3>Member</h3>
            <br>     
            <table class="table table-striped">

                <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $display = new Member();

                    $stm = "SELECT * FROM member WHERE email != '".$_SESSION['email']."'";
                    if($result = mysqli_query($display->conn, $stm)){
                        while($row=mysqli_fetch_assoc($result)){
                            echo '<tr>
                                <td>'.$row['fname'].' '.$row['lname'].'</td>
                                <td>'.$row['contact_num'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#view'.$row['id'].'">View</button>
                                    '.(($row['status']=="active")?
                                    '<button class="btn btn-danger" data-toggle="modal" data-target="#block'.$row['id'].'">Block</button>':
                                    '<button class="btn btn-primary" data-toggle="modal" data-target="#block'.$row['id'].'">Unlock</button>').' 
                                </td>
                            </tr>';

                            echo '<div id="view'.$row['id'].'" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                
                                    <!-- Modal content-->
                                    <div class="modal-content text-center">
                                        <div class="modal-header">
                                            <h4 class="modal-title">View Profile</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row text-center">
                                                <center><img src="images/logo-admin.png" style="width:auto;height:150px; display: block;margin-left: auto;margin-right: auto;"></center>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-3"><strong>Name</strong></div>
                                                <div class="col-sm-9">'.$row['fname'].' '.$row['lname'].'</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"><strong>Email</strong></div>
                                                <div class="col-sm-9">'.$row['email'].'</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"><strong>Contact</strong></div>
                                                <div class="col-sm-9">'.$row['contact_num'].'</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"><strong>Gender</strong></div>
                                                <div class="col-sm-9">'.$row['gender'].'</div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                
                                    </div>
                                </div>';

                                echo '<div id="block'.$row['id'].'" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Block User</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to block '.$row['fname'].'?</p>
                                        </div>
                                        <div class="modal-footer">
                                            '.(($row['status']=="active")?
                                            '<a href="?block='.$row['id'].'"><button class="btn btn-danger">Block</button></a>':
                                            '<a href="?unblock='.$row['id'].'"><button class="btn btn-primary">Unblock</button></a>').'
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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

    </body>
</html>