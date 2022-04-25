<?php
    $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    function rand_string($len = 64) {
        global $input;
        $random_string = '';
        for ($i = 0; $i < $len; $i++) {
            $index = mt_rand(0,61);
            $random_character = $input[$index];
            $random_string .= $random_character;
        }
        return $random_string;
    }
?>