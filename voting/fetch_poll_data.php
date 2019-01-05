<?php
include('database_connection.php');
  $idCT = $_POST['idCT'];
  $idUser = $_POST['idUser'];
  
$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = "SELECT `idIdol` FROM `chitietct` where idCT =".$idCT;
$statement = $connect->prepare($query);
$statement->execute();
$php_framework = $statement->fetchAll();

$total_poll_vote = get_total_vote($connect,$idCT);

$output = '';
if($total_poll_vote > 0)
{
 foreach($php_framework as $row)
 {
  $query1 = "SELECT voteOfIdol FROM chitietct where idIdol=".$row[0]." and idCT=".$idCT;
  $stmt1 = $connect->prepare($query1);
  $stmt1->execute();
  $result1 = $stmt1->fetchAll();
  $single_vote = $result1[0][0] ;

  $percentage_vote = round(($single_vote/$total_poll_vote)*100);
  $progress_bar_class = '';
  if($percentage_vote >= 40)
  {
   $progress_bar_class = 'progress-bar-success';
 }
 else if($percentage_vote >= 25 && $percentage_vote < 40)
 {
   $progress_bar_class = 'progress-bar-info';
 }
 else if($percentage_vote >= 10 && $percentage_vote < 25)
 {
   $progress_bar_class = 'progress-bar-warning';
 }
 else
 {
   $progress_bar_class = 'progress-bar-danger';
 }

 $query2 = "SELECT nghedanh FROM idols where idIdol=".$row[0];
 $stmt2 = $connect->prepare($query2);
 $stmt2->execute();
 $result2 = $stmt2->fetchAll();
 $output .= '
 <div class="row">
 <div class="col-md-2" align="right" >
 <label>'.$result2[0][0].'</label>
 </div>
 <div class="col-md-10">
 <div class="progress">
 <div class="progress-bar '.$progress_bar_class.'" role="progressbar" aria-valuenow="'.$percentage_vote.'" aria-valuemin="0" aria-valuemax="100" style="width:'.$percentage_vote.'%">
 '.$percentage_vote.' % <b>'.$result2[0][0].'</b>
 </div>
 </div>
 </div>
 </div>
 ';
}
}

echo $output;


function get_total_vote( $connect, $idCT )
{
 $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $query = "SELECT `voteOfIdol` FROM `chitietct` where idCT=".$idCT;
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_vote=0;
 foreach ( $result as $item) {
   $total_vote = $total_vote + $item[0];
 }
 return $total_vote;
}

?>