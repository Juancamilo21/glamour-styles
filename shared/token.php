<?php

function generateToken() {
    $length = 25;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    $i = 0;

    while ($i < $length) {
        $index = rand(0, strlen($characters) - 1);
        $token .= $characters[$index];
        $i++;
    }

    return time() . $token;
}
