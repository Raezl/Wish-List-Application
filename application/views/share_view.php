<html>
<head>
    <link href="<?php echo base_url();?>application/resources/bootstrap.min.css" rel="stylesheet" type="text/css">
    <title>Advanced Server Side Coursework 2</title>
</head>
<body>
<div style="margin-top: 20px">
<h4 class="details" >Name: <?php if(isset($name)){ echo $name;}else{echo 'Wrong Share Link';};?></h4>
<h6 class="details text-primary">Owner: <?php if(isset($owner)){ echo $owner;}?></h6>
<h6 class="details text-primary">Description: <?php if(isset($description)){ echo $description;}?></h6>
    <div style="margin-top: 20px">
<section id = "wishlist">
    <div class="wishlistID" style="display: none"><?php if(isset($wishlistID)){ echo $wishlistID;}?></div>
    <table class="table">
        <thead>
        <tr>
            <th>Title</th>
            <th>URL</th>
            <th>Priority</th>
        </tr>
        </thead>
        <tbody class="share-wishlist"></tbody>
    </table>
</section>
    </div>
</div>
<script type="text/template" class="share-list-template">
    <td class="title"><%- title %></td>
    <td class="URL"><%- URL %></td>
    <td class="priority"><%- priority %></td>
    <td class="itemID" style="display: none"><%- itemID %></td>
</script>
<script src="<?php echo base_url();?>application/resources/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>application/resources/underscore-min.js"></script>
<script src="<?php echo base_url();?>application/resources/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>application/resources/backbone-min.js"></script>
<script src="<?php echo base_url();?>application/resources/script.js"></script>
</body>
</html>