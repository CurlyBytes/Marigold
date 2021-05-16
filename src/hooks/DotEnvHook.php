<?php

class DotEnvHook
{
    public function LoadEnvironment()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(FCPATH . '..');
        $dotenv->safeLoad();
        $dotenv->required(['GOOGLE_API_KEY','DATABASE_HOSTNAME','DATABASE_NAME','DATABASE_USERNAME','DATABASE_PASSWORD'])
        ->notEmpty();
        
    }
}
