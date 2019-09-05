<html>
<head>
    <link href="<?php echo base_url();?>application/resources/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body>
<div align="center">
<div class="login-popup-wrap new_login_popup col-md-6">
    <div class="login-popup-heading text-center">
        <h4><i class="fa fa-lock" aria-hidden="true"></i> Login </h4>
    </div>
    <div class="">
    <div class="form-group">
        <input type="text" class="form-control username" placeholder="Username" name="username">
    </div>
    <div class="form-group">
        <input type="password" class="form-control password"  placeholder="Password" name="password">
    </div>
        <div class="col-md-6">
            <button class="btn btn-primary userlogin btn-block" name="submit">Login</button>
        </div>
        <div class="col-md-6">
            <a href="<?php echo base_url().'register' ?>" class="btn btn-outline-primary btn-block my-4">Register</a>
        </div>
    </div>
</div>
</div>

<script src="<?php echo base_url();?>application/resources/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>application/resources/underscore-min.js"></script>
<script src="<?php echo base_url();?>application/resources/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>application/resources/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>application/resources/backbone-min.js"></script>
<script src="<?php echo base_url();?>application/resources/script.js"></script>

</body>
</html>
