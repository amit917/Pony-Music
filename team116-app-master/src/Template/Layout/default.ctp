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

<head>
    <title>Pony Music</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Material Kit CSS -->
    <?= $this->Html->css('material-dashboard') ?>

    <?= $this->fetch('css') ?>


    <!-- JS Files -->
    <?= $this->Html->script('jquery.min') ?>

    <!-- DataTables CSS -->
    <?= $this->Html->css('https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css') ?>

</head>


<body>
<div class="">



    <div class="main-panel">


        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    <!--<a class="navbar-brand"><?php /*echo $topTitle; */?></a>-->
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>

            </div>
        </nav>
        <!-- End Navbar -->


        <div class="content">
            <div class="container-fluid"  >


                <?php echo $this->Flash->render(); ?>
                <?= $this->fetch('content') ?>
                </div>


        </div>


    </div>
</div>

<!-- JS Files -->
<?= $this->Html->script('popper.min') ?>
<?= $this->Html->script('bootstrap-material-design.min') ?>
<?= $this->Html->script('perfect-scrollbar.jquery.min') ?>
<?= $this->Html->script('material-dashboard.min') ?>
<?= $this->fetch('script') ?>
<?= $this->Html->script('https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js') ?>
<?= $this->Html->script('https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js') ?>


</body>

</html>
