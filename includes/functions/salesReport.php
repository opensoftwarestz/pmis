<?php
function salesReport($category,$type,$from,$to,$itemId,$batch,$branch_id)
{
if ($itemId=="all" and $batch=="all")
$results=mysql_query("select * from sales where type='$type' and date between '$from' AND '$to' and branch_id='$branch_id'") or die(mysql_error());
else if($itemId=="all" and $batch!="all")
$results=mysql_query("select * from sales where type='$type' and  date between '$from' AND '$to' and batchNumber='$batch' and branch_id='$branch_id'") or die(mysql_error());
else if($itemId!="all" and $batch=="all")
$results=mysql_query("select * from sales where type='$type' and  date between '$from' AND '$to' and itemId='$itemId' and branch_id='$branch_id'") or die(mysql_error());
else if($itemId!="all" and $batch!="all")
$results=mysql_query("select * from sales where type='$type' and date between '$from' AND '$to' and batchNumber='$batch' and itemId='$itemId' and branch_id='$branch_id'") or die(mysql_error());

if ($type=="whole")
{
if (mysql_num_rows($results)==0)
echo "<center><b>Hakuna Ripoti</b></center>";
else
{
if($category=="report")
echo '<table><tr><td colspan="6" align="center">Compressed View<input type="radio" name="view" value="compress" onClick="changeView(this.value)"> Expanded View<input type="radio" name="view" value="expand" checked onClick="changeView(this.value)"></td></tr></table>';

echo "<table><tr><td valign='top'><table><tr><td colspan='8' align='center'><b>Ripoti Ya Mauzo</b></td></tr><tr style='background-color:#515151;color:white;font-family:Georgia, Times New Roman, Times, serif;font-weight:bold;font-size:13;'>";
if($category=="delete")
echo "<th>&nbsp;</th>";
echo "<th>SN</th><th>Jina La Bidhaa</th><th>Idadi</th><th>Tarehe Ya Mauzo</th><th>Bei Ya Kununulia Kwa Piece</th><th>Bei Ya Kuuzia Kwa Piece</th><th>Jumla Ya Mauzo</th><th>Faida</th></tr>";
$counter=1;
while ($row=mysql_fetch_array($results))
{
$remainder=$count%2;
if ($remainder==0)
$bgcolor='background-color:#A5E5E5;font-family:Geneva, Arial, Helvetica, sans-serif;';
else
$bgcolor='background-color:#E5E5E5;font-family:Geneva, Arial, Helvetica, sans-serif';
$count++;
list($itemname)=mysql_fetch_array(mysql_query("select name from items where id='$row[itemId]'"));
list($bprice)=mysql_fetch_array(mysql_query("select buying_price from wholeStock where id='$row[batchNumber]'"));
$margin=($row["price"]*$row["quantity"])-($bprice*$row["quantity"]);
$totalMargin=$margin+$totalMargin;
$margin=number_format($margin);
$bprice=number_format($bprice);
$totalSale=$totalSale+$row["price"]*$row["quantity"];
$sprice=number_format($row["price"]);
$date = date_create($row["date"]);
$date=date_format($date,"jS F Y");
echo "<tr style='$bgcolor' onmouseover='color=this.style.background;this.style.background=\"gold\";' onmouseout='this.style.background=color'>";

$id=$row["id"];
if($category=="delete")
echo "<td><a href='#' onclick='delete_this($id,\"whole\")'><img src='images/delete.png'>Delete</a></td>";

echo "<td>$counter</td><td align='center'>$itemname</td><td align='center'>$row[quantity]</td><td>$date</td><td align='center'>$bprice</td><td align='center'>$sprice</td><td>".number_format($row["price"]*$row["quantity"])."<td align='center'>$margin</td></tr>";
$counter++;
}
$_SESSION["total_whole_margin"]=$totalMargin;
$totalMargin=number_format($totalMargin);
$_SESSION["total_whole_sale"]=$totalSale;
$totalSale=number_format($totalSale);
echo "<tr style='background-color:#515151;color:white;font-family:Georgia, Times New Roman, Times, serif;font-weight:bold;font-size:15;border-color:black'><td colspan='4' align='left'><b>Jumla Ya Mauzo Yote=$totalSale</b></td><td colspan='4' align='right'><b>Faida Jumla=$totalMargin</b></td></tr></table></td>";
$totalMargin=0;
$margin=0;
$totalSale=0;
}
}

else if($type=="retail")
{
echo "<td valign='top'><table><tr><td colspan='8' align='center'><b>Ripoti Ya Mauzo Ya Rejareja</b></td></tr><tr style='background-color:#515151;color:white;font-family:Georgia, Times New Roman, Times, serif;font-weight:bold;font-size:13;'>";
if($category=="delete")
echo "<th>&nbsp;</th>";

echo "<th>SN</th><th>Jina La Bidhaa</th><th>Idadi</th><th>Tarehe Ya Mauzo</th><th>Bei Ya Kununulia Kwa Unit</th><th>Bei Ya Kuuzia Unit</th><th>Jumla Ya Mauzo</th><th>Faida</th></tr>";
$counter=1;
while ($row=mysql_fetch_array($results))
{
$remainder=$count%2;
if ($remainder==0)
$bgcolor='background-color:#A5E5E5;font-family:Geneva, Arial, Helvetica, sans-serif;';
else
$bgcolor='background-color:#E5E5E5;font-family:Geneva, Arial, Helvetica, sans-serif';
$count++;
list($itemname,$total_units)=mysql_fetch_array(mysql_query("select name,total_units from items where id='$row[itemId]'"));
list($bprice)=mysql_fetch_array(mysql_query("select buyingPrice from retailStock where batch_number='$row[batchNumber]' and branch_id='$branch_id'"));
$margin=$row["price"]*$row["quantity"]-($bprice/$total_units)*$row["quantity"];
$totalMargin=$margin+$totalMargin;
$margin=number_format($margin);
$bprice=number_format($bprice/$total_units);
$totalSale=$totalSale+$row["price"]*$row["quantity"];
$sprice=number_format($row["price"]);
$date = date_create($row["date"]);
$date=date_format($date,"jS F Y");
echo "<tr style='$bgcolor' onmouseover='color=this.style.background;this.style.background=\"gold\";' onmouseout='this.style.background=color'>";

$id=$row["id"];
if($category=="delete")
echo "<td><a href='#' onclick='delete_this($id,\"retail\")'><img src='images/delete.png'>Delete</a></td>";

echo "<td>$counter</td><td align='center'>$itemname</td><td align='center'>$row[quantity]</td><td align='center'>$date</td><td align='center'>$bprice</td><td align='center'>$sprice</td><td>".number_format($row["price"]*$row["quantity"])."</td><td align='center'>$margin</td></tr>";
$counter++;
}
$_SESSION["total_retail_margin"]=$totalMargin;
$totalMargin=number_format($totalMargin);
$_SESSION["total_retail_sale"]=$totalSale;
$totalSale=number_format($totalSale);
echo "<tr style='background-color:#515151;color:white;font-family:Georgia, Times New Roman, Times, serif;font-weight:bold;font-size:15;border-color:black'><td colspan='4' align='left'><b>Jumla Ya Mauzo Yote=$totalSale</b></td><td colspan='4' align='right'><b>Faida Jumla=$totalMargin</b></td></tr></table></td></tr></table>";

//Calculating Expenditures
$results=mysql_query("select amount from dailyExpenditures where date between '$from' and '$to'") or die(mysql_error());
while ($row=mysql_fetch_array($results))
{
$_SESSION["total_expenditures"]=$_SESSION["total_expenditures"]+$row["amount"];
}

$results=mysql_query("select amount,paid from credits where date_credited between '$from' and '$to' and status='notCleared'");
while($row=mysql_fetch_array($results)) {
	$_SESSION["total_credits"]=$_SESSION["total_credits"]+$row["amount"]-$row["paid"];
	}
	
	$from_date=date("Y-n-d",strtotime($from));
	$from_date=explode("-",$from_date);
	$from_month=$from_date[1];
	$from_year=$from_date[0];
	
	$to_date=date("Y-n-d",strtotime($to));
	$to_date=explode("-",$to_date);
	$to_month=$to_date[1];
	$to_year=$to_date[0];
	
	$results=mysql_query("select basic_salary,amount_deducted from salary_payments where salary_month between '$from_month' and '$to_month' and salary_year between '$from_year' and '$to_year'");
	while($row=mysql_fetch_array($results)) {
		$_SESSION["total_salary"]=$_SESSION["total_salary"]+($row["basic_salary"]-$row["amount_deducted"]);
		}
}
}
?>