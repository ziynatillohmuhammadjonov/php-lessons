<?php
// Mavzu: Ko'p o'lchovli elementlar - massiv elementlari massiv elementidan tashkil topgan bo'lsa ko'p o'lchovli massivlar

$array = ['string', 15, null, true];
$array2 = [[15, 22], ['hello', 'php'], [22, 66]];
echo '<pre>';
print_r($array2);
echo $array2[2][1];
