
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Jagepard/Rudra-Container/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Jagepard/Rudra-Container/?branch=master)
[![Code Climate](https://codeclimate.com/github/Jagepard/Rudra-Container/badges/gpa.svg)](https://codeclimate.com/github/Jagepard/Rudra-Container)
[![CodeFactor](https://www.codefactor.io/repository/github/jagepard/rudra-container/badge)](https://www.codefactor.io/repository/github/jagepard/rudra-container)
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
use Rudra\Container\Rudra;
``` 
>The container is available for calling.
```php
Rudra::run();
``` 
***    
###### Add objects:
Without arguments - add to the container the class *Annotations* with the call key *annotation*
```php
Rudra::run()->set(['annotation', 'Rudra\Annotation']);
```
With arguments
>If the class expects a Container dependency in the constructor, the container will automatically create the necessary object
and substitute it as an argument
*Note:* the Container class must be available at Composer startup
```php
class Auth
{
    public function __construct(RudraInterface $rudra)
    {
        $this->rudra = $rudra;
    }
}
```
>Adding an object in this case is similar to the first
```php
Rudra::run()->set(['auth', 'Rudra\Auth']);
```
>If in the constructor the Auth class expects the implementation of the ContainerInterface interface, then so that the container automatically
created the necessary object and substituted as an argument, we need to connect the ContainerInterface interface to the implementation.
```php
use Rudra\Container\Interfaces\RudraInterface;
```
```php
class Auth
{
    public function __construct(RudraInterface $rudra)
    {
        $this->rudra = $rudra;
    }
}
```
>Adding an object in this case is also similar, but in this case, you must associate the interface with the implementation
. To do this, we use the setBinding method, to which we will pass the interface as the first element, and in
as a second implementation
```php
Rudra::binding()->set([RudraInterface::class => rudra()]);
```
```php
Rudra::run()->set(['auth', 'Rudra\Auth']);
```
>If the class constructor contains arguments with default values, then if no arguments are passed, values
will be added by default by container
```php
class Auth
{
    public function __construct(RudraInterface $rudra, $name, $config = 'something')
    {
        $this->rudra = $rudra;
    }
}
```
>In this case, you can pass as soon as the argument $name, and $name, $config
```php
Rudra::run()->set(['auth', ['Rudra\Auth', ['value']]);
```
```php
Rudra::run()->set('auth', ['Rudra\Auth', ['value', 'concrete']]);
```
