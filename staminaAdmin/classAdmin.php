<?php
    session_start();
    include('includes/classService.php');

    if(isset($_SESSION['email'])){
        $fname = $_SESSION['fname'];
    }

    if(isset($_POST['add'])){
        $title = $_POST['title'];
        $type = $_POST['type'];
        $max = $_POST['max'];
        $price = $_POST['price'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $description = $_POST['description'];
        $date_start = $_POST['date_start'];
        $schedule = $_POST['schedule'];
        $trainer = $_POST['trainer'];

        $add = new ClassService();

        if(!$add->addService($title, $type, $max, $price, $month, $year, $description, $schedule, $date_start, $trainer)){
            echo "Failed to insert!".mysqli_error($add->conn);
        }
    }

    if(isset($_POST['update'])){
        $title = $_POST['title'];
        $type = $_POST['type'];
        $max = $_POST['max'];
        $price = $_POST['price'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $description = $_POST['description'];
        $date_start = $_POST['date_start'];
        $schedule = $_POST['schedule'];
        $id = $_POST['update'];
        $trainer = $_POST['trainer'];

        $update = new ClassService();

        if(!$update->editService($title, $type, $max, $price, $month, $year, $description, $schedule, $date_start, $id)){
            echo "Failed to update!".mysqli_error($update->conn);
        }
    }

    if(isset($_GET['delete'])){
        $id = $_GET['delete'];

        $delete = new ClassService();

        if(!$delete->deleteService($id)){
            echo "Failed to delete!".mysqli_error($delete->conn);
        }
    }
?>

<!DOCTYPE html>
<head>
        <title>Admin</title>
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

        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
        <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
        <script src="assets/js/dashboard.js"></script>
        <script src="assets/js/widgets.js"></script>

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
            <h3>Class Service</h3>
            <br>
            <button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add Class Service</button>
            <br><br>      
            <table class="table table-striped">

                <thead>
                <tr>
                    <th>Class Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>

                <?php
                    $display = new ClassService();
                    $tempTrainer = $display->getTrainer();
                    $stm = "SELECT * FROM `class_service`";

                    if($res = mysqli_query($display->conn, $stm)){
                        while($row = mysqli_fetch_assoc($res)){
                            if(strcmp($row['status'],'active')==0){
                                $id = $row['id'];
                                $type = $row['type'];
                                $title = $row['title'];
                                $max = $row['max_cap'];
                                $description = $row['description'];
                                $price = $row['price'];
                                $month = $row['duration_month'];
                                $year = $row['duration_year'];
                                $schedule = $row['schedule_class'];
                                $date_created = $row['date_created'];
                                $trainer = $row['trainer_id'];
                                $num_ordered = $row['num_ordered'];

                                echo '<tr>
                                    <td>'.$row['title'].'</td>
                                    <td>'.$row['type'].'</td>
                                    <td>Php '.$row['price'].'</td>
                                    <td>
                                        <button class="btn btn-info" data-toggle="modal" data-target="#viewService'.$id.'">View</button> 
                                        <button class="btn btn-warning" data-toggle="modal" data-target="#editService'.$id.'">Edit</button> 
                                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteService'.$id.'">Delete</button>
                                    </td>
                                </tr>';

                                echo '<div id="viewService'.$id.'" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                    
                                        <div class="modal-content view-modal">
                                            <div class="modal-header">
                                                <h4 class="modal-title">'.$title.'</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="container" style="width:90%;">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                            <img class="text-center" src="images/caro3.jpeg" style="width:auto; height:340px;"><br><br>
                                                            <h4 class="text-center"><strong>Php '.$price.'</strong></h4>
                                                            <h5 class="text-center"><strong>'.$schedule.'</strong></h5>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h3 class="panel-title">Basic Information</h3>
                                                            </div>
                                                            <div class="panel-body panel-container">
                                                                <address>
                                                                <strong>Title</strong><br>
                                                                '.$title.'
                                                                </address>

                                                                <address>
                                                                <strong>Type</strong><br>
                                                                '.$type.'
                                                                </address>

                                                                <address>
                                                                <strong>Max Capacity</strong><br>
                                                                '.$max.'
                                                                </address>

                                                                <address>
                                                                <strong>Enrolled</strong><br>
                                                                '.$num_ordered.'
                                                                </address>

                                                                <address>
                                                                <strong>Date Started</strong><br>
                                                                '.$date_created.'
                                                                </address>

                                                                <address>
                                                                <strong>Description</strong><br>
                                                                '.$description.'
                                                                </address>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    
                                        </div>
                                    </div>';

                                echo '<div id="editService'.$id.'" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                    
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Class Service</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body text-center">
                                            <form action="" method="post">
                                                <input class="input-edit" type="text" name="title" placeholder="Title" value="'.$title.'" required/><br>
                                                <select class="select-gender-edit" name="type">
                                                    <option value="#" disabled>Type</option>
                                                    <option value="regular" '.(($type=="regular")?'selected':'').'>Regular</option>
                                                    <option value="pilates" '.(($type=="pilates")?'selected':'').'>Pilates</option>
                                                    <option value="cardio" '.(($type=="cardio")?'selected':'').'>Cardio</option>
                                                    <option value="bodybuilding" '.(($type=="bodybuilding")?'selected':'').'>Body Building</option>
                                                    <option value="yoga">Yoga</option>
                                                </select><br>';
                                                echo '<select class="select-gender-edit" name="trainer">
                                                    <option value="#" disabled>Trainer</option>';
                                                    $displayTrainer = $display->getTrainer();

                                                    while($disTr = mysqli_fetch_assoc($displayTrainer)){
                                                        echo '<option value="'.$disTr['id'].'" '.(($trainer == $disTr['id'])?'selected':'').'>'.$disTr['fname'].' '.$disTr['lname'].' - '.$disTr['trainer_type'].'</option>';
                                                    }

                                                echo '</select>';
                                                echo '<input class="input-edit" type="number" min="0.01" step="0.01" name="price" placeholder="Price" value="'.$price.'" required/><br>
        
                                                <input class="input-edit" type="number" name="max" placeholder="Max Capacity" value="'.$max.'"required/><br>
        
                                                <input class="input-edit" type="number" name="month" placeholder="Span of Month" value="'.$month.'" required/><br>
        
                                                <input class="input-edit" type="number" name="year" placeholder="Span of Year (**optional)" value="'.$year.'"/><br>
        
                                                <input placeholder="Date Started" class="textbox-n input-edit" type="text" onfocus="(this.type="date") name="date_start" id="date" value="'.$date_created.'"><br>
        
                                                <input class="input-edit" type="text" name="schedule" placeholder="Schedule Date" value="'.$schedule.'" required/><br>
                                                
                                                <textarea class="input-edit" name="description" cols="50" rows="8" placeholder="Description">'.$description.'</textarea>
        
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary" name="update" value="'.$id.'">Submit</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    
                                        </div>
                                    </div>';
                                
                                    echo '<div id="deleteService'.$id.'" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                    
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Delete Class Service</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this class?</p>
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
                        <h4 class="modal-title">Add Class Service</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body text-center">
                        <form action="" method="post">
                            <input class="input-edit" type="text" name="title" placeholder="Title" required/><br>
                                <select class="select-gender-edit" name="type">
                                    <option value="#" disabled selected>Type</option>
                                    <option value="regular">Regular</option>
                                    <option value="pilates">Pilates</option>
                                    <option value="cardio">Cardio</option>
                                    <option value="bodybuild">Body Building</option>
                                    <option value="yoga">Yoga</option>
                                </select><br>
                                <select class="select-gender-edit" name="trainer">
                                    <option value="#" disabled selected>Trainer</option>
                                    <?Php
                                        $displayTr = new ClassService();
                                        $stmTr = "SELECT * FROM trainer";

                                        if($resultTr = mysqli_query($displayTr->conn, $stmTr)){
                                            while($tr = mysqli_fetch_assoc($resultTr)){
                                                echo '<option value="'.$tr['id'].'">'.$tr['fname'].' '.$tr['lname'].' - '.$tr['trainer_type'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <input class="input-edit" type="number" min="0.01" step="0.01" name="price" placeholder="Price" required/><br>
                                <input class="input-edit" type="number" name="max" placeholder="Max Capacity" required/><br>
                                <input class="input-edit" type="number" name="month" placeholder="Duration Month" required/><br>
                                <input class="input-edit" type="number" name="year" placeholder="Duration Year (**optional)"/><br>
                                <input placeholder="Date Started" class="textbox-n input-edit" type="text" onfocus="(this.type='date')" name="date_start" id="date"><br>
                                <input class="input-edit" type="text" name="schedule" placeholder="Schedule Date" required/><br>
                                <textarea class="input-edit" name="description" cols="50" rows="8" placeholder="Description"></textarea>

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