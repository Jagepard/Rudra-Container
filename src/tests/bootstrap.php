<?php

/**
 * Date: 17.02.17
 * Time: 14:25
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

require_once dirname(__DIR__) . '/ContainerTrait.php';
require_once dirname(__DIR__) . '/IContainer.php';
require_once dirname(__DIR__) . '/Container.php';

require_once __DIR__ . '/stub/ClassWithContainerTrait.php';
require_once __DIR__ . '/stub/ClassWithoutConstructor.php';
require_once __DIR__ . '/stub/ClassWithoutParameters.php';
require_once __DIR__ . '/stub/ClassWithDefaultParameters.php';
require_once __DIR__ . '/stub/ClassWithDependency.php';
