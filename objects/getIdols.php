<?php
	$conn = new PDO('mysql:host=localhost;dbname=voteweb', 'root', '');

	$idCT = $_POST['idCT'];
	$idUser = $_POST['idUser'];
	$tenCT = $_POST['tenCT'];
	$query = "SELECT idIdol, nghedanhIdol From chitietct where idCT =".$idCT;
	$stmt = $conn->prepare( $query );
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo "<h2 align='center'> $tenCT </h2><br />";
?>
	<form method="post" id="poll_form"></form>
    for($i = 0; $i < $stmt->rowCount(); $i++){
?>
<div class="alert alert-info">
	<img src="voting/image/<?php echo $result[$i][1].'_'.$result[$i][0]; ?>.jpg" height="150" width = auto >
	<label><h4><input type="radio" name="poll_option" class="poll_option" value=<?php echo $result[$i][0]; ?> /><?php echo $result[$i][1]; ?></h4></label>
</div>

<?php 
	}
?>