<?php
declare(strict_types=1);

namespace Marigold\Domain\BranchLocation\ValueObjects;

use Marigold\Domain\SharedKernel\Models\ValueObject,
    Marigold\Domain\SharedKernel\Exceptions\DomainException;

final class DistrictName implements ValueObject
{
    public const MINIMUM_CHARACTER = 2;
    public const MAXIMUM_CHARACTER = 60;
    public const VALID_DISTRICTNAME = "/[^a-z_\-0-9 .\-]/i";
    
    protected string $_districtName;
    // referrence https://dev.to/ianrodrigues/writing-value-objects-in-php-4acg

    public function __construct(string $districtName)
    {
        //TASK: add unit testing
        //TASK: define uncover unit test 
        //TASK: add doctrine ORM
        //TASK: custom exception method that is usable to tests to0
        if (is_null($districtName)) {
            $message_template = "Null region name. :districtName";
            $payload = [
                'districtName' => $districtName
            ];
            throw DomainException::withProblem('NULL_DISTRICTNAME', $message_template, $payload);
        }

        if (empty($districtName)) {
            $message_template = "Empty region name. :districtName";
            $payload = [
                'districtName' => $districtName
            ];
            throw DomainException::withProblem('EMPTY_DISTRICTNAME', $message_template, $payload);
        }

        if(preg_match(DistrictName::VALID_DISTRICTNAME, $districtName))  
        {
            $message_template = ":districtName is not a valid Region Name";
            $payload = [
                'districtName' => $districtName
            ];
            throw DomainException::withProblem('INVALID_FORMAT_DISTRICTNAME', $message_template, $payload);
        }
        
        if ( strlen($districtName) > DistrictName::MAXIMUM_CHARACTER) {
            $message_template = "The maximum characters of Region name should be ". DistrictName::MAXIMUM_CHARACTER.". :districtName character count is " . strlen($districtName) . ".";
            $payload = [
                'districtName' => $districtName
            ];
            throw DomainException::withProblem('MAXIMUM_DISTRICTNAME', $message_template, $payload);
        }

        if ( strlen($districtName) < DistrictName::MINIMUM_CHARACTER) {
            $message_template = "The minimum characters of Region Name should be ". DistrictName::MINIMUM_CHARACTER.". :districtName character count is " . strlen($districtName) . ".";
            $payload = [
                'districtName' => $districtName
            ];
            throw DomainException::withProblem('MINIMUM_DISTRICTNAME', $message_template, $payload); 
        }
       
        $this->_districtName = $districtName;
    }
    
    public function __toString() : string
    {
        try 
        {
            return strtolower((string)$this->_districtName);
        } 
        catch (\Exception $exception) 
        {
            throw new \InvalidArgumentException("Region Name:{$districtName} -  is not a string.");
        }
    }

    public static function Create(string $districtName) : self
    {
        return new self(
            $districtName->_districtName
        );
    }

    public function isEqualsTo(DistrictName $districtName): bool
    {
        return $this->hash() === $districtName->hash();
    }


    private function hash(): string
    {
        return md5("{$this->_districtName}");
    }
}