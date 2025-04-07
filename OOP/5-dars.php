<?php
// Mavzu: Abstraction. Interface. Trait. Namespace.
// Abstraction - bu Abstraksiya (lot. abstractio — ajratish, mavhumlash) bu klasssalrni mavhum qilib undan obyekt chiqarishga ta'qiq qo'yadi. Undan Injeritance qilsa bo'ladi.

abstract class Person
{
    public function getFullInfo()
    {
        echo "Barcha ma'lu,otlar. Person abstrakt classidan";
        echo "<br/>";
    }
    abstract function test(); //buni e'lon qilinishi me'ros olingan klasslarda bo'ladi.
}

class Student extends Person
{
    public function getGroup()
    {
        echo "Student classini shaxsiy  metodi";
        echo "<br/>";
    }

    public function test()
    {
        echo "Abstrakt Preson clasidan abstrakt qilingan test metodi realizatsiyasi";
        echo "<br/>";
    }
}

class Teacher extends Person
{
    public function getProfession()
    {
        echo "Teacher classi shaxsiy metodi";
        echo "<br/>";
    }
    public function test()
    {
        echo "Abstrakt Preson clasidan abstrakt qilingan test metodi realizatsiyasi";
        echo "<br/>";
    }
}
// Interface - faqat abstract bo'lgan metodladan tashkil topgan class. Uni e'lon qilishda interface dan foydalanilib undan me'ros olish implements orqalil amalga oshiriladi. Abstrakt klasslardan farqi undagi hamma metodlar abstract bo'ladi.

interface User
{ // bu yerda hamma metodlar abstract bo'ladi
    public function getUserInfo();
    public function getUserEmail();
    public function getUserAddress();
}

class Customer implements User
{
    public function getUserInfo() {}
    public function getUserEmail() {}
    public function getUserAddress() {}
}

// final - kalit so'zi klassdan oldin qo'llanadi va bu klassdan me'ros olish imkoniyatini bekor qiladi. Bunda eng oxirgi klas shu deb undan boshqa me'ros ola olaysan degani.

final class Abiturient
{ // bu classdan meros olib bo'lmaydi lekin undan obyekt qilsa bo'ladi.
    public function getName() {}
}

// Trait - bu klassga o'xshash lekin undan me'ros olinmaydi. Undan foydalanmoqchi bo'linsa klas ichida `use`  kalit so'zi bilab trait chaqirilib undan foydalansa bo'ladi. U trait kalit so'zi bilan e'lon qilinadi.

trait Weather
{
    public function getWeather()
    {
        echo "Trait ichidagi metod ishladi.";
        echo "<br/>";
    }
}

class Work
{
    use Weather;
    public function getDay()
    {
        echo "Work klasi getDay metodi.";
        echo "<br/>";
    }
}

$workDay = new Work;

$workDay->getWeather();

// Namespace - nom maydoni. Bu turli joylardan import qilayotganda klass interface trait larni afzallik berib. Export qiladigan joy uchun `namespace` kalit so'zi bilan nom belgilab keyin uni required qilgan joyda `use` kalit so'zi bilan olib uni qiymatini o'zgartirish imkonini beradi.

require 'Traits/Device';
require 'Interfaces/Device.php';
require 'Classes/Device.php';

use Traits\Device as DeviceTrait; // Shunday qilib uni nomini istalgancha o'zgartisak bo'ladi.
use Interfaces\Device as DeviceInterface; // lekin bunda qo'shimcha ravishda `namespace` kalit so'zini export qilinayotgan joydan qo'llashimiz kerak
use Classes\Device as DeviceClass;// shu bo'yicha biz uni `use` qilib olib ishlaymiz.
