<?php
declare(strict_types=1);
 
namespace Marigold\Domain\BranchLocation;

use Marigold\Domain\BranchLocation\ValueObjects\RegionName,
    Marigold\Domain\BranchLocation\Interfaces\RegionContracts,
    Marigold\Domain\SharedKernel\Models\Entity,
    Marigold\Domain\SharedKernel\Arrayable;

class Region extends Entity implements RegionContracts{
    use Arrayable;

    private int $_regionId = 0;
    private RegionName $_regionName;
    private $_region= array();
    //TODO: array push

    public function __construct(RegionName $regionName )
    {
        $this->setRegionName($regionName);
    }

    public function setRegionId(int $regionId)
    {
	    $this->_regionId = $regionId;	
       // $this->_region['regionId'] =  $this->getRegionId();
       $this->array_push_assoc($this->_region, 'regionId', $this->getRegionId());
	}

	public function setRegionName(RegionName $regionName)
    {
		$this->_regionName = $regionName;	
       // $this->_region['regionName'] = $this->getRegionName();
       $this->array_push_assoc($this->_region, 'regionName', $this->getRegionName());
	}

    public function getRegionId() : int 
    {
		return $this->_regionId;	
	}
    
    public function getRegionName() : string
    {
		return $this->_regionName->__toString();	
	}

    //factories
    public function __toArray() : array{
        return $this->objectToArray($this->_region);


    }
}