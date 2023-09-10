<?php
declare(strict_types=1);

namespace TextHandler;

use function mb_strtolower;
use function preg_replace;

final class ToUrlSafe
{
    private ?string $urlSafe = null;

    public function __construct(private readonly string $sourceString)
    {
    }

    public function __toString(): string
    {
        return $this->string();
    }

    public function string(): string
    {
        if ($this->urlSafe !== null) {
            return $this->urlSafe;
        }

        $urlSafeStr = mb_strtolower($this->sourceString);
        $this->urlSafe = preg_replace(
            [
                '#[^a-z0-9\-_]#',
                '#(-{2,})#',
                '#^-*(.*?)-*$#',
            ],
            [
                '-',
                '-',
                '$1',
            ],
            $urlSafeStr
        );

        return $this->urlSafe;
    }
}