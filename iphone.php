<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="yes" name="apple-mobile-web-app-capable" />
<meta content="index,follow" name="robots" />
<meta content="text/html; charset=iso-8859-1" http-equiv="Content-Type" />
<link href="pics/appletouchicon.png" rel="apple-touch-icon" />
<meta content="minimum-scale=1.0, width=device-width, maximum-scale=0.6667, user-scalable=no" name="viewport" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="javascript/functions.js" type="text/javascript"></script>
<title>Family Budget</title>
</head>

<body class="list">

<div id="topbar">
	<div id="leftnav">
		<!-- <a href="index.php"><img alt="home" src="images/home.png" /></a> --></div>
	<div id="rightnav">
		<!-- <a href="">n/a</a> -->
	</div>
		<?php
		echo "<div id=\"title\">",date('F'), " Budget</div>
	</div>
	<div id=\"content\">
		<ul>";
		function convertToInt($string) {
		    $y = str_replace('$','',$string);
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
			$mastercat=$data[2];
			$subcat=$data[3];
			$budgeted=$data[4];
			$outflows=$data[5];
			$balance=$data[6];

		$nbudgeted = convertToInt($budgeted);
		$noutflows = convertToInt($outflows);
		$nbalance = convertToInt($balance);

		if ($month == date('F Y') && $budgeted != "$0.00" && $mastercat != "Hidden Categories") {
			$percent = $noutflows / $nbudgeted * 100;
			$otherpercent = 100 - $percent;
			echo "<li class=\"title\">$category</li>";
				if ($nbalance >= 0){
					echo "
					<li class=\"withimage\">
					<a class=\"noeffect\" href=\"\">
					<img alt=\"test\" src=\"http://chart.apis.google.com/chart?cht=p&chd=t:$otherpercent,$percent&chs=170x170&chco=00FF00|FF0000\" /><span class=\"name\">
					$balance remaining       
					</span><span class=\"comment\">$budgeted budgeted - $outflows spent</span></a></li>
					\n";
					}
				else {
					echo "
					<li class=\"withimage2\">
					<a class=\"noeffect\" href=\"\">
					<img alt=\"test\" src=\"http://chart.apis.google.com/chart?cht=p&chd=t:0,100&chs=170x170&chco=00FF00|FF0000&chf=bg,s,65432100\" /><span class=\"name\">
					$balance remaining       
					</span><span class=\"comment\">$budgeted budgeted - $outflows spent</span></a></li>
					\n";
					
				}
			}
		
	}
		echo "</table>\n";
		?>
		
		
</div>
<div id="footer">
	Made by <a href="mailto:jetshred@gmail.com">jetshred</a>
	</div>

</body>

</html>
