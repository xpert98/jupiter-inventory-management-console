<?php

/*
Jupiter Inventory Management Console
Copyright (C) 2019 Matt Stanchek

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.

*/

class secret {

    function encryptString($string) {

        $secretKey = $_SERVER['SECRET_KEY'];
        $ivSeed = $_SERVER['SECRET_IV'];
        $cipher = "AES-256-CBC";
        $key = hash('sha256', $secretKey);
        $iv = substr(hash('sha256', $ivSeed), 0, 16);
    
        $encryptedString = base64_encode(openssl_encrypt($string, $cipher, $key, 0, $iv));
    
        return $encryptedString;

    }

    function decryptString($string) {

        $secretKey = $_SERVER['SECRET_KEY'];
        $ivSeed = $_SERVER['SECRET_IV'];
        $cipher = "AES-256-CBC";
        $key = hash('sha256', $secretKey);
        $iv = substr(hash('sha256', $ivSeed), 0, 16);
    
        $decryptedString = openssl_decrypt(base64_decode($string), $cipher, $key, 0, $iv);
    
        return $decryptedString;
        
    }

    function genString($iterations) {

        $outputStr = '';

        for ($i = 0; $i < $iterations; $i++) { 
            $str = rand(); 
            $outputStr = $outputStr.hash("sha256", $str); 
        }

        return $outputStr;

    }

}

?>