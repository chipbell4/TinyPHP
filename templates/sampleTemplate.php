<?php
echo "Printing $n Fibonacci numbers</br>";

echo "<ul>";
$a = 0;
$b = 1;
for($i=0; $i<$n; $i++)
{
	echo "<li>$a</li>";
	$c = $a + $b;
	$a = $b;
	$b = $c;
}
echo "</ul>";

?>
