# Laravel Asosiy Tushunchalar va Tuzilishi (Qo'llanilishi bilan)

## 1. Laravel Project Tuzilishi

```
app/               -> Asosiy biznes logika
  Http/
    Controllers/  -> Controllerlar
    Middleware/   -> Middleware fayllar
  Models/         -> Eloquent modellari

routes/           -> Web va API marshrutlar
  web.php         -> Web route'lar
  api.php         -> API route'lar

database/
  migrations/     -> Migration fayllar
  seeders/        -> Seeder fayllar
  factories/      -> Model factory'lar

resources/
  views/          -> Blade fayllar (agar monolit bo‘lsa)
  js/             -> Frontend fayllar
  sass/           -> Stil fayllari

config/           -> Konfiguratsiya fayllari
public/           -> Ochiq fayllar (index.php, images, js)
```

---

## 2. Model

```bash
php artisan make:model Post
```

```php
class Post extends Model
{
    protected $fillable = ['title', 'content'];
    
    // Relation
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}

// Qo'llanilishi:
Post::create(['title' => 'Laravel', 'content' => 'Laravel is awesome']);
```

---

## 3. Migration

```bash
php artisan make:migration create_posts_table
```

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->text('content');
    $table->timestamps();
});
```

```bash
php artisan migrate
```

---

## 4. Scope

### Local Scope

```php
public function scopeActive($query) {
    return $query->where('status', 'active');
}

// Foydalanish:
Post::active()->get();
```

### Global Scope

```php
class ActiveScope implements Scope {
    public function apply(Builder $builder, Model $model) {
        $builder->where('status', 'active');
    }
}

protected static function booted() {
    static::addGlobalScope(new ActiveScope);
}
```

---

## 5. Event & Listener

```bash
php artisan make:event UserRegistered
php artisan make:listener SendWelcomeEmail --event=UserRegistered
```

```php
// Event
class UserRegistered {
    public $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
}

// Listener
class SendWelcomeEmail {
    public function handle(UserRegistered $event) {
        Mail::to($event->user->email)->send(new WelcomeEmail($event->user));
    }
}

// Foydalanish:
UserRegistered::dispatch($user);
```

---

## 6. Queue

```bash
php artisan queue:table
php artisan migrate
```

### Job Yaratish

```bash
php artisan make:job SendWelcomeEmailJob
```

```php
class SendWelcomeEmailJob implements ShouldQueue {
    protected $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
    public function handle() {
        Mail::to($this->user->email)->send(new WelcomeEmail($this->user));
    }
}

// Ishlatish:
SendWelcomeEmailJob::dispatch($user);
```

---

## 7. Interface & Repository

```php
interface UserRepositoryInterface {
    public function all();
}

class UserRepository implements UserRepositoryInterface {
    public function all() {
        return User::all();
    }
}

// Service Provider:
$this->app->bind(UserRepositoryInterface::class, UserRepository::class);

// Controllerda foydalanish:
public function index(UserRepositoryInterface $userRepo) {
    return $userRepo->all();
}
```

---

## 8. Middleware

```bash
php artisan make:middleware CheckRole
```

```php
public function handle($request, Closure $next) {
    if (!auth()->check() || !auth()->user()->isAdmin()) {
        abort(403);
    }
    return $next($request);
}

// Kernel.php:
'admin' => \App\Http\Middleware\CheckRole::class,

// route:
Route::middleware('admin')->group(function () {
    Route::get('/admin', fn() => 'Admin panel');
});
```

---

## 9. Form Request Validation

```bash
php artisan make:request StorePostRequest
```

```php
public function rules() {
    return [
        'title' => 'required|string',
        'content' => 'required'
    ];
}

// Controllerda:
public function store(StorePostRequest $request) {
    Post::create($request->validated());
}
```

---

## 10. File Upload

```php
public function upload(Request $request) {
    $file = $request->file('avatar');
    $path = $file->store('avatars');
    return response()->json(['path' => $path]);
}

// move bilan:
$file->move(public_path('uploads'), $file->getClientOriginalName());
```

---

## 11. Mail

```bash
php artisan make:mail WelcomeEmail
```

```php
public function build() {
    return $this->subject('Xush kelibsiz')->view('emails.welcome');
}

// Foydalanish:
Mail::to($user->email)->send(new WelcomeEmail($user));
```

---

## 12. Notification

```bash
php artisan make:notification InvoicePaid
```

```php
public function toMail($notifiable) {
    return (new MailMessage)->line('To'lov qabul qilindi.');
}

// Foydalanish:
$user->notify(new InvoicePaid($invoice));
```

---

## 13. Policy

```bash
php artisan make:policy PostPolicy
```

```php
public function update(User $user, Post $post) {
    return $user->id === $post->user_id;
}

// Controllerda:
$this->authorize('update', $post);
```

---

## 14. API Resource

```bash
php artisan make:resource PostResource
```

```php
public function toArray($request) {
    return [
        'title' => $this->title,
        'content' => $this->content,
    ];
}

// Controllerda:
return new PostResource($post);
```

---

## 15. WebSocket (Pusher, Laravel Echo)

1. `composer require pusher/pusher-php-server`
2. `.env` faylga:
```
BROADCAST_DRIVER=pusher
PUSHER_APP_ID=...
PUSHER_APP_KEY=...
```
3. `routes/channels.php`
```php
Broadcast::channel('chat.{id}', function ($user, $id) {
    return true;
});
```
4. JavaScript (Laravel Echo):
```js
window.Echo.channel('chat.1').listen('MessageSent', (e) => {
    console.log(e);
});
```

---

## 16. Passport (OAuth API Autentifikatsiya)

```bash
composer require laravel/passport
php artisan migrate
php artisan passport:install
```

Modelga:
```php
use Laravel\Passport\HasApiTokens;
```

AuthServiceProvider:
```php
Passport::routes();
```

API token olish:
```php
$user = User::where('email', $request->email)->first();
$token = $user->createToken('AppToken')->accessToken;
```

---

## 17. Sanctum (SPA yoki mobil uchun yengil autentifikatsiya)

```bash
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

Middlewarega qo‘shish:
```php
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```

Token olish:
```php
$user = User::where('email', $request->email)->first();
$token = $user->createToken('api-token')->plainTextToken;
```

---

✅ Har bir bo‘limga qo‘llanish misollari qo‘shildi.

