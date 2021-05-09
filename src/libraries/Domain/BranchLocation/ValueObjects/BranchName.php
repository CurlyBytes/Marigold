<?php
declare(strict_types=1);

namespace Marigold\Domain\BranchLocation\ValueObjects;

use Marigold\Domain\SharedKernel\Models\ValueObject,
    Marigold\Domain\SharedKernel\Exceptions\DomainException;

final class BranchName implements ValueObject
{
    public const MINIMUM_CHARACTER = 2;
    public const MAXIMUM_CHARACTER = 60;
    public const VALID_BRANCHNAME = "/[^a-z_\-0-9 .\-]/i";
    
    protected string $_branchName;
    // referrence https://dev.to/ianrodrigues/writing-value-objects-in-php-4acg

    public function __construct(string $branchName)
    {
        //TASK: add unit testing
        //TASK: define uncover unit test 
        //TASK: add doctrine ORM
        //TASK: custom exception method that is usable to tests to0
        if (is_null($branchName)) {
            $message_template = "Null region name. :branchName";
            $payload = [
                'branchName' => $branchName
            ];
            throw DomainException::withProblem('NULL_BRANCHNAME', $message_template, $payload);
        }

        if (empty($branchName)) {
            $message_template = "Empty region name. :branchName";
            $payload = [
                'branchName' => $branchName
            ];
            throw DomainException::withProblem('EMPTY_BRANCHNAME', $message_template, $payload);
        }

        if(preg_match(BranchName::VALID_BRANCHNAME, $branchName))  
        {
            $message_template = ":branchName is not a valid Region Name";
            $payload = [
                'branchName' => $branchName
            ];
            throw DomainException::withProblem('INVALID_FORMAT_BRANCHNAME', $message_template, $payload);
        }
        
        if ( strlen($branchName) > BranchName::MAXIMUM_CHARACTER) {
            $message_template = "The maximum characters of Region name should be ". BranchName::MAXIMUM_CHARACTER.". :branchName character count is " . strlen($branchName) . ".";
            $payload = [
                'branchName' => $branchName
            ];
            throw DomainException::withProblem('MAXIMUM_BRANCHNAME', $message_template, $payload);
        }

        if ( strlen($branchName) < BranchName::MINIMUM_CHARACTER) {
            $message_template = "The minimum characters of Region Name should be ". BranchName::MINIMUM_CHARACTER.". :branchName character count is " . strlen($branchName) . ".";
            $payload = [
                'branchName' => $branchName
            ];
            throw DomainException::withProblem('MINIMUM_BRANCHNAME', $message_template, $payload); 
        }
       
        $this->_branchName = $branchName;
    }
    
    public function __toString() : string
    {
        try 
        {
            return strtolower((string)$this->_branchName);
        } 
        catch (\Exception $exception) 
        {
            throw new \InvalidArgumentException("Region Name:{$branchName} -  is not a string.");
        }
    }

    public static function Create(string $branchName) : self
    {
        return new self(
            $branchName->_branchName
        );
    }

    public function isEqualsTo(BranchName $branchName): bool
    {
        return $this->hash() === $branchName->hash();
    }


    private function hash(): string
    {
        return md5("{$this->_branchName}");
    }
}