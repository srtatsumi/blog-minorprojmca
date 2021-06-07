<?php 
    session_start();
    if(empty($_SESSION['admin_mail'])){
        header('location: ../../../../admin/pages/examples/sign-in.php');
        exit();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Post Details</title>
    <!-- Favicon-->
    <link rel="icon" href="../../../../ps.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="../../../plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="../../../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../../../css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="../../../index.html">ADMIN PANEL</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Call Search -->
                    <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="material-icons">search</i></a></li>
                    <!-- #END# Call Search -->
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="../../../images/user.png" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']; ?></div>
                    <div class="email"><?php echo $_SESSION['admin_mail'] ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="../../../pages/examples/sign-out.php"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <?php 
                include("./sidenav.php");
            ?>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2020 - 2021 <a href="javascript:void(0);">Publisherstop</a>.
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->      
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h1>
                    DELETED POST DETAILS
                </h1>
            </div>
            <!-- Basic Examples -->
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Blog Title</th>
                                            <th>Author</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        include("./includes/config.inc.php");
                                        $obj=new Config;
                                        $sql=$obj->conn()->query("SELECT * FROM blog WHERE is_deleted='1' ");
                                        // $pbanned=$sql->fetch_assoc(); 
                                        // var_dump($pbanned);
                                        while($row=$sql->fetch_assoc()){
                                    ?>
                                        <tr>
                                            <td><?php echo $row['blog_title']; ?></td>
                                            <td><?php 
                                                echo $obj->fetch_user($row['blog_by'],'user_name');
                                             ?></td>
                                            <td>
                                                <?php echo $row['blog_cat']; ?>        
                                            </td>
                                            <td>
                                            <?php
                                                if($row['is_deleted']=='1'){
                                                    echo 'deleted';
                                                }
                                            ?>
                                            <!-- Call to action buttons -->
                                            <ul class="list-inline m-0" style="float: right;margin: -4px;">
                                                <li class="list-inline-item">
                                                    <button 
                                                        class="btn btn-primary btn-sm rounded-0 view waves-effect m-r-20" 
                                                        type="button" 
                                                        data-toggle="modal" 
                                                        data-target="#largeModal" 
                                                        title="View" 
                                                        id="<?php echo $row['blog_id']; ?>" >
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </li>
                                               <!--  <li class="list-inline-item">
                                                    <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" title="Approve"><i class="fa fa-check"></i></button>
                                                </li> -->
                                                <!-- <li class="list-inline-item">
                                                    <button class="btn btn-warning btn-sm rounded-0" type="button" data-toggle="tooltip" title="Ban"><i class="fa fa-times"></i></button>
                                                </li> -->
                                                <!-- <li class="list-inline-item">
                                                    <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                                                </li> -->
                                            </ul>
                                            </td>
                                        </tr>
                                        <?php 
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                                <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <!-- <div class="modal-header">
                                                <h4 class="modal-title" id="largeModalLabel">Modal title</h4>
                                            </div> -->
                                            <div class="modal-body">
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <!-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> -->
                                                <button type="button" class="btn btn-link waves-effect close-btn" data-dismiss="modal">CLOSE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="../../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../../plugins/node-waves/waves.js"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="../../../plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="../../../plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="../../../plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="../../../plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="../../../plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="../../../plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="../../../plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="../../../plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="../../../plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
    <script src="../../../js/admin.js"></script>
    <script src="../../../js/pages/tables/jquery-datatable.js"></script>

    <!-- Demo Js -->
    <script src="../../../js/demo.js"></script>
    <script src="../../../js/post-ajax.js"></script>
</body>

</html>
