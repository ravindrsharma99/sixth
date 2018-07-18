<?php

for($i=1; $i<=5;$i++)
{
for($j=5; $j>=$i;$j--)
{
	echo "*";
}
echo"<br>";
 echo "**"."<br>";
}

?>

<?php

$arr=array(10,6,11,19,25);
$arrrlength= count(array(10,6,11,19,25));
echo $arrrlength;
for($i=0; $i< $arrrlength; $i++)
{
	if($arr[$i]>$arr[$i+1])
	{
		$temp= $arr[$i];
		$arr[i]=$arr[$i+1];
		$arr[$i+1]=$temp;

	}

}
print_r($arr);

?>
<?php

$arr1=array('a'=>'10','b'=>'6','c'=>'11','d'=>'19');
$arr2=array('e'=>'101','f'=>'116','g'=>'111','h'=>'191');
$new_arr=array_merge($arr1,$arr2);
print_r($new_arr);

?>

