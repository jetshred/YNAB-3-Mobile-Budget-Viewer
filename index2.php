!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;"/>
<title>YNAB Budget</title>
</head>
<body style="color:#333;font-size:13px;font-family:sans-serif;margin:0;background-color:#fff" >
<?php
echo "<div style=\"font-size:140%;padding:3px\">",date('F'), " Budget
</div>";
function convertToInt($string) {
$y = str_replace('$','',$string);
$z = 0 + $y;
return $z;
}
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
$nbalance = convertToInt($balance);
 
if ($month == date('F Y') && $budgeted != "$0.00") {
$percent = $noutflows / $nbudgeted * 100;
$otherpercent = 100 - $percent;
 
if ($nbalance >= 0){
echo "
<hr size=\"1\" noshade='noshade' color=\"#999\" style=\"width:100%;height:1px;margin:2px 0;padding:0;color:#999;background:#999;border:none;\" />
<strong>$category</strong>
<div>
<table width=\"100%\" >
<tr valign=\"top\">
<td style=\"font-size:0px\" width=\"50\">
<img src=\"http://chart.apis.google.com/chart?cht=p&chd=t:$otherpercent,$percent&chs=90x90&chco=00FF00|FF0000\" alt=\"Pie Graph\" width=\"50\" height=\"50\" style=\"border:0;margin:0px;\" />
</td>
 
<td style=\"width:100%;font-size:13px;padding-left:2px\">
<div style=\"font-size:140%;padding-bottom:1px;margin-top:10px\" >
<strong>$balance left</strong>
</div>
<div style=\"color:#333;font-size:80%\">$budgeted budgeted - $outflows spent</div>
</td>
</tr>
</table>
<hr size=\"1\" noshade='noshade' color=\"#999\" style=\"width:100%;height:1px;margin:2px 0;padding:0;color:#999;background:#999;border:none;\" />
 
 
</div>
<hr size=\"1\" noshade='noshade' color=\"#ffffff\" style=\"width:100%;height:7px;margin:2px 0;padding:0;color:#999;background:#fff;border:none;\" />
\n";
}
else {
echo "
<div
style=\"border-top:0px solid #999;background:red;color:white\">
<hr size=\"1\" noshade='noshade' color=\"#999\" style=\"width:100%;height:1px;margin:2px 0;padding:0;color:#999;background:#999;border:none;\" />
<strong>$category</strong>
<div>
<table width=\"100%\" >
<tr valign=\"top\">
<td style=\"font-size:0px\" width=\"50\">
<img src=\"http://chart.apis.google.com/chart?cht=p&chd=t:0,100&chs=90x90&chco=00FF00|FF0000&chf=bg,s,65432100\" alt=\"Pie Graph\" width=\"50\" height=\"50\" style=\"border:0;margin:0px;\" />
</td>
 
<td style=\"width:100%;font-size:13px;padding-left:2px;color:white;\">
<div style=\"font-size:140%;padding-bottom:1px;margin-top:10px\" >
<strong>$balance left</strong>
</div>
<div style=\"color:#333;font-size:80%;color:white;\">$budgeted budgeted - $outflows spent</div>
</td>
</tr>
</table>
<hr size=\"1\" noshade='noshade' color=\"#999\" style=\"width:100%;height:1px;margin:2px 0;padding:0;color:#999;background:#999;border:none;\" />
 
 
</div>
</div>
<hr size=\"1\" noshade='noshade' color=\"#ffffff\" style=\"width:100%;height:7px;margin:2px 0;padding:0;color:#999;background:#fff;border:none;\" />
\n";
 
}
}
 
}
echo "\n";
?>
 
 
<div
style="border-top:1px solid #999;font-size:80%;background:#EEE;text-align:center">
<br/>
<div>created by <a href="mailto:jetshred@gmail.com">jetshred</a></div>
 
<br/>
</div>
</body>
</html>