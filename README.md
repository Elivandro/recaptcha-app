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

### Para v2 utilize os seguintes codigos onde deseja o recaptcha

```
{!! ReCaptcha::display() !!}
{!! ReCaptcha::renderJs() !!}
```

### Adicione o componente de erro do recaptcha

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

### Adicione um id no form onde deseja o recaptcha, exemplo:

```
<form id="login">
```

### Adicione o seguinte codigo onde deseja o v3 do recaptcha, exemplo:

```
{{-- para a v3 do recaptcha, id do form, nome do botão e classes css --}}
{!! ReCaptcha::displaySubmit('login', 'Log in', [
    'class' =>
        'ms-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150',
]) !!}
```

### Sempre registre as Facades `config/app.php`

```
'aliases' => [
    'Auth'  => Illuminate\Support\Facades\Auth::class,
    'Route' => Illuminate\Support\Facades\Route::class,
    'ReCaptcha' => App\ReCaptcha\Facades\ReCaptcha::class,
],
```
