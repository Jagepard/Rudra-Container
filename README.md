[![Build Status](https://travis-ci.org/Jagepard/Rudra-Container.svg?branch=master)](https://travis-ci.org/Jagepard/Rudra-Container)
[![codecov](https://codecov.io/gh/Jagepard/Rudra-Container/branch/master/graph/badge.svg)](https://codecov.io/gh/Jagepard/Rudra-Container)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Jagepard/Rudra-Container/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Jagepard/Rudra-Container/?branch=master)
[![Code Climate](https://codeclimate.com/github/Jagepard/Rudra-Container/badges/gpa.svg)](https://codeclimate.com/github/Jagepard/Rudra-Container)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/c1e7d5fe3a4946459fc14e9a455dd878)](https://www.codacy.com/app/Jagepard/Rudra-Container?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Jagepard/Rudra-Container&amp;utm_campaign=Badge_Grade)
-----
[![Code Intelligence Status](https://scrutinizer-ci.com/g/Jagepard/Rudra-Container/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![Latest Stable Version](https://poser.pugx.org/rudra/container/v/stable)](https://packagist.org/packages/rudra/container)
[![Total Downloads](https://poser.pugx.org/rudra/container/downloads)](https://packagist.org/packages/rudra/container)
[![License: GPL-3.0-or-later](https://img.shields.io/badge/license-GPL--3.0--or--later-498e7f.svg)](https://www.gnu.org/licenses/gpl-3.0)

# Rudra-Container
#### Установка / Install
```composer require rudra/container```
#### Использование / Usage
```php
use Rudra\Container;
``` 
>Контейнер доступен для вызова 2 способами

```php
Container::app();
``` 
>после инициализации можно так
```php
Container::$app;
``` 
***    
###### Добавляем объекты:
```php
$rudra = Container::app();
``` 
Без аргументов - добавит в контейнер класс *Annotations* с ключом вызова *annotation*
```php
$rudra->set('annotation', 'Rudra\Annotation');
```

С аргументами
>Если в конструкторе класс ожидает зависимость Container, то контейнер автоматически создаст необходимый объект 
и подставит в качестве аргумента

*Примечание:* класс Container должен быть доступен в автозагрузке Composer

```php
class Auth
{
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}
```
>Добавление объекта в данном случае аналогично первому

```php
$rudra->set('auth', 'Rudra\Auth');
```
>Если в конструкторе класс Auth ожидает реализацию инетрфейса ContainerInterface, то для того, чтобы контейнер автоматически 
создал необходимый объект и подставил в качестве аргумента, нам необходимо связать инетрфейс ContainerInterface с реализацией.
```php
use Rudra\Interfaces\ContainerInterface;
```
```php
class Auth
{
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}
```

>Добавление объекта в данном случае также аналогично, но в данном случае обязательно связывать интерфейс с реализацией
. Для этого воспользуемся методом setBinding, в который мы передадим в качестве первого элемента интерфейс, а в 
качестве второго реализацию
```php
$rudra->setBinding(ContainerInterface::class, Container::$app);
```
```php
$rudra->set('auth', 'Rudra\Auth');
```

>Если конструктор класса содержит аргументы со значениями по умолчанию, то если аргументы не передавать, значения 
по умолчанию будут добавлены контейнером

```php
class Auth
{
    public function __construct(ContainerInterface $container, $name, $config = 'something')
    {
        $this->$container = $container;
    }
}
```

>В данном случае можно передать как только аргумент $name, так и $name, $config

```php
$rudra->set('auth', 'Auth', ['name' => 'value']);
```
```php
$rudra->set('auth', 'Auth', ['name' => 'value', 'config' => 'concrete']);
```
