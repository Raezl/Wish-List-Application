<html>
<head>
    <link href="<?php echo base_url();?>application/resources/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body>

<div class="login-popup-wrap new_login_popup">
    <div class="login-popup-heading text-center">
        <h4><i class="fa fa-lock" aria-hidden="true"></i> Register </h4>
    </div>
    <div class="">
        <div class="form-group">
            <input type="text" class="form-control username" placeholder="Username" name="username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control password"  placeholder="Password" name="password">
        </div>
        <div class="form-group">
            <input type="text" class="form-control name"  placeholder="Name" name="name">
        </div>
        <div class="form-group">
            <input type="text" class="form-control description"  placeholder="Description" name="description">
        </div>
        <button class="btn btn-primary register" name="submit">Register</button>
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
