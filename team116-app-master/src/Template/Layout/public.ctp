<!--
=========================================================
 Material Dashboard - v2.1.1
=========================================================

 Product Page: https://www.creative-tim.com/product/material-dashboard
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/material-dashboard/blob/master/LICENSE.md)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

<!doctype html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>Pony Music</title>
    
    <!-- Required meta tags -->
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Pony Music</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- Material Kit CSS -->
    <?= $this->Html->css('material-kit.min') ?>

    <!-- JS Files -->
    <?= $this->Html->script('jquery.min'); ?>

    <!-- DataTables CSS -->
    <?= $this->Html->css('https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css') ?>
</head>

<body class="index-page sidebar-collapse">
<nav class="navbar navbar-inverse navbar-expand-lg bg-dark">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand" href="#">Pony Music</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <?= $this->Html->link('Rehearsals Calendar', '/bookings/public_rehearsal_calendar', ['class' =>
                        'nav-link']); ?>
                </li>
                <li class="nav-item">
                    <?= $this->Html->link('Recordings Calendar', '/bookings/public_recording_calendar', ['class' =>
                        'nav-link']); ?>
                </li>

                <li class="nav-item " style="float: right">

                    <a class="nav-link " href="http://www.ponymusic.com.au">X</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark"></h1>
                        </div>
                    </div>
                </div>
            </section>
            <?php echo $this->Flash->render(); ?>
            <?= $this->fetch('content') ?>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="copyright float-right">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script>
            <a href="http://www.ponymusic.com.au/">Pony Music</a>
        </div>
    </div>
</footer>

<!-- JS Files -->
<?= $this->Html->script('popper.min') ?>
<?= $this->Html->script('bootstrap-material-design.min') ?>
<?= $this->Html->script('perfect-scrollbar.jquery.min') ?>
<?= $this->Html->script('material-dashboard.min') ?>
<?= $this->Html->script('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') ?>
<?= $this->Html->script('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') ?>
</body>
</html>
