---
title: Security
weight: 4
---

Most likely, your API is protected by some sort of the auth. OpenAPI have plenty of ways to describe the API (see full documentation of spec here https://spec.openapis.org/oas/v3.1.0#security-scheme-object).

## Adding security scheme
Scramble allows you to document how your API is secured. To document this, you can use `Scramble::extendOpenApi` method and add security information to OpenAPI document using `secure` method.

You should call `extendOpenApi` in `register` method of some of your service providers. This method accepts a callback that accepts OpenAPI document as a first argument.

`secure` method on `OpenApi` object accepts security scheme as an argument. It makes the security scheme default for all endpoints.

```php
namespace App\Providers;

use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Support\ServiceProvider;

class DocsServiceProvider extends ServiceProvider
{
    public function register()
    {
        Scramble::extendOpenApi(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::apiKey('query', 'api_token')
            );
        });
    }
}
```

## Examples
Here are some common examples of the security schemes object you may have in your API. For full list of available methods check implementation of `SecurityScheme` class.

### API Key
```php
SecurityScheme::apiKey('query', 'api_token');
```

### Basic HTTP
```php
SecurityScheme::http('basic');
```

### JWT
```php
SecurityScheme::http('bearer', 'JWT');
```

### Oauth2
```php
SecurityScheme::oauth2()
    ->flow('implicit', function (OAuthFlow $flow) {
        $flow
            ->authorizationUrl('https://example.com/api/oauth/dialog')
            ->addScope('write:pets', 'modify pets in your account');
    });
```
