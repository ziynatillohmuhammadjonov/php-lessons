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
