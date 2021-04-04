<?php
declare(strict_types=1);


namespace Marigold\Domain\BranchLocation\ValueObjects;

use Marigold\Domain\SharedKernel\Exceptions\DomainException;



final class RegionName
{
    public const MINIMUM_CHARACTER = 2;
    public const MAXIMUM_CHARACTER = 30;
    public const VALID_REGIONNAME = "/[^a-z_\-0-9 .\-]/i";
    
    private string $_regionName;
    // referrence https://dev.to/ianrodrigues/writing-value-objects-in-php-4acg

    public function __construct(string $regionName)
    {
        $this->SetRegionName($regionName);
    }

    private function SetRegionName($regionName)
    {
        //TASK: add unit testing
        //TASK: define uncover unit test 
        //TASK: add doctrine ORM
        //TASK: custom exception method that is usable to tests to0
        if (is_null($regionName)) {
            $message_template = "Null region name. :regionName";
            $payload = [
                'regionName' => $regionName
            ];
            throw DomainException::withProblem('NULL_REGIONNAME', $message_template, $payload);
        }

        if (empty($regionName)) {
            $message_template = "Empty region name. :regionName";
            $payload = [
                'regionName' => $regionName
            ];
            throw DomainException::withProblem('EMPTY_REGIONNAME', $message_template, $payload);
        }

        if(preg_match(RegionName::VALID_REGIONNAME, $regionName))
        {
            $message_template = ":regionName is not a valid Region Name";
            $payload = [
                'regionName' => $regionName
            ];
            throw DomainException::withProblem('EMPTY_REGIONNAME', $message_template, $payload);
        }
        
        if ( strlen($regionName) > RegionName::MAXIMUM_CHARACTER) {
            $message_template = "The maximum characters of Region name should be ". RegionName::MAXIMUM_CHARACTER.". :regionName character count is " . strlen($regionName) . ".";
            $payload = [
                'regionName' => $regionName
            ];
            throw DomainException::withProblem('MAXIMUM_REGIONNAME', $message_template, $payload);
        }

        if ( strlen($regionName) < RegionName::MINIMUM_CHARACTER) {
            $message_template = "The minimum characters of Region Name should be ". RegionName::MINIMUM_CHARACTER.". :regionName character count is " . strlen($regionName) . ".";
            $payload = [
                'regionName' => $regionName
            ];
            throw DomainException::withProblem('MINIMUM_REGIONNAME', $message_template, $payload); 
        }
       
        $this->_regionName = $regionName;
    }
    

    public function __toString()
    {
        try 
        {
            return (string) $this->_regionName;
        } 
        catch (\Exception $exception) 
        {
            throw new \InvalidArgumentException("Region Name:{$regionName} -  is not a string.");
        }
    }

    public function isEqualsTo(RegionName $regionName): bool
    {
        return $this->hash() === $regionName->hash();
    }

    private function hash(): string
    {
        return md5("{$this->_regionName}");
    }
}