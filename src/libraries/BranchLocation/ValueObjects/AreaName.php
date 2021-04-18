<?php
declare(strict_types=1);

namespace Marigold\Domain\BranchLocation\ValueObjects;

use Marigold\Domain\SharedKernel\Models\ValueObject,
    Marigold\Domain\SharedKernel\Exceptions\DomainException;

final class AreaName implements ValueObject
{
    public const MINIMUM_CHARACTER = 2;
    public const MAXIMUM_CHARACTER = 60;
    public const VALID_AREANAME = "/[^a-z_\-0-9 .\-]/i";
    
    protected string $_areaName;
    // referrence https://dev.to/ianrodrigues/writing-value-objects-in-php-4acg

    public function __construct(string $areaName)
    {
        //TASK: add unit testing
        //TASK: define uncover unit test 
        //TASK: add doctrine ORM
        //TASK: custom exception method that is usable to tests to0
        if (is_null($areaName)) {
            $message_template = "Null region name. :areaName";
            $payload = [
                'areaName' => $areaName
            ];
            throw DomainException::withProblem('NULL_AREANAME', $message_template, $payload);
        }

        if (empty($areaName)) {
            $message_template = "Empty region name. :areaName";
            $payload = [
                'areaName' => $areaName
            ];
            throw DomainException::withProblem('EMPTY_AREANAME', $message_template, $payload);
        }

        if(preg_match(AreaName::VALID_AREANAME, $areaName))  
        {
            $message_template = ":areaName is not a valid Region Name";
            $payload = [
                'areaName' => $areaName
            ];
            throw DomainException::withProblem('INVALID_FORMAT_AREANAME', $message_template, $payload);
        }
        
        if ( strlen($areaName) > AreaName::MAXIMUM_CHARACTER) {
            $message_template = "The maximum characters of Region name should be ". AreaName::MAXIMUM_CHARACTER.". :areaName character count is " . strlen($areaName) . ".";
            $payload = [
                'areaName' => $areaName
            ];
            throw DomainException::withProblem('MAXIMUM_AREANAME', $message_template, $payload);
        }

        if ( strlen($areaName) < AreaName::MINIMUM_CHARACTER) {
            $message_template = "The minimum characters of Region Name should be ". AreaName::MINIMUM_CHARACTER.". :areaName character count is " . strlen($areaName) . ".";
            $payload = [
                'areaName' => $areaName
            ];
            throw DomainException::withProblem('MINIMUM_AREANAME', $message_template, $payload); 
        }
       
        $this->_areaName = $areaName;
    }
    
    public function __toString() : string
    {
        try 
        {
            return strtolower((string)$this->_areaName);
        } 
        catch (\Exception $exception) 
        {
            throw new \InvalidArgumentException("Region Name:{$areaName} -  is not a string.");
        }
    }

    public static function Create(string $areaName) : self
    {
        return new self(
            $areaName->_areaName
        );
    }

    public function isEqualsTo(AreaName $areaName): bool
    {
        return $this->hash() === $areaName->hash();
    }


    private function hash(): string
    {
        return md5("{$this->_areaName}");
    }
}