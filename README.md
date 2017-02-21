[![Build Status](https://travis-ci.org/Jagepard/Rudra-Container.svg?branch=master)](https://travis-ci.org/Jagepard/Rudra-Container)
[![Coverage Status](https://coveralls.io/repos/github/Jagepard/Rudra-Container/badge.svg?branch=master)](https://coveralls.io/github/Jagepard/Rudra-Container?branch=master)
[![Code Climate](https://codeclimate.com/github/Jagepard/Rudra-Container/badges/gpa.svg)](https://codeclimate.com/github/Jagepard/Rudra-Container)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/c1e7d5fe3a4946459fc14e9a455dd878)](https://www.codacy.com/app/Jagepard/Rudra-Container?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Jagepard/Rudra-Container&amp;utm_campaign=Badge_Grade)
# Rudra-Container
>####IoC Контейнер

***
######Иницианализируем контейнер:

```php
use \Rudra\Container as Rudra;
Rudra::app();
``` 
>Теперь контейнер доступен для вызова 2 способами

```php
Rudra::app();
Rudra::$app;
``` 
***    
######Добавляем объекты:
Без аргументов - добавит в контейнер класс *Annotations* с ключом вызова *annotation*
```php
Rudra::$app->set('annotation', 'Annotations');
```

С аргументами
>Если в конструкторе класс Auth ожидает зависимость Container, то контейнер автоматически создаст необходимый объект 
и подставит в качестве аргумента

*Примечание:* класс Container должен быть доступен в автозагрузке Composer

```php
class Auth
{
    public function __construct(Container $di)
    {
        $this->$di = $di;
    }
}
```
Добавление объекта в данном случае аналогично первому

```php
Rudra::$app->set('auth', 'Auth');
```
>Если в конструкторе класс Auth ожидает реализацию инетрфейса IContainer, то для того, чтобы контейнер автоматически 
создал необходимый объект и подставил в качестве аргумента, нам необходимо связать инетрфейс IContainer с реализацией.
```php
class Auth
{
    public function __construct(IContainer $di)
    {
        $this->$di = Container;
    }
}
```
Добавление объекта в данном случае также аналогично, но в данном случае обязательно связывать интерфейс с реализацией
```php
Rudra::$app->setBinding(IContainer::class, Container::$app);
```
```php
Rudra::$app->set('auth', 'Auth');
```
