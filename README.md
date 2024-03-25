[![Build Status](https://travis-ci.org/Jagepard/Rudra-Container.svg?branch=master)](https://travis-ci.org/Jagepard/Rudra-Container)
[![codecov](https://codecov.io/gh/Jagepard/Rudra-Container/branch/master/graph/badge.svg)](https://codecov.io/gh/Jagepard/Rudra-Container)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Jagepard/Rudra-Container/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Jagepard/Rudra-Container/?branch=master)
[![Code Climate](https://codeclimate.com/github/Jagepard/Rudra-Container/badges/gpa.svg)](https://codeclimate.com/github/Jagepard/Rudra-Container)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/c1e7d5fe3a4946459fc14e9a455dd878)](https://www.codacy.com/app/Jagepard/Rudra-Container?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Jagepard/Rudra-Container&amp;utm_campaign=Badge_Grade)
-----
[![Code Intelligence Status](https://scrutinizer-ci.com/g/Jagepard/Rudra-Container/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Latest Stable Version](https://poser.pugx.org/rudra/container/v/stable)](https://packagist.org/packages/rudra/container)
[![Total Downloads](https://poser.pugx.org/rudra/container/downloads)](https://packagist.org/packages/rudra/container)
![GitHub](https://img.shields.io/github/license/jagepard/Rudra-Container.svg)

# Rudra-Container | [API](https://github.com/Jagepard/Rudra-Container/blob/master/docs.md "Documentation API")
#### Installation | Установка
```composer require rudra/container```
#### Using | Использование
```php
use Rudra\Container\Rudra;

Rudra::run();
```
using Facade | используя фасад:
```php
use Rudra\Container\Facades\Rudra;
```
---
###### Setting | Настройка:

---
Bind an interface to an implementation or pre-arranged factory <br> 
Связать интерфейс с реализацией или заранее подготовленной фабрикой:

---
```php
Rudra::run()->binding([
    SomeInterface::class => SomeClass::class
    ...
    SomeInterface::class => SomeFactory::class
    ...
    SomeInterface::class => 'service-name'
]);
```
using Facade | используя фасад:
```php
Rudra::binding([
    SomeInterface::class => SomeClass::class
    ...
    SomeInterface::class => SomeFactory::class
    ...
    SomeInterface::class => 'service-name'
]);
```
---
Installs services into a waiting container to be initialized when called:<br>
Устанавливает сервисы в контейнер ожидающих, для инициализации при вызове:

---
```php
Rudra::run()->waiting([
    'service-name' => [SomeClass::class, ['param-1', 'param-2']]
])
```
using Facade | используя фасад:
```php
Rudra::waiting([
    'service-name' => [SomeClass::class, ['param-1', 'param-2']]
])
```
---
Add a bind to previously established ones:<br>
Добавляем привязку к ранее установленным:

---
```php
Rudra::run()->binding()->set([SomeInterface::class => SomeClass::class])
```
using Facade | используя фасад:
```php
Rudra::binding()->set([SomeClass::class, ['param-1', 'param-2']);
```
---
Add the service to the previously installed ones:<br>
Добавляем сервис к ранее установленным:

---
```php
Rudra::run()->waiting()->set([
    'service-name' => [SomeClass::class, ['param-1', 'param-2']]
])
```
using Facade | используя фасад:
```php
Rudra::waiting()->set([
    'service-name' => [SomeClass::class, ['param-1', 'param-2']]
])
```
---
Call the created service:<br>
Вызываем созданный сервис:

---
```php
Rudra::run()->get('service-name')
```
using Facade | используя фасад:
```php
Rudra::get('service-name')
```
---
If the service does not have parameters, or the parameters are in the binding, then the service will be created automatically when calling<br>
Если сервис не имеет параметров, либо параметры имеются в привязке, то сервис будет создан автоматически при вызове

---
```php
Rudra::run()->get(Service::class)
```
using Facade | используя фасад:
```php
Rudra::get(Service::class)
```
