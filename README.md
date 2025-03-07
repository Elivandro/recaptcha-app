# Rodando o projeto

### Requerimentos:

-   PHP 8.4 ou superior
-   Composer 2.8 ou superior
-   Node 22.13 ou superior
-   <b>Docker</b> opcional (<b>Recomendado</b>)

### Para iniciar o projeto comece clonando

```
git clone git@github.com:Elivandro/recaptcha-app.git
cd recaptcha-app/
cp -n .env.example .env
```

### Instalando as dependencias sem o docker

```
composer install --ignore-platform-reqs
npm install
php artisan key:generate
php artisan optimize
php artisan migrate
php artisan serve
npm run dev
```

### instalando as dependencias com o docker utilizando o `Makefile`

```
make
```

### Obtenha a token v2 ou v3 do recaptcha no google e adicione no .env

```
https://cloud.google.com/security/products/recaptcha?hl=pt_br

GOOGLE_RECAPTCHA_SECRET=
GOOGLE_RECAPTCHA_SITEKEY=
```

### Para v2 utilize os seguintes codigos onde deseja o captcha

```
{!! ReCaptcha::display() !!}
{!! ReCaptcha::renderJs() !!}
```

### Adicione o componente de erro do captcha

```
<x-input-error :messages="$errors->get('g-recaptcha-response')" />
```

### Adicione a validação no formRequest

```
public function rules(): array
{
    return [
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
        'g-recaptcha-response' => ['required', 'captcha']
    ];
}
```

### adicionando darkmode

```
{!! ReCaptcha::display(['data-theme' => 'dark']) !!}
```

### Para a v3 utilize os seguintes códigos onde deseja o captcha

```
{!! ReCaptcha::renderJs() !!}

{{-- para a v3 do recaptcha mantenha as propridades data-** no botão --}}
<x-primary-button
    class="ms-3 g-recaptcha"
    data-sitekey="{{ config('captcha.sitekey') }}"
    data-callback="onSubmit"
    data-action="submit">
    {{ __('Log in') }}
</x-primary-button>
```

### Sempre registre as Facades `config/app.php`

```
'aliases' => [
    'Auth'  => Illuminate\Support\Facades\Auth::class,
    'Route' => Illuminate\Support\Facades\Route::class,
    'ReCaptcha' => App\ReCaptcha\Facades\ReCaptcha::class,
],
```
