<?php
// Mavzu: Massivlar bilan ishlash

// count, array_merge, array_push, array_reverse, array_search, array_shift, array_sum, sort, rsort, compact, end, in_array, range, shuffle

$numbers = [45, 78, 89, 15];
$fruits = ['banana', 'lemon', 'orange'];

// count - massivdagi elementlar sonini hisoblab beradi.
echo count($numbers);

//array_merge - massivlarni bir biriga qo'shib qaytarib berish vazifasini bajaradi.
$result = array_merge($numbers, $fruits);
print_r($result);

//array_push - mavjud massiv oxiriga yangi element qo'shish uchun ishlatiladi
array_push($fruits, 'apple');

// array_reverse - massiv elementlarini teskari tartibda joylashtirib beradi
array_reverse($numbers);
// array_search - massivdan biror elementni topib beradi
echo '<hr/>';
echo array_search('lemon', $fruits); // javob 1 yoki 0 keladi

// array_shift - massivni 1 elementini chiqarib beradi bizga.

// array_sum - massiv elementlarini qo'shib beradi.

// sort - massiv elemntlarini saralab beradi.
// rsort - teskariga saralaydi
// compact - o'zgaruvchidan massiv hosil qilib berish uchun ishlatiladi.
echo '<hr/>';
$name = 'Azizbek';

print_r(compact('name')); // [name] => Azizbek

// end - massivni oxirgi elementini olib beradi.
echo '<hr/>';
echo end($fruits);

// in_array - massiv ichidan element bor yoki yo'qligini tekshirib beradi.
echo '<hr/>';
echo in_array(45, $numbers);

// range - oraliqda massiv yasab uni qaytaradi
echo '<hr/>';
$num = range(1, 20);


// shuffle - massiv elementlar o'rnini aralashtirib beradi.
shuffle($num);
echo '<pre>';
print_r($num);
