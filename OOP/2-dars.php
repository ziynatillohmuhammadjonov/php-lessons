<?php
//Mavzu:Access modifiers. Encapsulation tamoyili
// Access modifiers bu kirish modifikatorlari klas ichidagi property va methodlarni foydalanish ruxsatlarin belgilash kattaliklari. U 3 ga bo'linadi:
// public - bunda xus. yoki met. hamma yerda obyekt va meros qilingan klasslarda foydalanish mumkin
// protected - bunda xus. yoki met. faqat klasni ichida va u meros olgan klaslarda foydalaniladi
// private - bunda xus yoki met. faqat klassni ichida (e'lon qilingan) foydalaniladi

//Inkapsulyatsiya so'zi lotincha "in capsula" - qobiqda joylashtirish so'zidan olingan. Bu klasni xususiyatlarin tashqaridan foydalanishdan berkitish unga class ichidagi metodlaridan murojaat qilish

class Student
{
    protected $age;

    public function getAge()
    {
        return $this->age;
    }
    public function setAge($age)
    {
        $this->age = $age;
    }
}

$student1 = new Student();

$student1->setAge(18);

echo $student1->getAge();
