<?php

// Функция генератор случайной строки
function generate_string($n)
{
    $string = '';
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $length = strlen($alphabet);

    for ($i = 0; $i < $n; $i++) {
        $string .= substr($alphabet, rand(0, $length - 1), 1);
    }

    return $string;
}

