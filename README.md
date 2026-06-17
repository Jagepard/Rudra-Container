[![Build Status](https://travis-ci.org/Jagepard/Rudra-Container.svg?branch=master)](https://travis-ci.org/Jagepard/Rudra-Container)
[![Maintainability](https://qlty.sh/badges/6ab84b91-8f18-409f-b350-b8f8a37e278c/maintainability.svg)](https://qlty.sh/gh/Jagepard/projects/Rudra-Container)
[![CodeFactor](https://www.codefactor.io/repository/github/jagepard/rudra-container/badge)](https://www.codefactor.io/repository/github/jagepard/rudra-container)
[![Coverage Status](https://coveralls.io/repos/github/Jagepard/Rudra-Container/badge.svg?branch=master)](https://coveralls.io/github/Jagepard/Rudra-Container?branch=master)
-----

# Rudra-Container | [API](https://github.com/Jagepard/Rudra-Container/blob/master/docs.md "Documentation API")
#### Installation
```composer require rudra/container```
#### Using
```php
use Rudra\Container\Rudra;

Rudra::run();
```
using Facade:
```php
use Rudra\Container\Facades\Rudra;
```
---
##### Setting:

---
Bind an interface to an implementation or pre-arranged factory:
---
```php
Rudra::run()->binding([
    SomeInterface::class => SomeClass::class
    ...
    SomeInterface::class => SomeFactory::class
    ...
    SomeInterface::class => 'service-name'
    ...
    SomeInterface::class => function (){
        return new SomeClass();
    }
    ...
    SomeInterface::class => function (){
        return (new SomeFactory)->create();
    }    
]);
```
using Facade:
```php
Rudra::binding([
    SomeInterface::class => SomeClass::class
    ...
    SomeInterface::class => SomeFactory::class
    ...
    SomeInterface::class => 'service-name'
        ...
    SomeInterface::class => function (){
        return new SomeClass();
    }
    ...
    SomeInterface::class => function (){
        return (new SomeFactory)->create();
    }
]);
```
---
Installs services into a waiting container to be initialized when called:
---
```php
Rudra::run()->waiting([
    'service-name' => [SomeClass::class, ['param-1', 'param-2']]
    ...
    'service-name' => SomeFactory::class
    ...
    'service-name' => function (){
        return new SomeClass();
    }
    ...
     'service-name' => function (){
        return (new SomeFactory)->create();
    }
}
])
```
using Facade:
```php
Rudra::waiting([
    'service-name' => [SomeClass::class, ['param-1', 'param-2']]
    ...
    'service-name' => SomeFactory::class
    ...
    'service-name' => function (){
        return new SomeClass();
    }
    ...
     'service-name' => function (){
        return (new SomeFactory)->create();
    }
}
])
```
---
Add a bind to previously established ones:
---
```php
Rudra::run()->binding()->set([SomeInterface::class => SomeClass::class])
```
using Facade:
```php
Rudra::binding()->set([SomeClass::class, ['param-1', 'param-2']);
```
---
Add the service to the previously installed ones:
---
```php
Rudra::run()->waiting()->set([
    'service-name' => [SomeClass::class, ['param-1', 'param-2']]
    ...
    'service-name' => SomeFactory::class
])
```
using Facade:
```php
Rudra::waiting()->set([
    'service-name' => [SomeClass::class, ['param-1', 'param-2']]
    ...
    'service-name' => SomeFactory::class
])
```
---
Call the created service:
---
```php
Rudra::run()->get('service-name')
```
using Facade:
```php
Rudra::get('service-name')
```
---
If the service does not have parameters, or the parameters are in the binding, then the service will be created automatically when calling
---
```php
Rudra::run()->get(Service::class)
```
using Facade:
```php
Rudra::get(Service::class)
```
## License

This project is licensed under the **Mozilla Public License 2.0 (MPL-2.0)** — a free, open-source license that:

- Requires preservation of copyright and license notices,
- Allows commercial and non-commercial use,
- Requires that any modifications to the original files remain open under MPL-2.0,
- Permits combining with proprietary code in larger works.

📄 Full license text: [LICENSE](./LICENSE)  
🌐 Official MPL-2.0 page: https://mozilla.org/MPL/2.0/