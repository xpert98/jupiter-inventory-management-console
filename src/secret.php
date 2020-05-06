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

    function getSecretKey() {
        $secretKey = '';

        if (isset($_SERVER['SECRET_KEY'])) {
            $secretKey = $_SERVER['SECRET_KEY'];
        }
        elseif (isset($_ENV['SECRET_KEY'])) {
            $secretKey = $_ENV['SECRET_KEY'];
        }
        else { //Get secret key when using Docker Swarm and Docker Secrets
            $secretKeyFile = '';
            if (isset($_SERVER['SECRET_KEY_FILE'])) {
                $secretKeyFile = $_SERVER['SECRET_KEY_FILE'];
            }
            else {
                $secretKeyFile = $_ENV['SECRET_KEY_FILE'];
            }

            $secretKey = rtrim(file_get_contents($secretKeyFile));
        }

    }

    function getSecretIv() {
        if (isset($_SERVER['SECRET_IV'])) {
            $ivSeed = $_SERVER['SECRET_IV'];
        }
        elseif (isset($_ENV['SECRET_IV'])) {
            $ivSeed = $_ENV['SECRET_IV'];
        }
        else { //Get secret iv when using Docker Swarm and Docker Secrets
            $ivSeedFile = '';
            if (isset($_SERVER['SECRET_IV_FILE'])) {
                $ivSeedFile = $_SERVER['SECRET_IV_FILE'];
            }
            else {
                $ivSeedFile = $_ENV['SECRET_IV_FILE'];
            }

            $ivSeed = rtrim(file_get_contents($ivSeedFile));
        }
    }

    function encryptString($string) {

        $secretKey = $this->getSecretKey();
        $ivSeed = $this->getSecretIv();
        $cipher = "AES-256-CBC";
        $key = hash('sha256', $secretKey);
        $iv = substr(hash('sha256', $ivSeed), 0, 16);
    
        $encryptedString = base64_encode(openssl_encrypt($string, $cipher, $key, 0, $iv));
    
        return $encryptedString;

    }

    function decryptString($string) {

        $secretKey = $this->getSecretKey();
        $ivSeed = $this->getSecretIv();
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