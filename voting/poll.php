<?php

//poll.php
include('database_connection.php');
include('../index.php');
$query0 = " SELECT * FROM votect where idCT = 1 and idUser = ".$_SESSION['user_id'];
$stmt = $connect->prepare($query0);
$stmt->execute();
$total_row = $stmt->rowCount();

if(isset($_POST["poll_option"]) && $total_row < 1)
{
	// UPDATE chitietct set voteOfIdol = voteOfIdol + 1 where idIdol = :idIdol and idCT = 1;
 $query = "
 	UPDATE chitietct set voteOfIdol = voteOfIdol + 1 where idIdol = :idIdol and idCT = 1;
 	INSERT INTO votect (idCT, idUser, idIdol, dateVoteCT) VALUES (1,".$_SESSION['user_id'].",:idIdol,now())";

 $data = array(
  ':idIdol'  => $_POST["poll_option"]
 );
 $statement = $connect->prepare($query);
 $statement->execute($data);
 
 $m = array('ok' => "VOTE thành công" );
 echo json_encode($m);
}
else{
	 $m = array('ok' => "VOTE thành công" );
 	echo json_encode($m);
	}


?>