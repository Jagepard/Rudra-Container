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
#### Installation
```composer require rudra/container```
#### Using
```php
use Rudra\Container\Application;
``` 
>The container is available for calling.
```php
Application::run();
``` 
***    
###### Add objects:
Without arguments - add to the container the class *Annotations* with the call key *annotation*
```php
Application::run()->di()->set(['annotation', 'Rudra\Annotation']);
```
With arguments
>If the class expects a Container dependency in the constructor, the container will automatically create the necessary object
and substitute it as an argument
*Note:* the Container class must be available at Composer startup
```php
class Auth
{
    public function __construct(Application $application)
    {
        $this->application = $application;
    }
}
```
>Adding an object in this case is similar to the first
```php
Application::run()->di()->set(['auth', 'Rudra\Auth']);
```
>If in the constructor the Auth class expects the implementation of the ContainerInterface interface, then so that the container automatically
created the necessary object and substituted as an argument, we need to connect the ContainerInterface interface to the implementation.
```php
use Rudra\Container\Interfaces\ApplicationInterface;
```
```php
class Auth
{
    public function __construct(ApplicationInterface $application)
    {
        $this->application = $application;
    }
}
```
>Adding an object in this case is also similar, but in this case, you must associate the interface with the implementation
. To do this, we use the setBinding method, to which we will pass the interface as the first element, and in
as a second implementation
```php
Application::run()->binding()->set([ApplicationInterface::class => rudra()]);
```
```php
Application::run()->di()->set(['auth', 'Rudra\Auth']);
```
>If the class constructor contains arguments with default values, then if no arguments are passed, values
will be added by default by container
```php
class Auth
{
    public function __construct(ApplicationInterface $application, $name, $config = 'something')
    {
        $this->application = $application;
    }
}
```
>In this case, you can pass as soon as the argument $name, and $name, $config
```php
Application::run()->di()->set(['auth', ['Rudra\Auth', ['value']]);
```
```php
Application::run()->di()->set('auth', ['Rudra\Auth', ['value', 'concrete']]);
```
