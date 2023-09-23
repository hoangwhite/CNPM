<?php 
	$str1 = "abc, acb, asc";
	$str = explode( ',', $str1 );
	$max=count($str);
	for($i=0; $i<$max; $i++)
	{
		echo $str[$i]."<br />" ;
	}
	