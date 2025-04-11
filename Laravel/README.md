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
ni kiritishimiz kerak. Shunda model db dagi jadval bilan to'g'ri bog'lanadi. Model class i ichida 
```php
protected $attributes = [
        'options' => '[]',
        'delayed' => false,
    ];
```
orqali o'zimizga ustunga `default` qiymat berishimiz mumkin.

