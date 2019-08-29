<?php

declare(strict_types=1);

namespace App\Post\Domain;

class PostDoesNotExistException extends \Exception
{
    protected $message = 'Post does not exist';
}