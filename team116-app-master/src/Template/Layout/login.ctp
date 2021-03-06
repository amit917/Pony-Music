<!--
=========================================================
 Material Kit - v2.0.6
=========================================================

 Product Page: https://www.creative-tim.com/product/material-kit
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/material-kit/blob/master/LICENSE.md)

 Coded by Creative Tim

=========================================================

 The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->


<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Pony Music Admin Login
    </title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- Material Kit CSS -->
    <?= $this->Html->css('material-kit.min') ?>

    <!-- JS Files -->
    <?= $this->Html->script('jquery.min'); ?>

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>

<body class="login-page">
<div class="page-header">
    <div class="container">
        <?php echo $this->Flash->render(); ?>
        <?= $this->fetch('content') ?>
    </div>
</div>
<!--   Core JS Files   -->
<?= $this->Html->script('popper.min') ?>
<?= $this->Html->script('bootstrap-material-design.min') ?>
<?= $this->Html->script('perfect-scrollbar.jquery.min') ?>
<?= $this->Html->script('material-dashboard.min') ?>
</body>

</html>
