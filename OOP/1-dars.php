<?php
// Object - class ichiga kiradigan va uni xususiyatlaridan andoza oladi
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
