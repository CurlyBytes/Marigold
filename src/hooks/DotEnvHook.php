<?php

class DotEnvHook
{
    public function LoadEnvironment()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(FCPATH . '..');
        $dotenv->load();
    }
}
