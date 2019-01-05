<?php

//poll.php
include('database_connection.php');

list($idIdol, $idUser, $idCT) = explode(" ",$_POST["poll_option"]);

$query0 = " SELECT * FROM votect where idCT = ".$idCT." and idUser = ".$idUser;
$stmt = $connect->prepare($query0);
$stmt->execute();
$total_row = $stmt->rowCount();

$query1 = "SELECT ketthuc from cuocthi where idCT = ".$idCT; 
$stmt = $connect->prepare($query1);
$stmt->execute();
$result = $stmt->fetchAll();
if(isset($_POST["poll_option"]) && $total_row < 1 && $result[0][0] < date('Y-m-d H:i:s'))
{
	// UPDATE chitietct set voteOfIdol = voteOfIdol + 1 where idIdol = :idIdol and idCT = 1;
 $query = "
 	UPDATE chitietct set voteOfIdol = voteOfIdol + 1 where idIdol = ".$idIdol." and idCT = ".$idCT.";
 	INSERT INTO votect (idCT, idUser, idIdol, dateVoteCT) VALUES (".$idCT." , ".$idUser." , ".$idIdol.",now())";

 $statement = $connect->prepare($query);
 $statement->execute();
 
 echo " VOTE thành công";
}
else{
 	echo "Thất bại, có thể vì quá hạn VOTE hoặc bạn đã dùng hết lượt VOTE";
}
?>