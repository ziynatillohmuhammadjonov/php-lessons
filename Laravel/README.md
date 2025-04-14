# 1-dars
- MVC - Model View Controller -  bunda serverga kelgan so'rov dastlab kontrollerga yuborildi. U yerda kontroller so'rovni Modelga yuboradi. Model esa unga mos javobni olib uni yana Kontrollerga qaytaradi. Shunda Kontroller kelgan javobi foydalanuvchiga qulay bo'lishi uchun uni View bilan foydalanuvchiga qaytaradi.
- Laravelni composer orqali o'rnatish `composer create-project laravel/laravel ./` orqali joriy papkaga Laravel o'rnatiladi.
- Route - bu mijozdan keladigan so'rovlar manzili url. Uni e'lon qilinishi routes/web.php fayli ichida bo'ladi. 
- Route::metod() - orqali routlar e'ln qilinadi.
- Route::get('/usere/{id}', function($id){
    return view('home', compact('id'));
) orqali routlar mos manzilgan argument oladi.
 ```
  Route::get('user/information', function(){
    return view('user.info)
    })->name('user.information') orqali routlarni nomlanadi.
  ```
```
  Route::group(['prefix'=>'admin'], function(){
  Route::get('/users', function(){
   return view('users.index');
  });
  Route::get('/users/{id}', function($id){
    return view('users.show');
  }); 
  })
  ``` 
  bu yerda birinch [] ni yozish majburiy bo'lib kamida prefix yoki middleware yozilishi kerak.
- Redirect - bu routeni boshqasiga yo'llash misol 
```
Route::get('/user', function(){
    return redirect('home');
    return redirect()->route('user.show')
})

```

# 2-dars
- Laravel controller lar `php artisan make:controller \Admin\AdminController` orqali qo'shiladi. Ular mos ravishda Http/Controller ichida ochiladi. Uni keyin Routeda callback function o'rniga [ichida] nomi va metodi beriladi.
```Route::get('/users',[AdminController::class, @index])```orqali beriladi.
- Controllerda Request $request orqali kelgan so'rovlarni olishimiz validatsiya qilishimiz mumkin.

- Laravel Blade Cheat Sheet

- 📄 Asosiy Blade Sintaksisi

```blade
{{-- Izohlar --}}
{{-- Bu izoh --}}

{{-- Ekranga chiqarish (XSSdan himoyalangan) --}}
{{ $name }}

{{-- XSS dan himoyalanmagan (dangerous) --}}
{!! $html !!}

{{-- PHP kod --}}
@php
    $x = 5;
@endphp
```

---

- 🔁 Looplar

```blade
{{-- for --}}
@for ($i = 0; $i < 10; $i++)
    {{ $i }}
@endfor

{{-- foreach --}}
@foreach ($users as $user)
    {{ $user->name }}
@endforeach

{{-- forelse --}}
@forelse ($users as $user)
    {{ $user->name }}
@empty
    No users found
@endforelse

{{-- while --}}
@while (true)
    Break loop
    @break
@endwhile
```

---

- ❓ Shart Operatorlari

```blade
{{-- if --}}
@if ($age > 18)
    You are adult
@elseif ($age == 18)
    Just turned adult
@else
    You are underage
@endif

{{-- unless --}}
@unless ($isAdmin)
    You are not admin
@endunless

{{-- isset va empty --}}
@isset($name)
    {{ $name }}
@endisset

@empty($data)
    No data
@endempty
```

---

- 📦 Layout va Sections

- `layout.blade.php`

```blade
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
    @yield('content')
</body>
</html>
```

- `home.blade.php`

```blade
@extends('layout')

@section('title', 'Home Page')

@section('content')
    <h1>Welcome</h1>
@endsection
```

---

- ✳️ Components va Slots

- `resources/views/components/alert.blade.php`

```blade
<div class="alert alert-{{ $type }}">
    {{ $slot }}
</div>
```

- Chaqirish

```blade
<x-alert type="danger">
    Something went wrong!
</x-alert>
```

---

- 📥 Include, Each, Once

```blade
{{-- Include qilish --}}
@include('partials.header')

{{-- Har bir element uchun --}}
@each('view.name', $items, 'item')

{{-- Bir marta ishlaydi --}}
@once
    <script>console.log("loaded once")</script>
@endonce
```

---

- 💥 Push va Stack

- `layout.blade.php`

```blade
@stack('scripts')
```

- `child.blade.php`

```blade
@push('scripts')
    <script src="script.js"></script>
@endpush
```

---

- 🔐 Auth va Guest

```blade
@auth
    Welcome, {{ auth()->user()->name }}
@endauth

@guest
    Please log in.
@endguest
```

---

- 🔄 CSRF va Method Spoofing

```blade
<form method="POST" action="/profile">
    @csrf
    @method('PUT') 
    <input name="name">
</form>
```

---

-⚡️ Xususiy Blade Direktivalar

```blade
{{-- Include qilish sharti bilan --}}
@includeWhen($isAdmin, 'partials.admin')

{{-- Include qilish shart bo‘lmasa --}}
@includeIf('partials.footer')
```

---

- 📊 Xatoliklar va Old Inputs

```blade
{{-- Xato ko‘rsatish --}}
@error('email')
    <div>{{ $message }}</div>
@enderror

{{-- Old inputlar --}}
<input type="text" name="email" value="{{ old('email') }}">
```

---

- 📚 Qisqa Tavsiyalar

| Maqsad          | Blade Sintaksisi                  |
|-----------------|-----------------------------------|
| CSRF token      | `@csrf`                           |
| Laravel route   | `{{ route('home') }}`             |
| URL yaratish    | `{{ url('/about') }}`             |
| Asset (img, css)| `{{ asset('img/logo.png') }}`     |
| Auth user       | `{{ auth()->user()->name }}`      |


# 3-dars
- `Artisan buyruqlar qo'llanmasi:` https://artisan.page/#viewclear
- `php artisan make:migration create_teachers_table` orqali yangi table lokalda ochiladi keyin uni db ga qo'shish uchun `php artisan migrate` qilinadi.
- Agar biz mavjud jadvalga o'zgartish qilmoqchi bo'lsak unda yana boshqa migratsion jadval ochib uni migrate qilamiz. `php artisan make:migration add_phone_column_to_teachers_table` deb bunda yangi ustun phone nomi bilan teachers jadvaliga qo'shiladi.
- Agar ichidagi columni yangilamoqchi bo'lsak huddi yangi column qo'shishdagi kabi `php artisan make:migration change_name_to_nullable_in_teachers_table` yozib uni ichga 
 ```php
    public function up()
{
    Schema::table('teachers', function (Blueprint $table) {
        $table->text('name')->nullable()->change();
    });
}

public function down()
{
    Schema::table('teachers', function (Blueprint $table) {
        $table->text('name')->nullable(false)->change();
    });
}
```
ko'rinishida yozamiz. Shuni unutmaslik kerakki down metodida avvalgi holat saqlab qolishimiz kerak. Keyinchalik bu kerak bo'lishi mumkin.
# 4-dars
## Eloquent. Model.
- Model - bu DB bilan ishlaydigan MVC ni bi qismi. Uni `php artisan make:model TableName` orqali mos jadvalni birlikdagi nomini yozish bilan qo'shamiz loyihaga. Agar shunda mos jadvalni nomini kiritmask Larvel o'zi avtomatik ravishda mos birlikdaki nomga to'g'ri keladigan ko'plikdagi nomdagi jadvalni ulaydi. Lekin biz boshq nom kiritsan unda model klasi ichida 
```php
protected $table = "nameTables"; 
``` 
ni kiritishimiz kerak. Shunda model db dagi jadval bilan to'g'ri bog'lanadi. Model class ichida 
```php
protected $attributes = [
        'options' => '[]',
        'delayed' => false,
    ];
```
orqali o'zimizga ustunga `default` qiymat berishimiz mumkin.

# 5-dars
## Ma'lumotlarni bazaga yozish usullari
- DB fasadi orqali 
```php
use Illuminate\Support\Facades\DB

public function store(Request $request){
    DB::insert([
    'name'=>$request->name;
    'email'=>$request->email;
])
}
```
- Model orqali odiiy usulda:
```php
public function store(Request $request){
$post = new Post();
$post->name = $request->name;
$post->email= $request->email;
$post->save();
}
```
- Mass assigment - usuli (fillable yoki guarded)
```php
// Post model
class Post extends Model {
    protected $fillable = ['title', 'content'];
}

// Controller yoki boshqa joyda
Post::create([
    'title' => 'Yangi post',
    'content' => 'Bu post kontenti'
]);
```
yoki
```php
$post = new Post();
$post->title = 'Post sarlavhasi';
$post->content = 'Post matni';
$post->save();
```
- Mass assignment (bulk insert)
```php
$data = [
    ['title' => 'Post 1', 'content' => 'Matn 1'],
    ['title' => 'Post 2', 'content' => 'Matn 2']
];

Post::insert($data); // `insert()` faqat modelni yaratadi, timestamps ishlamaydi
```

# 6-dars
## Model Binding, Form Request, File Uploads
- Model binding bu laravelda routlarga javob beradigan controllerlarga modelni bog'lash bu orqali kontrollerlarda to'g'ridan to'gri kerakli table tanlanadi.
```php
use App\Http\Controllers\UserController;
use App\Models\User;

// Route definition...
Route::get('/users/{user}', [UserController::class, 'show']);

// Controller method definition...
public function show(User $user)
{
    return view('user.profile', ['user' => $user]);
}
```
bunda odatda id bo'yicha ishlaydi agar boshqa qatordan foydalnmoqchi bo'lsak modelda e'lon qilib qo'yish kerak: 
```php
/**
 * Get the route key for the model.
 */
public function getRouteKeyName(): string
{
    return 'slug';
}
```
- Form Request - bu formalarni validatsiya qilish uchun alohida class hisoblanib uni artisan orqali qo'shiladi loyihaga. 
- File uploads - buni uchun dastlab formani `enctype = "multipart/form-data"` qilish kerak. Keyin controllerda:

```php
use Illuminate\Http\Request;

public function upload(Request $request)
{
    // Validatsiya
    $request->validate([
        'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // max:2MB
    ]);

    // Faylni olish
    $file = $request->file('image');

    // Faylga noyob nom berish
    $fileName = time() . '_' . $file->getClientOriginalName();

    // Faylni saqlash (public/storage/images papkaga)
    $filePath = $file->storeAs('images', $fileName, 'public');

    // Saqlangan fayl yo‘lini olish
    $fullPath = '/storage/' . $filePath;

    // Bazaga yozish mumkin (ixtiyoriy)
    // Post::create(['image' => $fullPath]);

    return response()->json([
        'message' => 'Fayl muvaffaqiyatli yuklandi',
        'path' => $fullPath
    ]);
}
```
Yoki bo'lmasa phpni natib move() metodi asosida ham ishlatilishi mumkin. 
```php
use Illuminate\Http\Request;

public function uploadImage(Request $request)
{
    // Validatsiya
    $request->validate([
        'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    // Faylni olish
    $file = $request->file('image');

    // Faylga noyob nom berish
    $fileName = time() . '_' . $file->getClientOriginalName();

    // Faylni 'public/uploads' papkaga ko'chirish
    $file->move(public_path('uploads'), $fileName);

    // Yuklangan fayl yo'lini olish
    $filePath = 'uploads/' . $fileName;

    return response()->json([
        'message' => 'Fayl muvaffaqiyatli yuklandi',
        'path' => $filePath
    ]);
}
```
Lekin ulardan store() va sotreAs() tavsiya qilinadi sababi:
Qisqacha taqqoslash jadvali:
Narsa	store() / storeAs()	move()
Laravel Filesystem bilan ishlaydi	✅ Ha	❌ Yo‘q
storage/app ga yozadi	✅ Ha	❌ Yo‘q
public/ papkaga yozadi	✅ (via storage:link)	✅ Ha
S3, FTP bilan ishlaydi	✅ Ha	❌ Yo‘q
Fayl nomi avtomatik	✅ (agar store())	❌ Yo‘q
PHP native metod	❌ Yo‘q	✅ Ha
Artisan bilan boshqariladi	✅ Ha	❌ Yo‘q
Xulosa:
✅ Tavsiya etiladi: Laravel loyihasida store() yoki storeAs() ishlating — bu xavfsiz, ko‘p formatlar bilan mos, Laravel standartiga mos keladi.

⚠️ move() — kichik loyihalarda yoki shunchaki oddiy saqlashda ishlatiladi, lekin disklar, ruxsatlar va bulut saqlashlar bilan ishlamaydi.

# 7-dars
## Authentication va Middleware
- Authentication qilish paketlardan boydalaniladi eng keng tarqalgani Breeze`composer require laravel/breeze --dev` bo'lib unda bizga tayyor rout va sahifalar beriladi.
- Middleware - bu HTTP so‘rov (request) va javob (response) orasidagi vositachi qatlam. U orqali siz foydalanuvchi so‘rovini qabul qilishdan oldin yoki javob yuborishdan oldin tekshiruvlar, ruxsatlar, filtrlar kabi jarayonlarni bajarasiz. Middleware — bu yul nazoratchisi (tekshiruvchi): kimga ruxsat bor, kimga yo‘q, qayerga kirsa bo‘ladi, qayerga yo‘q – hammasini tekshiradi. Uni qo'shish uchun `php artisan make:middleware IsAdmin`. Keyin IsAdmin middleware kodi:
```php
// app/Http/Middleware/IsAdmin.php

public function handle($request, Closure $next)
{
    if (auth()->check() && auth()->user()->role === 'admin') {
        return $next($request); // ruxsat
    }

    abort(403, 'Ruxsat yo‘q!'); // bloklash
}
```
keyin middleware ishlashi uchun uni Kernel.php fayliga qo'shish kerak. 
```php
// app/Http/Kernel.php
protected $routeMiddleware = [
    'is_admin' => \App\Http\Middleware\IsAdmin::class,
];
```
So'ng uni Route da ishlattish uchun
```php
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
});
```
qilinadi.

# 8-dars
## Event Listener
Event – bu: “Biror narsa bo‘ldi!”
Listener – bu: “Bo‘ldi? Men bu hodisaga nima qilishimni bilaman!”
Foydalanuvchi biror amal bajarganda misol ro'yxatdan o'tganda yoki do'konga yangi mahsulot qo'shilganda ishlatiladi undagi hodisani eshitib keyin u asosida biror logika yozishda ishlatilishi mumkin. Bunda dastlab event qo'shiladi `php artisan make:event UserRegistered` keyin 
```php
// app/Events/UserRegistered.php

use App\Models\User;

class UserRegistered
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
```
event yoziladi. So'ng unda listener `php artisan make:listener SendWelcomeEmail --event=UserRegistered` orqali ochilib 
```php
// app/Listeners/SendWelcomeEmail.php

use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{
    public function handle(UserRegistered $event)
    {
        // Email jo‘natiladi
        Mail::to($event->user->email)->send(new WelcomeEmail($event->user));
    }
}
```
so'ng uni `EventServiceProvider` da e'lon qilib olamiz
```php
// app/Providers/EventServiceProvider.php

protected $listen = [
    \App\Events\UserRegistered::class => [
        \App\Listeners\SendWelcomeEmail::class,
    ],
];
```
kerakli routda ishlartamiz `event(new Event)` orqaqli ishlatamiz
```php
use App\Events\UserRegistered;

public function register(Request $request)
{
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Event ishga tushadi
    event(new UserRegistered($user));

    return response()->json(['message' => 'Ro‘yxatdan o‘tildi']);
}
```

# 9-dars
## Queue va Model Events Laravel Observers
- Queue - bu og‘ir yoki uzoq vaqt talab qiladigan ishlarni fon (background) jarayon sifatida bajarish imkonini beruvchi kuchli vositadir. Queue — bu Laravelga:
  “Bu ishni hozir qilma, keyin, fon rejimida bajarasiz!”
  — deb topshiriq berish tizimi. Undan foydalanish uchun dastlab loyihani o'zimizga qulay connectionga .env orqali o'zgartiqib olishimiz kerak. `QUEUE_CONNECTION=database` keyin quyidagi komandalarni bajaramiz
 ```php
php artisan queue:table
php artisan migrate
```
bu mos jadvalni bazaga migrate qilib beradi. Keyin queue ishlatish uchun job klasini qo'shib olamiz `php artisan make:job SendWelcomeEmailJob`  
```php
// app/Jobs/SendWelcomeEmailJob.php

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        Mail::to($this->user->email)->send(new WelcomeEmail($this->user));
    }
}
```
so'ng uni kerakli kontrollerda ishlatish uchun `SendWelcomeEmailJob::dispatch($user);` qilinadi. Queuelar lokalhostda ishlatish uchun `php artisan queue:work` qilinadi. Keyinchalik uni productionda ishlatish uchun `supervisor` dan foydalaniladi.

# 10-dars
## Model Events va Observes
- Model Events - bu oddiy Event kabi faqat Model ichdagi hodisalarni doimiy tekshirib turishda tayyor yechimni beradi. Bu Laravel'da modelga tegishli muayyan voqealar (eventlar) bo‘lib, ular model bilan ish bajarilayotgan paytda (masalan: yaratish, yangilash, o‘chirish) avtomatik ravishda ishga tushadi. Unga turli xil usularda ishlatish mumkin. Misol statick metod sifatida 
 ```php
// app/Models/Post.php
class Post extends Model
{
    protected static function booted()
    {
        static::creating(function ($post) {
            $post->slug = Str::slug($post->title);
        });
    }
}
```
- Observer - bu Model Eventlarini ishi kabi ishni bajaradigan alohida klass bo'lib. Undan foydalanish orqali biz modullikka rivoya qilamiz.  Observer — bu modelga tegishli eventlarni tartibli, alohida klassda yozish imkonini beruvchi mexanizm. U Model Eventlarga o‘xshaydi, lekin kodni toza, modullar shaklida ajratilgan holatda saqlashga yordam beradi. 
Observer — bu modeldagi harakatlarga (create, update, delete) javob qaytaruvchi sinf (klass). Buni booted() metodida yozish o‘rniga, alohida faylga ajratamiz. Uni qo'shish uchun `php artisan make:observer PostObserver --model=Post` so'ng uni EventListenerProvider da `boot()` metodida ro'yxatdan o'tkazib qo'yiladi:
```php
// app/Providers/EventServiceProvider.php

use App\Models\Post;
use App\Observers\PostObserver;

public function boot(): void
{
    Post::observe(PostObserver::class);
}
```
# 11-dars
## Transaction
- Transaction - bu agar bir metodda bir nechta baza bilan ishlar qilinishi kerak bo'lsa bazani consitensy (muvofiqlini) saqlash uchun foydalanalidagn metod yoki bu ma’lumotlar bazasidagi bir nechta operatsiyalarni birgalikda bajarish va agar biror xatolik yuz bersa, hammasini bekor qilish imkonini beradigan kuchli vosita.
```php
use Illuminate\Support\Facades\DB;

public function store(Request $request)
{
    DB::beginTransaction();

    try {
        $user = User::find($request->user_id);
        $user->balance -= $request->amount;
        $user->save();

        Payment::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'status' => 'completed',
        ]);

        DB::commit(); // hammasi muvaffaqiyatli – bazaga saqlanadi
        return response()->json(['message' => 'To‘lov muvaffaqiyatli']);
    } catch (\Exception $e) {
        DB::rollback(); // xatolik bo‘lsa – hamma o‘zgarishlar bekor qilinadi
        return response()->json(['error' => 'Xatolik: ' . $e->getMessage()], 500);
    }
}
```
yoki Laravel qisqacha yo'l ham taklif qiladi. Bunda agar ammallar oxirigacha bajarilmasa avtomatik rollback bo'lib ketadi.
```php
DB::transaction(function () use ($request) {
    $user = User::find($request->user_id);
    $user->balance -= $request->amount;
    $user->save();

    Payment::create([
        'user_id' => $user->id,
        'amount' => $request->amount,
        'status' => 'completed',
    ]);
});
```

