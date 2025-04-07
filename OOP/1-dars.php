<?php
// Object - class ichiga kiradigan va uni xususiyatlaridan andoza oladi 
// Obyekt bu ma'lumotlar (data) va funksiyalar (methods) ni o‘z ichiga olgan, real hayotdagi biror narsaning dasturiy modelidir.
// Oddiy so‘z bilan aytganda:
// Obyekt — bu class asosida yaratilgan real “narsa” bo‘lib, o‘ziga xos xususiyatlari va harakatlari bor.
// Class - sinf, toifa mavhum jismi bo'lmaydi. teminlar jamlanmasi. Misol sutemizuvchilar sinfi class uni ichdagi maymun obyekt
// Property (yoki attribute) - xususiyati. Misol odam klasiniki yoshi, moshina classiniki rangi, maksTezligi,...
// Method - usul, funksiya, vazifasi

class Robot
{
    public $height = "180sm"; // property (xususiyat)

    public function speak()
    { //method - metod
        echo 'Bu robot gapira oladi';
    }
}

$bot1 = new Robot(); // obyekt

echo $bot1->height;
echo '<br/>';
$bot1->speak();
