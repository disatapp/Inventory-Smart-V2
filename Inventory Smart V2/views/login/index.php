<?php session_start(); 
	  if(!empty($_SESSION['USERNAME'])){ session_destroy(); }
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
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap-datetimepicker.min.css" />
    <link href="<?php echo URL; ?>public/css/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/sb-admin-2.css" rel="stylesheet">

    <link href="<?php echo URL; ?>public/css/main.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/metisMenu.min.js"></script>
    <script type="text/javascript" src="<?php echo URL; ?>public/js/sb-admin-2.js"></script>

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
	    <div class="container">
	        <div class="row">
	            <div class="col-md-4 col-md-offset-4">
	                <div class="login-panel panel panel-default">
	                    <div class="panel-heading">
	                           <h3 class="panel-title">Login</h3>
	                	</div>
		                <div class="panel-body">
		                    <h1>InvoSmart</h1>
		                    <form role="form" id="login" name="registration-form">
		                        <fieldset>
		                            <div class="form-group">
		                                <input class="form-control" placeholder="Username" name="username" id="username" type="text" autofocus>
		                            </div>
		                            <div class="form-group">
		                                <input class="form-control" placeholder="Password" name="password" id="password" type="password" value="">
		                            </div>
		            			<button class="btn btn-primary signup" id="login-post">Login</button>
		     		        </fieldset>
		                        </form>
		                </div>
		            </div>
	            </div>
	        </div>
	    </div>
		<script type="text/javascript">
			var hosturl = "<?php echo URL.'login/'; ?>";
			$login("#login-post", hosturl);
		</script>
    </body>
</html>
