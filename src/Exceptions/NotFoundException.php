<?php

namespace Rudra\Container\Exceptions;

use Psr\Container\NotFoundExceptionInterface;

class NotFoundException extends \RuntimeException implements NotFoundExceptionInterface {}
