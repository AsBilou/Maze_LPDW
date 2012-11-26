<!DOCTYPE html>

<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" media="screen" href="style.css">
  <title></title>
</head>
<body>
<table>
<?php
for($i=0;$i<$nbr_cell;$i++){
	if(($i % $x) == 0){
		echo '<tr>';
	}
	echo '<td class="';
	if($_SESSION['maze'][$i]['wall'][0] == 1){
			echo 'border_top ';
	}
	if($_SESSION['maze'][$i]['wall'][1] == 1){
			echo 'border_right ';
	}
	if($_SESSION['maze'][$i]['wall'][2] == 1){
			echo 'border_bottom ';
	}
	if($_SESSION['maze'][$i]['wall'][3] == 1){
			echo 'border_left ';
	}
	echo'"></td>';
	if(($i % $x) == ($x-1)){
		echo '</tr>';
	}
}
?>
</table>
</body>
</html>