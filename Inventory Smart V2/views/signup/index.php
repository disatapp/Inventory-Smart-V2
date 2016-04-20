<div class="row">
                    <div class="col-md-4 col-md-offset-4">
                        <div class="login-panel panel panel-default">
                            <div class="panel-heading">
                                   <h3 class="panel-title">Admin: add new user</h3>
                        </div>
                        <div class="panel-body">
                            <form role="form" id="signup" name="registration-form">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Username" name="username" id="username" type="text" autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="password" id="password" type="password" value="">
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="confirmpwd" id="confirmpwd" type="password" value="">
                                    </div>


                                    <!-- Change this to a button or input when using this as a form -->
                                    <button class="btn btn-primary signup" id="signup-post">Register</button>
                                </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

        <script type="text/javascript">
            var hosturl = "<?php echo URL.'signup/'; ?>";
            $signup("#signup-post",hosturl);
        </script>