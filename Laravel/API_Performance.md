# 📘 API Optimallashtirish Qo'llanmasi (.md)


## 🚀 1. Sahifalash (Pagination)
**Maqsadi:** Katta ma'lumotlar ro'yxatini kichik qismlarga bo'lib, server yukini kamaytirish va tez javob qaytarish.

```php
// Laravel sahifalash namunasi
$users = User::paginate(10);
return response()->json($users);
```

**Foydasi:**
- Tezroq javob
- Yaxshilangan foydalanuvchi interfeysi

---

## 🧾 2. Asinxron loglash (Async Logging)
**Maqsadi:** Log yozish jarayonining foydalanuvchiga javob qaytarishga to‘sqinlik qilmasligi.

```php
// Loggingni queue orqali bajarish
LogJob::dispatch($data); // Navbatga yuboriladi va fon rejimida bajariladi
```

**Foydasi:**
- Javob tezligi oshadi
- Loglar foydalanuvchini kutib qo‘ymaydi

---

## ⚡ 3. Kesh (Caching)
**Maqsadi:** Tez-tez kerak bo‘ladigan ma’lumotlarni xotirada saqlab, so‘rovlarni tezlashtirish.

```php
$posts = Cache::remember('posts', 60, function() {
    return Post::all();
});
```

**Turlari:**
- Sahifa kesh
- Yo'nalish (route) kesh
- So'rov (query) kesh

---

## 📦 4. Ma’lumot siqish (Payload Compression)
**Maqsadi:** JSON yoki boshqa formatdagi ma’lumotlar hajmini kamaytirish.

**Server tomoni:**
- `gzip` middleware ishlatish
- Nginx yoki Apache sozlamalari orqali

**Foydalanuvchi tomoni:**
- `Accept-Encoding: gzip` header yuborish

**Foydasi:**
- Kichik hajmli ma'lumot
- Tez yetkazib berish

---

## 🔗 5. Ulanish havzalari (Connection Pooling)
**Maqsadi:** Ma'lumotlar bazasi va tashqi API lar bilan samarali ishlash uchun mavjud aloqalarni qayta ishlatish.

**Laravel + MySQL:**
Laravel avtomatik ravishda persistent (doimiy) aloqalarni boshqaradi.

---

## 🚫 6. Cheklash (Rate Limiting)
**Maqsadi:** Bitta foydalanuvchining ortiqcha so‘rov yuborishining oldini olish.

```php
Route::middleware('throttle:60,1')->group(function () {
    Route::get('/api/data', [ApiController::class, 'index']);
});
```

---

## 🧠 7. Eager Loading (Oldindan yuklash)
**Maqsadi:** "N+1" muammosidan saqlanish (ko‘p so‘rov yuborishni oldini olish).

```php
$posts = Post::with('user')->get();
```

---

## 🧮 8. So‘rovlarni optimallashtirish (Query Optimization)
**Maqsadi:** Faqat kerakli ustunlarni olish va indekslardan foydalanish.

```php
User::select('id', 'name')->where('status', 'active')->get();
```

---

## 🔍 9. Ma'lumotlar bazasida indekslash (Indexing)
**Maqsadi:** Qidiruvlar tezligini oshirish.

```sql
CREATE INDEX idx_email ON users(email);
```

---

## 🕒 10. HTTP kesh headerlari (HTTP Cache Headers)
**Maqsadi:** Brauzer va server orasida bir xil ma’lumotlarni qayta yuborishning oldini olish.

✅ **Bu funksiya kontrollerdagi javobda (response) qo‘shiladi.**

```php
return response($data)
    ->header('Cache-Control', 'max-age=3600')
    ->header('ETag', md5($data));
```

**Tushuntirish:**
- `Cache-Control`: qancha vaqtga keshlansin (bu yerda 3600 soniya = 1 soat)
- `ETag`: agar ma’lumot o‘zgarmagan bo‘lsa, qayta yuborilmaydi

**Foydasi:**
- Traffikni kamaytiradi
- Javob tezligini oshiradi
- Brauzerda saqlanadi

---

## 🔄 11. API versiyalash (Versioning)
**Maqsadi:** Eski mijozlar uchun API ishlashini saqlab qolish.

```
/api/v1/posts
/api/v2/posts
```

---

## 🎯 12. Asinxron navbatlar (Async Queues)
**Maqsadi:** Og‘ir ishlarni orqa fonda bajarish (masalan, email, pdf yaratish).

```php
SendEmailJob::dispatch($user);
```

---

## 🌍 13. CDN ishlatish
**Maqsadi:** Statik fayllarni (rasmlar, scriptlar) dunyo bo‘ylab tez yetkazish.

```
https://cdn.example.com/images/logo.png
```

---

## ⚖️ 14. Yukni taqsimlash (Load Balancing)
**Maqsadi:** So‘rovlarni bir nechta serverga taqsimlab, tizimni barqaror qilish.

**Vositalar:**
- Nginx
- HAProxy
- Cloud Load Balancers

---

## 🔐 15. Xavfsizlik va Token autentifikatsiya
**Maqsadi:** Tez va ishonchli API autentifikatsiyasi.

**Vositalar:**
- JWT (yengil va stateless)
- Laravel Passport
- Laravel Sanctum

```php
// Sanctumdan foydalanish
$user = Auth::user();
```

---

## 📊 Monitoring va Performance analiz
**Maqsadi:** API ishlashini real vaqtda kuzatish.

**Vositalar:**
- Laravel Telescope
- New Relic
- Sentry
- Blackfire.io

---

## ✅ Yakuniy jadval

| Usul                  | Maqsadi                                              |
|------------------------|-------------------------------------------------------|
| Sahifalash             | Katta ma’lumotlarni boshqarish                       |
| Asinxron loglash       | Javobni sekinlashtirmaslik uchun loglarni kechiktirish |
| Kesh                   | Qayta ishlatiladigan ma’lumotlarni tez yetkazish    |
| Ma’lumot siqish        | Internetda kam trafik sarflash                      |
| Ulanish havzalari      | Samarali aloqalarni boshqarish                      |
| Cheklash               | Suiste’molning oldini olish                         |
| Eager Loading          | N+1 muammosidan qochish                             |
| So‘rovni optimallashtirish | Tezroq va yengil so‘rovlar                     |
| Indekslash             | Tezkor qidiruvlar                                    |
| HTTP kesh headerlari   | Javoblar keshda saqlanadi                            |
| API versiyalash        | API ni ishonchli va yangilanishga tayyor qilish     |
| Queue                  | Og‘ir vazifalarni orqa fonda bajarish               |
| CDN                    | Statik fayllarni tez yetkazib berish                |
| Load Balancing         | Katta trafikda tizim barqarorligi                   |
| Token Auth (JWT)       | Tez va xavfsiz autentifikatsiya                     |

---

_Bu `.md` hujjat Laravel/NodeJS/Express/Next.js/React Native API arxitekturasi uchun ideal._

