<html>
<head>
    <link href="<?php echo base_url();?>application/resources/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php if($this->session->userdata('username') != null){
    echo '<title>'. $this->session->userdata('username') .' wishlist</title>';
} else {
    echo '<title>Advanced Server Side Coursework 2</title>';

}
?>
<div class="col-md-12">
<div class="col-md-6 float-right">
    <a href="<?php echo base_url() ?>userLogin/logout/" class="btn btn-outline-danger float-right">Logout</a>
</div>

<div style="margin-top: 20px"><a href="http://localhost:8888/ASScw2/homepage/share/<?php echo $wishlistID[0]->wishlistID?>" class="btn btn-primary">Share Link</a></div>
    <p><h3 class="text-primary">Name: <?php echo $wishlistID[0]->name?><br>
    Description: <?php echo $wishlistID[0]->description?></h3></p>

<section id = "wishlist">
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>URL</th>
                <th>Priority</th>
                <th>Options</th>
            </tr>
        </thead>
            <tr>
                <td><input type="text" class="title form-control form-control-sm" placeholder="Title" name="title"></td>
                <td><input type="text" class="URL form-control form-control-sm" placeholder="URL" name="URL"></td>
                <!--<td><input type="text" class="priority form-control form-control-sm" placeholder="Priority" name="priority"></td>-->
                <td>
                    <select class="form-control" id="priority-add">
                        <option value="1">Must-Have</option>
                        <option value="2">Would be Nice to Have</option>
                        <option value="3">If You Can</option>
                    </select>
                </td>
                <td><button type="button" class= "add-item btn btn-primary btn-sm btn-block">Add</button></td>
            </tr>
        <tbody class="wishlist-items"></tbody>
    </table>
</section>
</div>


<script type="text/template" class="item-list-template">
        <td class="title"><%- title %></td>
        <td class="URL"><%- URL %></td>
        <td class="priority"><%- priority %></td>
        <td class="itemID" style="display: none"><%- itemID %></td>

        <td><button class="edit-item btn btn-warning btn-sm">Edit</button>
            <button class="delete-item btn btn-danger btn-sm">Delete</button>
            <button style="display: none" class="save-item btn btn-success btn-sm">Update</button>
            <button style="display: none" class="cancel btn btn-danger btn-sm">Cancel</button></td>
</script>

<script src="<?php echo base_url();?>application/resources/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>application/resources/underscore-min.js"></script>
<script src="<?php echo base_url();?>application/resources/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>application/resources/sweetalert.min.js"></script>
<script src="<?php echo base_url();?>application/resources/backbone-min.js"></script>
<script src="<?php echo base_url();?>application/resources/script.js"></script>




</body>
</html>