<?
{
if($_SERVER['REQUEST_METHOD']=='POST')
	{
	$num1 = $_POST['num1'];
	$num2 = $_POST['num2'];
	$operator = $_POST['operator'];
	
	if($operator == "Discount_num")
	echo "$num1 - $num2 = ".($num1-$num2);
	elseif($operator == "Discount_PC")
	echo "$num1 - ($num1*($num2/100)) = ".($num1 - ($num1*($num2/100)));
	$cal = ($num1- ($num1*($num2/100))); 
	}
}
?>
<form name="form1" method="post" action="calcu.php">
<input type="text" name="num1">
<select name="operator">
<option value="Discount_num">Discount_num</option>
<option value="Discount_PC">Discount_PC</option>
</select>
<input type="text" name="num2">
<input type="submit" name="Submit" value="Submit">
</form>
<!--<php echo @$cal?>-->