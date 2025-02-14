<?php
/*
- Ma'lumot tiplari:
1. Integer - butun sonlarni o'z ichiga oladi
2. String - belgilarni o'z ichiga oladi
3. Boolean - mantiqiy tip, true va false ni o'z ichiga oladi
4. Array - to'plamlarni o'z ichiga oladi
5. Null - null qiymatini o'z ichiga oladi
6. Object - obyektlar kiradi
7. Float - butun bo'lmagan sonlar
*/
$number = 45;
$str = "PHP dasturlash tili";
$bool = false;
$array = ['bir', 2, false];
$null = NULL;
$float = 18.45;

var_dump($float); //ma'lumot turini aniqlab beradi

settype($number, 'string'); // ma'lumot turini o'zgartiruvchi funksiya

var_dump($number);

gettype($number); // var_dump kabi o'zgaruvchi turini olib beradi.
