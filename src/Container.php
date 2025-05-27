<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Container;

use Psr\Container\ContainerInterface;
use Rudra\Container\Exceptions\NotFoundException;

class Container implements ContainerInterface
{
    public function __construct(protected array $data = []) {}

    public function get(string $id): mixed
    {
        return $this->has($id) 
            ? $this->data[$id] 
            : throw new NotFoundException("Identifier \"$id\" is not found.");
    }

    public function all(): array
    {
        return $this->data;
    }

    public function set(array $data): void
    {
        $this->data = array_merge($this->data, $data);
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->data);
    }
}
