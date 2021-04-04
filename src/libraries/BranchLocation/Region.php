<?php
declare(strict_types=1);
 
namespace Marigold\Domain\BranchLocation;

use Marigold\Domain\BranchLocation\ValueObjects\RegionName;
use Marigold\Domain\BranchLocation\Exceptions;
use Marigold\Domain\SharedKernel\Arrayable;

class Region {
    use Arrayable;
    private int $_regionId;
    private RegionName $_regionName;
   // private list $_districts 

    public function __construct(int $regionId, RegionName $regionName )
    {
        $this->SetRegionId($regionId);
        $this->SetRegionName($regionName);
    }

    public function SetRegionId(int $regionId)
    {
		$this->_regionId = $regionId;	
	}

	public function SetRegionName(RegionName $regionName)
    {
		$this->_regionName = $regionName;	
	}

    public function GetRegionId() : int 
    {
		return $this->_regionId;	
	}
    
    // Typical ValueObjects
	// public function GetRegionName() : RegionName
    // {
	// 	return $this->_regionName;	
	// }

    public function GetRegionName() : string
    {
		return $this->_regionName->__toString();	
	}


    //$object_id = array_column($my_object, 'id');
    //factories
    public static function Create(int $regionId, RegionName $regionName )
    {
        $this->__construct($regionId, $regionName);
    }

    public function AddDistrict(District $district) : void
    {
        $this->__construct($district);
    }

    public function __toArray() : array{
        $fromObjectToArray = [
            'regionId' => $this->GetRegionId(),
            'regionName' => $this->GetRegionName()
        ];
        return $this->objectToArray($fromObjectToArray);
      
    }
    

    public static function FromArray(array $input): self 
    {
        // TASK: optional $input validation  
        return new self(
            $input['regionId'],
            $input['regionName']
        );
    }
}