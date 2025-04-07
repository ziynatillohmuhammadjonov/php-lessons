<?php
//Mavzu: Inheritance. Magic methods.
// Inheritance (Meros) - ma'lum bir klasni o'zini xususiyat va tamoyillarin boshqa klasga meros sifatida qoldirish. Ajdod klasdan xus. va met. larni avlod klass o'ziga olish.

class Person
{
    public $hand = 2;
    protected $eye = 2;

    public function __construct()
    {
        echo "Bu class o'zlashtirilganda ishga tushadigan metod";
    }

    public function walk()
    {
        echo "Person has been walked";
    }
}
class Student extends Person
{
    public $group = "Web dasturlash";

    public function __construct()
    {
        echo parent::__construct();
        echo '<br/>';
        echo "Bu class obyetga o'zlashtirilganda ishga tushadigan metod";
    }

    public function __invoke()
    {
        echo "Bu class o'zlashtirilgan obyektga funksiya sifatida murojat qilinsa ishlaydi"; //$s1();
    }

    public function __toString()
    {
        return "Bu class o'zlashtirilgan obyektga string sifatida murojat qilnsa ishga tushadi";
    }

    public function teach()
    {
        echo "Student must teach programming";
    }
    public function getParentHand()
    {
        return $this->hand;
    }
}

$s1 = new Student();

$s1(); //invoke ishga tushadi

echo $s1;
