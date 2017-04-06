<?php

declare(strict_types = 1);

require_once dirname(__DIR__) . '/ContainerSessionTrait.php';
require_once dirname(__DIR__) . '/ContainerGlobalsTrait.php';
require_once dirname(__DIR__) . '/ContainerCookieTrait.php';
require_once dirname(__DIR__) . '/ContainerTrait.php';
require_once dirname(__DIR__) . '/IContainer.php';
require_once dirname(__DIR__) . '/Container.php';

require_once __DIR__ . '/stub/ClassWithContainerTrait.php';
require_once __DIR__ . '/stub/ClassWithoutConstructor.php';
require_once __DIR__ . '/stub/ClassWithoutParameters.php';
require_once __DIR__ . '/stub/ClassWithDefaultParameters.php';
require_once __DIR__ . '/stub/ClassWithDependency.php';
