<?php
class Animal
{
    public function makeSound()
    {
        return "Some sound";
    }
}
class Dog extends Animal
{
    public function makeSound()
    {
        return "Wow";
    }
}
class Cat extends Animal
{
    public function makeSound()
    {
        return "Meow";
    }
}

// class User
// {
//     static public $count;
//     static public function incrementUser()
//     {
//         self::$count++;
//     }
//     public function setUser($name)
//     {
//         self::incrementUser();
//         return $name;
//     }
// }
// 
interface CarInterface
{
    public function move();
}

class Transport implements CarInterface
{
    public function move()
    {
        return "Car is moving";
    }
}

class Car extends Transport
{
    public function move()
    {
        return parent::move();
    }
}
$car = new Car;
echo ($car->move());
// 
interface Payable
{
    public function pay($amount);
}
class Paypal implements Payable
{
    public function pay($value)
    {
        return $value . " so'm";
    }
}
class Stripe implements Payable
{
    public function pay($value)
    {
        return $value . " so'm";
    }
}
// SOLID
/*
Принцип единственной ответственности (Single responsibility)
«На каждый объект должна быть возложена одна единственная обязанность»
Для этого проверяем, сколько у нас есть причин для изменения класса — если больше одной, то следует разбить данный класс.
Принцип открытости/закрытости (Open-closed)
«Программные сущности должны быть открыты для расширения, но закрыты для модификации»
Для этого представляем наш класс как «чёрный ящик» и смотрим, можем ли в таком случае изменить его поведение.
Принцип подстановки Барбары Лисков (Liskov substitution)
«Объекты в программе могут быть заменены их наследниками без изменения свойств программы»
Для этого проверяем, не усилили ли мы предусловия и не ослабили ли постусловия. Если это произошло — то принцип не соблюдается
Принцип разделения интерфейса (Interface segregation)
«Много специализированных интерфейсов лучше, чем один универсальный»
Проверяем, насколько много интерфейс содержит методов и насколько разные функции накладываются на эти методы, и если необходимо — разбиваем интерфейсы.
Принцип инверсии зависимостей (Dependency Invertion)
«Зависимости должны строится относительно абстракций, а не деталей»
Проверяем, зависят ли классы от каких-то других классов(непосредственно инстанцируют объекты других классов и т.д) и если эта зависимость имеет место, заменяем на зависимость от абстракции.
*/
// S - Single resonsibility - Har bir obyerk faqat bitta vazifani bajarish kerak.
// O - Open-closed - obyektlar kengayishga ochiq lekin o'zgartirishga berk bo'ladi
// L - Liskov substitution - child class parent class’ni to‘liq almashtira olishi kerak, hech qanday buzilish bo‘lmasligi kerak.
class Bird
{
    public function fly() {}
}

class Ostrich extends Bird
{
    public function fly()
    {
        // Ostrich ucha olmaydi, ammo Bird uni uchadi deb kutgan
    }
}
// Bu LSP'ni buzadi
// I - Interface seregration - ko'p maxusu interfeyslar bittasidan yaxshi
// D - Dependency Invertion - bog'liqlik abstraksiya ustiga qurilishi kerak, xusuiyatlar ustiga emas

interface Logger
{
    public function log($error);
}

class FileLogger implements Logger
{
    public function log($err)
    {
        return "FileLoggerdagi error " . $err;
    }
}
class DatabaseLogger implements Logger
{
    public function log($err)
    {
        return "DatabaseLoggerdagi error " . $err;
    }
}

class UserService
{
    private $fileLogger;
    private $databaseLogger;

    public function __construct(FileLogger $filelogger, DatabaseLogger $databaselogger)
    {
        $this->fileLogger = $filelogger;
        $this->databaseLogger = $databaselogger;
    }

    public function setDbLog()
    {
        $this->databaseLogger->log("Some DB log");
    }
    public function setFlLog()
    {
        $this->fileLogger->log("Some File log.");
    }
}
//  Yuqoridan ko'ra qisqasi
class UserServiceCorrect
{
    private Logger $logger;
    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }
    public function logError($error)
    {
        return $this->logger->log($error);
    }
}

// 
trait UUIDGenerator
{
    public function getUUID($value = null)
    {
        if ($value) {
            return uniqid($value, true);
        } else {
            return uniqid();
        }
    }
}

class User
{
    private $userId;
    use UUIDGenerator;

    public function setUserUUID($value)
    {
        $this->userId = $this->getUUID($value);
    }
}
class Product
{
    use UUIDGenerator;
    private $productId;
    public function setProductUUID($value)
    {
        $this->productId = $this->getUUID($value);
    }
}
// 
final class Config
{
    static public $appName = "New App";
    static public $version = "1.0";
}
$config = new Config;
$config::$appName;
$config::$version;
