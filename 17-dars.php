<?php
// Mavzu: 'string' uchun funksiyalar

// ucwords, ucfirst, substr, strtoupper, strtolower, strlen, str_repeat, str_replace, implode, explode, strpos

$str = "web dasturlash";
//ucwords - hamma so'zlarini boshlanishini bosh harfga o'girib beradi.
echo ucwords($str); // Web Dasturlash
// ucfirst - faqat birinchi harfini o'tkazadi
echo ucfirst($str); // Web dasturlash

// substr - string ma'lumotni berilgan pozitsiyadan qolganini qaytaradi
echo substr($str, 5); // agar - bilan berilsa orqadan sanab qaytaradi. Agar uchinchi qiymat ham berilsa berilgan pozitsiyadan so'ng nechta belgi olishini ko'rsatiladi.

//strtoupper - hammasini bosh harflarga o'tkazib beradi
//strtolower - hammasini kichik harflarga o'tkazib beradi
//strlen - berilgan stringni uzunligini qaytarib beradi
//str_repeat - berilgan string ma'lumotini bir necha marotaba ekranga chiqarib berishini ta'minlaydi str_repeat($str, 4)
// str_replace - birinchi argumentni topib uni ikkinchi argument bilan o'zgartirib bu o'zgarishni qaysi o'zgaruvchida qilinishi kerakligini (3-argument) ko'rsatib. Shu asosda stringni ichini o'zgartirib qaytaradi.
echo str_replace('das', 'PHP', $str);
// implode - massivdan string ma'lumotga o'girib beradi
echo '<hr/>';
$arr = ['php', 'web', 'js'];
echo implode(', ', $arr);
$newArr = implode(', ', $arr);
// explode - stringdan massivga o'tkazib beradi
echo '<hr/>';
print_r(explode(', ', $newArr));

// strpos - qiymat joylashgan o'rnini ko'rsatadi
echo '<hr/>';
echo strpos($str, 'dasturlash');
