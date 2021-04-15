<?php
declare(strict_types=1);

namespace Marigold\Domain\BranchLocation\ValueObjects;

use Marigold\Domain\SharedKernel\Models\ValueObject,
    Marigold\Domain\SharedKernel\Exceptions\DomainException;

final class LocationType implements ValueObject
{
    /**
     * Location Type
     *
     * @var string $_locationType
     */
    private $_locationType;

    /**
     * locationTypeCode availabilty
     *
     * @var array locationTypeCode
     */
    public static $locationTypeCode = [
        'locationType', 'DISTRICT', 'AREA', 'BRANCH'
    ];

    /**
     * @param string $_locationType locationTypeCode
     *
     * @throws \Exception When the location type is invalid
     */
    public function __construct($locationType)
    {

        $locationType = strtoupper((string)$locationType);

        if (is_null($locationType)) {
            $message_template = "Null location type. :locationType";
            $payload = [
                'locationType' => $locationType
            ];
            throw DomainException::withProblem('NULL_LOCATIONTYPE', $message_template, $payload);
        }

        if (empty($locationType)) {
            $message_template = "Empty location type . :locationType";
            $payload = [
                'locationType' => $locationType
            ];
            throw DomainException::withProblem('EMPTY_LOCATIONTYPE', $message_template, $payload);
        }

        if (!in_array($locationType, self::$locationTypeCode)) {
            $message_template = "Null locationType name. :locationType";
            $payload = [
                'locationType' => $locationType
            ];
            throw DomainException::withProblem('INVALID_LOCATIONTYPE', $message_template, $payload);
        }

        $this->_locationType = $locationType;
    }

    public function __toString() : string
    {
        try 
        {
            return (string) $this->_locationType;
        } 
        catch (\Exception $exception) 
        {
            throw new \InvalidArgumentException("Location Type:{$locationType} -  is not a string.");
        }
    }

    public static function Create(string $locationType) : self
    {
        return new self(
            $locationType->_locationType
        );
    }

    public function isEqualsTo(LocationType $locationType): bool
    {
        return $this->hash() === $locationType->hash();
    }


    private function hash(): string
    {
        return md5("{$this->_locationType}");
    }
}