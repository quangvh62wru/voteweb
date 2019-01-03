<?php
// display the table if the number of users retrieved was greater than zero

if($num>0){
    ?>
 
    <table id="kq" class='table table-hover table-responsive table-bordered'>
 
     <!-- table headers -->
    <tr>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Contact Number</th>
        <th>Access Level</th>
        <th>Thao tác</th>
    </tr>
 
     <!-- loop through the user records -->
<?php
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
?>
 
         <!-- display user details -->
        <tr id="delete<?php echo $row['userID'] ?>">
            <td><?php print $firstname ?> </td>
            <td><?php print $lastname ?> </td>
            <td><?php print $email ?> </td>
            <td><?php print $contact_number?> </td>
            <td><?php print $access_level ?></td>
            <td><button  onclick = "xoa(<?php echo $row['userID'] ; ?>)" class = "btn btn-danger">Xóa</button></td>
        </tr>
        <?php } ?>
 
    </table>
 <?php 
    $page_url="read_users.php?";
    $total_rows = $user->countAll();
 
    // actual paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no selfies
else{
    ?>
    <div class='alert alert-danger'>
        <strong>No users found.</strong>
    </div>
<?php 
}
?>
<script type="text/javascript">

    function xoa(id){
        if(confirm("Chắn chắn muốn xóa?")){
            $.ajax({
                type: 'post',
                url: 'xoa.php',
                data: {delete_id:id},
                success:function(data){
                    $('#delete'+id).hide();
                    alert (data);
                }

            });
        }

    }
    
</script>