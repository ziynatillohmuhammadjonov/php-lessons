⚙️ Design Pattern turlari:
Dizayn patternlar 3 asosiy guruhga bo‘linadi:

1. Creational	Ob’ektlarni yaratish usullarini boshqaradi
2. Structural	Classlar va ob’ektlar o‘rtasidagi tuzilmani tashkil qiladi
3. Behavioral	Ob’ektlar orasidagi aloqalar va ularning xatti-harakatlarini boshqaradi
# 🔍 1. Singleton Pattern – Nazariyasi
🎯 Maqsad:
Faqat bitta obyekt yaratilsin va u obyektga hamma joyda kirish mumkin bo‘lsin.

💡 Qaerda kerak bo‘ladi?
Database connection

Logger

Configuration file reader

Service locator

📌 Xususiyatlari:
Constructor private bo‘ladi – tashqaridan new qilib bo‘lmaydi.

getInstance() metodi orqali bitta instansiya qaytariladi.

Class ichida static $instance o‘zgaruvchisi bo‘ladi.

```php
class Logger {
    private static $instance;
    
    // 1. Constructor private bo'lishi kerak
    private function __construct() {}

    // 2. Faqat bitta instansiya qaytaradi
    public static function getInstance(): Logger {
        if (!self::$instance) {
            self::$instance = new Logger();
        }
        return self::$instance;
    }

    // 3. Oddiy metod
    public function log($msg) {
        echo "[LOG]: $msg\n";
    }
}

// Foydalanish
$logger1 = Logger::getInstance();
$logger2 = Logger::getInstance();

$logger1->log("Bir xil obyekt ishlatilayapti");
var_dump($logger1 === $logger2); // true
```
✅ Mini Topshiriq: Database class Singleton qilib yoz
Vazifa: Quyidagi shartlarga asoslanib Database class yarat:

connect() metodi bo‘lsin

Har chaqirilganda bitta obyekt ishlasin

getInstance() orqali ishlasin
```php
// Mana shu qatorni davom ettiring:

class Database {
    // 1. static $instance
    private static $instance;

    // 2. Constructor private bo'lishi kerak — yozilishda xatolik bor
    private function __construct() {}

    // 3. public static getInstance() — bu orqali faqat bitta obyekt yaratiladi
    public static function getInstance(): Database {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // 4. Oddiy connect metodi
    public function connect(): string {
        return "Connected to DB";
    }
}
// foydalanish
$db1 = Database::getInstance();
echo $db1->connect(); // Connected to DB

$db2 = Database::getInstance();
var_dump($db1 === $db2); // true

```

