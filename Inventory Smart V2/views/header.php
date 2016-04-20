<?php Sessions::init(); 
      Auth::handlelogin(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>InvSmart2.0</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="<?php echo URL; ?>/public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>/public/css/bootstrap-datetimepicker.min.css" />
    <link href="<?php echo URL; ?>/public/css/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>/public/css/sb-admin-2.css" rel="stylesheet">

    <link href="<?php echo URL; ?>/public/css/main.css" rel="stylesheet">
    <link href="<?php echo URL; ?>/public/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>/public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>/public/js/metisMenu.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>/public/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>/public/js/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>/public/js/bootstrap-datetimepicker.min.js"></script>

        <?php
            if (isset($this->js)) 
            {
                foreach ($this->js as $js)
                {
                    echo '<script type="text/javascript" src="'.URL.'views/'.$js.'"></script>';
                }
            }
        ?>
</head>
<body>
    <div id="wrapper">
        <?php include 'navbar.php'; ?>
        <div id="page-wrapper">
            <div class="container-fluid">

