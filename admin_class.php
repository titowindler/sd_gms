<?php
    include('includes/classService.php');

    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $type = $_POST['type'];
        $max = $_POST['max'];
        $price = $_POST['price'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $description = $_POST['description'];
        $date_start = $_POST['date_start'];
        $schedule = $_POST['schedule'];

        $add = new ClassService();

        if($add->addService($title, $type, $max, $price, $month, $year, $description, $schedule, $date_start)){
            header('http://localhost/staminaGym/admin_class.php');
            echo "Success!";
        }else{
            echo "Error adding class service!".mysqli_error($add->conn);
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

        $update = new ClassService();

        if($update->editService($title, $type, $max, $price, $month, $year, $description, $schedule, $date_start, $id)){
            header('http://localhost/staminaGym/admin_class.php');
            echo "Updated Class!";
        }else{
            echo "Error updating !".mysqli_error($update->conn);
        }
    }

    if(isset($_POST['delete'])){
        $id = $_POST['delete'];

        $delete = new ClassService();

        if($delete->deleteService($id)){
            echo "Deleted Class!";
        }else{
            echo "Error deleting class!".mysqli_error($delete->conn);
        }
    }
?>

<!DOCTYPE html>
    <head>
        <title>Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/custom.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
        <style>
            .table-service{
                width:70%;
                margin-top: 3em;
            }

            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
                max-width: 300px;
                margin: auto;
                text-align: center;
            }
            .modal-dialog-view{
                width:90% !important;
            }
        </style>
    </head>

    <body>
        <div class="container text-center">
            <h3>Class Services</h3>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addService">Add Class Service</button><br><br>
            <a href="includes/logoutMember.php"><button class="btn btn-danger">Logout Account</button></a>
        </div>

            <div class="container table-service">
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
                        $stm = "SELECT * FROM `class_service`";

                        if($res=mysqli_query($display->conn,$stm)){
                            while ($row = mysqli_fetch_assoc($res)) {
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
                                    $num_ordered = $row['num_ordered'];

                                    echo '<tr>';
                                    echo '<td>'.$row["title"].'</td>';
                                    echo '<td>'.$row["type"].'</td>';
                                    echo '<td>Php '.$row["price"].'</td>';
                                    echo '<td>';
                                    echo '<button class="btn btn-info" data-toggle="modal" data-target="#viewService'.$id.'"><span class="glyphicon glyphicon-eye-open"></span></button> ';

                                    echo '<button class="btn btn-warning" data-toggle="modal" data-target="#editService'.$id.'"><span class="glyphicon glyphicon-pencil"></span></button> ';

                                    echo '<button class="btn btn-danger" data-toggle="modal" data-target="#deleteService'.$id.'"><span class="glyphicon glyphicon-trash"></span></button>';

                                    echo '</td>';
                                    echo '</tr>';
                                    echo '</tr>';
                             ?>

                                <!-- Modal for View Class Service -->

                            <div id="viewService<?php echo $id; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog modal-dialog-view">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><?php echo $title; ?></h4>
                                        </div>

                                        <div class="modal-body">

                                            <div class="container" style="width:90%;">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                            <img class="text-center" src="images/caro3.jpeg" style="width:auto; height:340px;"><br>
                                                            <h3 class="text-center"><strong>Php <?php echo $price; ?></strong></h3>
                                                            <h4 class="text-center"><strong><?php echo $schedule; ?></strong></h4>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="panel panel-default">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">Basic Information</h3>
                                                        </div>
                                                        <div class="panel-body panel-container">
                                                            <address>
                                                            <strong>Title</strong><br>
                                                            <?php echo $title; ?>
                                                            </address>

                                                            <address>
                                                            <strong>Type</strong><br>
                                                            <?php echo $type; ?>
                                                            </address>

                                                            <address>
                                                            <strong>Max Capacity</strong><br>
                                                            <?php echo $max; ?>
                                                            </address>

                                                            <address>
                                                            <strong>Enrolled</strong><br>
                                                            <?php echo $num_ordered; ?>
                                                            </address>

                                                            <address>
                                                            <strong>Date Started</strong><br>
                                                            <?php echo $date_created; ?>
                                                            </address>
                                                            

                                                            <address>
                                                            <strong>Description</strong><br>
                                                            <?php echo $description; ?>
                                                            </address>

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
                            </div>
                            </div>

                            <!-- Modal for Edit Class Service -->

                            <div id="editService<?php echo $id; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Edit Class Service</h4>
                                    </div>
                                    <div class="modal-body text-center">
                                    <form action="" method="post">
                                        <input class="input-edit" type="text" name="title" placeholder="Title" value="<?php echo $title; ?>" required/><br>
                                        <select class="select-gender-edit" name="type">
                                            <option value="#" disabled selected>Type</option>
                                            <option value="regular">Regular</option>
                                            <option value="pilates">Pilates</option>
                                            <option value="cardio">Cardio</option>
                                            <option value="bodybuild">Body Building</option>
                                            <option value="yoga">Yoga</option>
                                        </select>
                                        <input class="input-edit" type="number" min="0.01" step="0.01" name="price" placeholder="Price" value="<?php echo $price; ?>" required/><br>

                                        <input class="input-edit" type="number" name="max" placeholder="Max Capacity" value="<?php echo $max; ?>"required/><br>

                                        <input class="input-edit" type="number" name="month" placeholder="Span of Month" value="<?php echo $month; ?>" required/><br>

                                        <input class="input-edit" type="number" name="year" placeholder="Span of Year (**optional)" value="<?php echo $year; ?>"/><br>

                                        <input placeholder="Date Started" class="textbox-n input-edit" type="text" onfocus="(this.type='date')" name="date_start" id="date" value="<?php echo $date_created; ?>"><br>

                                        <input class="input-edit" type="text" name="schedule" placeholder="Schedule Date" value="<?php echo $schedule; ?>" required/><br>

                                        <textarea class="input-edit" name="description" cols="50" rows="8" placeholder="Description"><?php echo $description; ?></textarea>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" name="update" value="<?php echo $id; ?>">Submit</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                
                                </div>
                            </div>

                            <!-- Delete Service Modal -->
                            <div id="deleteService<?php echo $id; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Delete Class Service</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Are you sure you want to delete?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="" method="post">
                                            <button type="submit" name="delete" value="<?php echo $id; ?>" class="btn btn-danger">Yes</button>
                                        </form>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                    </div>
                                    </div>

                                </div>
                                </div>
                                
                            <?php 
                                        }
                                    }
                                }
                                /* End of class_service loop */
                            ?>
                    </tbody>
                </table>
            </div>

            <?php include('views/addClassService.php'); ?>

    </body>
</html>