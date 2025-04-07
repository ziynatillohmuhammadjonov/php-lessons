<?php
//Mavzu: Polymorphism.
//Polymorphism  (poli... ko'p va yun. morphe — shakl)  – bu obyektga bog‘liq holda metodlarning har xil bajarilishi yoki bir xil metod nomi bilan turli klasslarda turlicha vazifani bajarish qobiliyatidir. Bu OOPda meros olish (inheritance) va metodlarni qayta yozish (method overriding) orqali amalga oshiriladi.

class Users
{
    public function getUsers()
    {
        return [
            [
                "name" => "Alex",
                "email" => "alex@alex.com",
            ],
            [
                "name" => "Abdurauf",
                "email" => "abdurauf@alex.com",
            ],
            [
                "name" => "Jamshid",
                "email" => "jamshid@alex.com",
            ],
            [
                "name" => "Nodirbek",
                "email" => "noodirbek@alex.com",
            ],
        ];
    }
}

class Notification extends Users
{
    public function notify($service)
    {
        foreach ($this->getUsers() as $user) {
            $service->send($user); // Bu yerda send metodi turli xil klasslarda turlicha namoyon bo'ladi.
            echo '<br/>';
        }
    }
}

class Email extends Validation
{
    public function send($user)
    {
        if ($this->emailCheck($user['email']) && $this->nameCheck($user['name']))
            echo  $user['name'] . " ismli foydalanuvchini " . $user['email'] . " emailga xabar yuborildi.";
    }
}
class SMS extends Validation
{
    public function send($user)
    {
        if ($this->nameCheck('name')) {
            echo $user['name'] . " ismli foydalanuvchiniga xabar yuborildi";
        }
    }
}

class Validation
{
    public function emailCheck($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
    }
    public function nameCheck($name)
    {
        if (!empty($name)) {
            return true;
        }
    }
}

$notify = new Notification();

$notify->notify(new Email);
