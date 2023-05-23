<head>
  <title>LAVEMS Proforma Invoice</title>
</head>
<body style="border-style: double;
    border-width: 2px;
    border-left-width: 6px;
    border-right-width: 6px;
    border-top-width: 6px;
    border-bottom-width: 6px;
    border-color: black;">
	<table width="100%" border="0">
    <tr>
      <td style="text-align:right" width="60%"><img src="img/lavems.jpeg" width="130px"  height="130px"></td>
      <td style="text-align:right">Office Suite: Suite 309 DBM Plaza, Wuse 2, Abuja<br/>Tel: 08036576494, 0987675589<br/>Email: littlefingers@rocketmail.com, info@littlefingers.com<br/></td>
</tr>
<tr>
  <td colspan="2" style="text-align:center; font-size:30px;">PROFORMA INVOICE</td>
</tr>
</table>


<div><br/><b>Type of business: {{$nature ?? null}}</b><br/><br/></div>
<table width="100%" border="1" style="border-collapse:collapse; text-align: center">
<tr>
<td width="45%" rowspan="3">Invoice to: NIRSAL MFB/{{$client_name ?? null}}<br/><br/>Address: {{$contact_address ?? null}}<br/><br/></td>
<td rowspan="4"></td>
<td width="45%"></td>
</tr>

<tr>


<td>Invoice Date:  {{$invoice_date ?? null}}</td>
</tr>

<tr>


<td>Invoice Number:  {{$invoice_number ?? null}}</td>
</tr>


<tr>
<td>Tel: {{$phone_number ?? null}}</td>

<td>Customer Ref/Client ID: {{$client_id ?? null}}</td>
</tr>



</table><br/>


<?php
                /* Attempt MySQL server connection. Assuming you are running MySQL
                server with default setting (user 'root' with no password) */


								$i=1;

                $sql2="select  * from invoicing where invoice_no='".$invoice_no."' order by invoice_date desc";



                if($result2 = mysqli_query($link, $sql2)){
                if(mysqli_num_rows($result2) > 0){


					$gtotalz=number_format(($wwhc1+$wwhc2+$wwhc3+$wwhc4+$wwhc41+$wwhc5+$wwhc6+$wwhc7+$wwhc8+$wwhc9+$wwhc91+$wwhcp91+$wwhcp92)+($emge1+$emge2+$emge3+$emge4+$emge41+$emge5+$emge6+$emge7+$emge8+$emge9+$emge91+$emgep91+$emgep92)+($coe1+$coe2+$coe3+$coe4+$coe41+$coe5+$coe6+$coe7+$coe8+$coe9+$coe91+$coep91+$coep92)+($bank1+$bank2+$bank3+$bank4+$bank41+$bank5+$bank6+$bank7+$bank8+$bank9+$bank91+$bankp91+$bankp92),2);

					//$gtotalz2=($wwcv+$emge+$coe);

					echo "<div class='table-wrap mt-40'>";
									echo  "<div class='table-responsive example-print'>";
									echo "<table border='1' align='center' width='100%' style='border-collapse:collapse';>";
									echo "<tr>";
									echo "<th>&nbsp;&nbsp;Item</th>";

									echo "<th>&nbsp;&nbsp;Full description of goods</th>";
                                    echo "<th>&nbsp;&nbsp;Qty</th>";
                                    echo "<th>&nbsp;&nbsp;Unit price</th>";
								    echo "<th>&nbsp;&nbsp;Total</th>";

									echo "</tr>";
									while($row2 = mysqli_fetch_array($result2)){
                         $equip=$row2['equipment'];
                         $qty=$row2['qty'];
                         $cost=$row2['cost'];
                         $invoice_no2=$row2['invoice_no'];
                         $sub=$qty*$cost;
                         $cost2=number_format(($cost),2);
                         $sub2=number_format(($sub),2);

                         $sql3 = "SELECT SUM(qty*cost) as tt FROM invoicing WHERE invoice_no='".$invoice_no2."'";
$result3=mysqli_query($link,$sql3);
$row=mysqli_fetch_assoc($result3);
$tt=$row["tt"];
$tt2=number_format(($tt),2);










										echo "<tr>";
									echo "<td>  &nbsp;&nbsp;" .$i++."</td>";

									echo "<td>  &nbsp;&nbsp;" .$equip."</td>";
                  echo "<td>  &nbsp;&nbsp;" .$qty."</td>";
                  echo "<td>  &nbsp;&nbsp;N" .$cost2."</td>";
                  echo "<td>  &nbsp;&nbsp;N" .$sub2."</td>";

                  echo "</tr>";

								}



					echo "</table>";

echo "<table border='1' width='100%' style='border-collapse:collapse'>";
echo "<tr>";
echo "<td width='80%' style='text-align:right'>Total:</td>";
echo "<td style='color:red'>N$tt2</td>";
 echo "</tr>";
 echo "</table>";

        echo "</div>";
              echo "</div>";
                // Free result set
                mysqli_free_result($result);
                }
                else{
                echo "No records matching your query were found.";
                }
                } else{
                echo "ERROR: Could not able to execute $sql2. " . mysqli_error($link);
                }
                // Close connection

                mysqli_close($link);

                ?>

<?php
class numbertowordconvertsconver {
    function convert_number($number)
    {
        if (($number < 0) || ($number > 999999999))
        {
            throw new Exception("Number is out of range");
        }
        $giga = floor($number / 1000000);
        // Millions (giga)
        $number -= $giga * 1000000;
        $kilo = floor($number / 1000);
        // Thousands (kilo)
        $number -= $kilo * 1000;
        $hecto = floor($number / 100);
        // Hundreds (hecto)
        $number -= $hecto * 100;
        $deca = floor($number / 10);
        // Tens (deca)
        $n = $number % 10;
        // Ones
        $result = "";
        if ($giga)
        {
            $result .= $this->convert_number($giga) .  " Million";
        }
        if ($kilo)
        {
            $result .= (empty($result) ? "" : " ") .$this->convert_number($kilo) . " Thousand";
        }
        if ($hecto)
        {
            $result .= (empty($result) ? "" : " ") .$this->convert_number($hecto) . " Hundred";
        }
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        if ($deca || $n) {
            if (!empty($result))
            {
                $result .= " and ";
            }
            if ($deca < 2)
            {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n)
                {
                    $result .= "-" . $ones[$n];
                }
            }
        }
        if (empty($result))
        {
            $result = "zero";
        }





        return $result;
    }




}
?>

<!-- call the function here -->
<?php
$class_obj = new numbertowordconvertsconver();
//$convert_number = 12345545;
$get_amount=$class_obj->convert_number($tt);
?>


<!-- call the function here -->




<p style="padding-left:30px;"> Amount in words:<i style='border-bottom:dotted; font-size:16px'> <?php echo $get_amount; ?> naira <i></p>

<table width='100%' border='0'>
  <tr>
    <td colspan='2' style='text-align:center; font-weight:bold; font-size:16px'>Bank Account Name: Little Fingers Integrated<br/>Bank: NIRSAL MFB<br/>Account number: 0250265614<br/></td>
</tr>
<tr>
<td colspan="2" style='text-align:center' width="40%"><br/><img src="img/okuma.jpeg" width="100px" height="100px"/><hr style='border-bottom:dotted' width="200px"/></td>

</tr>
<tr>
    <td style='text-align:center' colspan="2">Orkuma Hembe<br/>Managing Director<br/></td>

</tr>
</table>
<footer>
  <br/>

	<p style="text-align:center; font-size:12px">We declare that the above information is true and correct to the best of our knowledge. For and on behalf of the above-named company.
This proforma invoice is valid for 30 days</p>
	<p><i style="font-size:10px">Generated from LAVEMS servers at <?php date_default_timezone_set("Africa/Lagos"); echo date('Y-m-d h:i:sa'); ?></i></p>
</footer>
	</body>
</html>
