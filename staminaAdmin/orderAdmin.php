<?php
    session_start();
    include('includes/orderClass.php');

    if(isset($_SESSION['email'])){
        $fname = $_SESSION['fname'];
    }

    if(isset($_GET['approve'])){
        $id = $_GET['approve'];

        $approve = new OrderClass();
        if($approve->paidOrder($id)){
            echo "Success!";
            header('location: http://localhost/staminaGym/staminaAdmin/orderAdmin.php');
        }else{
            echo 'Failed to update order!'.mysqli_error($approve->conn);
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
                width: 80% !important;
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
            <h3>Order Payments</h3>
            <br>      
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>Transaction#</th>
                    <th>Member</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $display = new OrderClass();

                    $stm = "SELECT * FROM order_class WHERE isPaid='not'";

                    if($result = mysqli_query($display->conn, $stm)){
                        while($row = mysqli_fetch_assoc($result)){
                            $class = $display->getClass($row['class_id']);
                            $member = $display->getMember($row['member_id']);

                            echo '<tr>
                                <td>'.$row['id'].'</td>
                                <td>'.$member['fname'].' '.$member['lname'].'</td>
                                <td>Php '.$row['total_price'].'</td>
                                <td>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#viewDetails'.$row['id'].'">View</button> 
                                     
                                </td>
                            </tr>';

                            echo '<div id="viewDetails'.$row['id'].'" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                            
                                <!-- Modal content-->
                                <div class="modal-content view-modal">
                                    <div class="modal-header">
                                        <h4 class="modal-title">View Order Details</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="container" style="width:90%;">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                    <img class="text-center" src="images/caro3.jpeg" style="width:auto; height:340px;"><br><br>
                                                    <h4 class="text-center"><strong>Php '.$class['price'].'</strong></h4>
                                                    <h5 class="text-center"><strong>'.$class['schedule_class'].'</strong></h5>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title">Basic Information</h3>
                                                    </div>
                                                    <div class="panel-body panel-container">
                                                        <address>
                                                        <strong>Title</strong><br>
                                                        '.$class['title'].'
                                                        </address>

                                                        <address>
                                                        <strong>Type</strong><br>
                                                        '.$class['type'].'
                                                        </address>

                                                        <address>
                                                        <strong>Max Capacity</strong><br>
                                                        '.$class['max_cap'].'
                                                        </address>

                                                        <address>
                                                        <strong>Enrolled</strong><br>
                                                        '.$class['num_ordered'].'
                                                        </address>

                                                        <address>
                                                        <strong>Date Started</strong><br>
                                                        '.$class['date_created'].'
                                                        </address>

                                                        <address>
                                                        <strong>Description</strong><br>
                                                        '.$class['description'].'
                                                        </address>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>';

                            echo '<div id="approve'.$row['id'].'" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                            
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Paid Order</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Is this order paid now?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="?approve='.$row['id'].'"><button type="button" class="btn btn-danger">Paid</button></a>
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