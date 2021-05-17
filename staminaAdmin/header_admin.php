<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./">Stamina</a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <!-- <li class="active">
                        <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                     -->
                    <h3 class="menu-title">Admin Action</h3><!-- /.menu-title -->
                    <li class="menu-item">
                        <a href="orderAdmin.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-credit-card"></i>Member Subscriptions</a>
                    </li>
                    <li class="menu-item">
                        <a href="classAdmin.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-table"></i>View Subscription</a>
                    </li>
                    <li class="menu-item">
                        <a href="trainerAdmin.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-address-card"></i>View Trainers</a>
                    </li>

                    <li class="menu-item">
                        <a href="memberAdmin.php" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>View Members</a>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-12">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/logo-admin.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                                <a class="nav-link" href="includes/logout.php"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                    <div class="language-select dropdown" id="language-select">
                        <p><?php echo $fname; ?></p>
                    </div>

                </div>
            </div>

        </header>