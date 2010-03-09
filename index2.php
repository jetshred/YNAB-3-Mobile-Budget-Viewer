<html>
<head>
	<link media="screen" type="text/css" href="/style.css" rel="stylesheet">
<body>
<?php
function convertToInt($string) {
    $y = ltrim($string, '$');
    $z = 0 + $y;
    return $z;
}
echo "<table>";
$handle = fopen("MyBudget-Budget.csv", "r");
$data = fgetcsv($handle, 1000, ",");
# data rows:
while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
{

$month=$data[0];
$category=$data[1];
$budgeted=$data[2];
$outflows=$data[3];
$balance=$data[4];

$nbudgeted = convertToInt($budgeted);
$noutflows = convertToInt($outflows);

if ($month == "March 2010" && $budgeted != "$0.00") {
	$percent = $noutflows / $nbudgeted * 100;
	if ($percent <= "80"){
	echo "<tr>";
	echo "<td>$category<br /><span class=\"small\">$budgeted - $outflows = <strong>$balance</strong></span></td></tr><tr><td><div class=\"progress-container\">";          
	echo "<div style=\"width: ", $percent, "%\"></div>";
	echo "</div>";
	echo "</tr><tr><td><hr></td></tr>\n";}
	else {
		echo "<tr>";
		echo "<td>$category<br />$budgeted - $outflows = $balance</td></tr><tr><td><div class=\"progress-container-bad\">";          
		echo "<div style=\"width: ", $percent, "%\"></div>";
		echo "</div>";
		echo "</tr><tr><td><hr></td></tr>";
		}
	}

};
echo "</table>\n";
?>

</body>
</html>




