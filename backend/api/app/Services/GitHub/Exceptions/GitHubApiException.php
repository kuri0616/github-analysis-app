<?php

namespace App\Services\GitHub\Exceptions;

use Exception;

// NOTE: 根底クラスを継承するだけ。使用側で例外クラスを使い分けるため
class GitHubApiException extends Exception
{
}
