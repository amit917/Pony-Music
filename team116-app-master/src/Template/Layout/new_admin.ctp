<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AdminLTE 3 | Starter</title>

    <!-- jQuery -->
    <?= $this->Html->script('adminlte/jquery.min'); ?>

    <!-- DataTables CSS -->
    <?= $this->Html->css('adminlte/dataTables.bootstrap4.min'); ?>

    <!-- Theme style -->
    <?= $this->Html->css('adminlte/adminlte.min'); ?>



    <!-- Summernote Text Editor -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote-bs4.min.js"></script>

    <!-- Tempus Dominus-->
    <?= $this->Html->script('moment/moment-with-locales.min') ?>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition layout-fixed visible-sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#">
                    <ion-icon name="menu"></ion-icon>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <?= $this->Html->image('pony_logo.png', ['alt' => 'Pony Music logo', 'class' => 'brand-image', 'style' =>
            'opacity: .8']); ?>
            <span class="brand-text font-weight-light">Pony Music</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <?= $this->Html->link('Dashboard', '/users/admin_dashboard', ['class' =>
                        'nav-link']); ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('Rehearsals', '/bookings/staff_rehearsal_calendar', ['class' =>
                        'nav-link']); ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('Recordings', '/bookings/staff_recording_calendar', ['class' =>
                        'nav-link']); ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('Backline', '/assets', ['class' => 'nav-link']); ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('Sessions', '/sessions', ['class' => 'nav-link']); ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('Rehearsal Clients', '/clients', ['class' => 'nav-link']); ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('Recording Clients', '/events', ['class' => 'nav-link']); ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('Staff', '/staffs', ['class' => 'nav-link']); ?>
                    </li>
                    <li class="nav-item">
                        <?= $this->Html->link('Logout', '/users/logout', ['class' => 'nav-link']); ?>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1 class="m-0 text-dark"></h1>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section>
                <!-- /.content-header -->
                <section class="content">
                    <?php echo $this->Flash->render(); ?>
                    <?= $this->fetch('content') ?>
                </section>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; 2020 <a href="http://www.ponymusic.com.au/">Pony Music</a>.</strong>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- Bootstrap 4 -->
<?= $this->Html->script('adminlte/bootstrap.bundle.min'); ?>

<!-- DataTables JS -->
<?= $this->Html->script('adminlte/jquery.dataTables.min'); ?>
<?= $this->Html->script('adminlte/dataTables.bootstrap4.min'); ?>

<!-- AdminLTE App -->
<?= $this->Html->script('adminlte/adminlte.min'); ?>

<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons/ionicons.esm.js"></script>

</body>
</html>
