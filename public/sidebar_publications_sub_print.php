<ul type="square" style="padding-left: 16px">
<?php
$sqlcommand="SELECT * from t_mags_print order by print_name";
$query1=mysqli_query($myConnection, $sqlcommand) or die(mysqli_error($myConnection));

	$line1=mysqli_fetch_array($query1);
	$hr="<hr>";

		do {
				echo "<li> <a target=\"_blank\" href=".$line1['print_url'].">".$line1['print_name']."</a> (".$line1['print_issue'].")</li>";
			}
		while ($line1=mysqli_fetch_array($query1,MYSQLI_ASSOC))
?>

</ul>





