[![Build Status](https://travis-ci.org/Jagepard/Rudra-Container.svg?branch=master)](https://travis-ci.org/Jagepard/Rudra-Container)
# Rudra-Container
DI Контейнер

Базовые возможности это добавление и извлечение объектов

    $di = new \Rudra\Container();

Добавление:

    $di->set('redirect', new \Rudra\Redirect(\App\Config\Config::URI));
    $di->set('validation', new \Rudra\Validation(\App\Config\Config::CAPTHA_SECRET));

Извлечение в Контроллере или Модели:

    $this->di->get('redirect');
    $this->di->get('validation');
