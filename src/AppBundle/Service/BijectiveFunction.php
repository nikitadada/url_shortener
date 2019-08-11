<?php

namespace AppBundle\Service;

final class BijectiveFunction
{
    private $dictionary;


    public function __construct()
    {
        $this->dictionary = array_merge(
            range('A', 'Z'),
            range('a', 'z'),
            range('0', '9')
        );
    }

    public function encode(int $index): string
    {
        if (0 === $index) {
            return $this->dictionary[0];
        }

        $result = [];
        $base = count($this->dictionary);

        while ($index > 0) {
            $result[] = $this->dictionary[($index % $base)];
            $index = floor($index / $base);
        }

        $result = array_reverse($result);

        return implode("", $result);
    }

    public function decode(string $alias): int
    {
        $i = 0;
        $base = count($this->dictionary);

        $alias = str_split($alias);

        foreach ($alias as $char) {
            $pos = array_search($char, $this->dictionary);

            $i = $i * $base + $pos;
        }

        return $i;
    }
}