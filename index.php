<?php
// core configuration
// include_once "objects/cuocthi.php";
include_once "config/core.php";
 
// set page title
$page_title="VoteWeb";
 
// include login checker
$require_login=true;
include_once "layout_head.php";
include_once "login_checker.php";
 
// include page header HTML
 
echo "<div class='col-md-12' >";
 
    // to prevent undefined index notice
    $action = isset($_GET['action']) ? $_GET['action'] : "";
 
    // if login was successful
    if($action=='login_success'){
        echo "<div class='alert alert-info'>";
            echo "<strong>Hi " . $_SESSION['firstname'] . ", welcome back!</strong>";
        echo "</div>";
    }
 
    // if user is already logged in, shown when user tries to access the login page
    // else if($action=='already_logged_in'){
    //     echo "<div class='alert alert-info'>";
    //         echo "<strong>You are already logged in.</strong>";
    //     echo "</div>";
    // }
 
    // content once logged in
    // echo "<div class='alert alert-info'>";
    //     echo "Content when logged in will be here. For example, your premium products or services.";
    // echo "</div>";
    $conn = new PDO('mysql:host=localhost;dbname=voteweb', 'root', '');

    $query1="select idCT FROM votect where idUser=".$_SESSION['user_id'];
    $stmt = $conn->prepare($query1);
    $stmt->execute();
    if($stmt->rowCount() > 0){

    $query = "SELECT `idCT`, tenCT FROM `cuocthi` where idCT not like (select idCT FROM votect where idUser=".$_SESSION['user_id'].")";
        
        $stmt = $conn->prepare( $query );
        $stmt->execute();
        $result = $stmt->fetchAll();
        $allCT = $stmt->rowCount();
    }
    else{
        $query = "SELECT `idCT`, tenCT FROM `cuocthi`";
        $stmt = $conn->prepare( $query );
        $stmt->execute();
        $result = $stmt->fetchAll();
        $allCT = $stmt->rowCount();
    }

?>
<div class="row" >
    <div style="width: 200px; margin-top: 0px;" class="col-sm-4"><h2>Bình Chọn</h2>

<?php 
    for($i = 0; $i < $allCT; $i++){
?>

<button id="<?php echo $_SESSION['user_id']; ?>" onclick = "get_idols(<?php echo $result[$i][0]; ?>,<?php echo $_SESSION['user_id']; ?>,'<?php echo $result[$i][1] ?>' )" style="width: 150px; margin: 5px 5px 5px 0px;" id="ok" class="btn btn-primary"><?php echo $result[$i][1] ?></button>

<?php 
    }
?>
    </div>
    <div style="width: 400px;" id="idols" class="col-sm-6"></div>
    <div style="width: 480px;"id="kq" class="col-sm-6"></div>
</div>
<?php
echo "</div>";

// footer HTML and JavaScript codes
include 'layout_foot.php';
?>
<script type="text/javascript">
    function get_idols(idCT, idUser, tenCT){
        $.ajax({
            type :'post',
            url:'objects/getIdols.php',
            data: {idCT:idCT, idUser:idUser, tenCT:tenCT },
            success:function(data){
                $('#idols').html(data);
                alert(data);
            }
        });
    }
</script>