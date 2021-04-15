<?php
declare(strict_types=1);

namespace Marigold\Domain\SharedKernel\Models;

trait Guid
{

    public function Guid(){
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }else{
            mt_srand((int)microtime()*10000);//optional for php 7.1.0 and up.
            $charid = strtoupper(bin2hex(openssl_random_pseudo_bytes(16)));
            $hyphen = chr(45);// "-"
            return vsprintf('%s%s-%s-%s-%s-%s%s%s',str_split($charid,4));
        }
    }
}