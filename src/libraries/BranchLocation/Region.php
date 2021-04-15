<?php
declare(strict_types=1);
 
namespace Marigold\Domain\BranchLocation;

use Marigold\Domain\BranchLocation\ValueObjects\RegionName,
    Marigold\Domain\BranchLocation\ValueObjects\DistrictName,
    Marigold\Domain\BranchLocation\District,
    Marigold\Domain\SharedKernel\Models\Entity,
    Marigold\Domain\SharedKernel\Models\Guid,
    Marigold\Domain\SharedKernel\Arrayable;

class Region extends Entity{
    use Arrayable, Guid;

    private  string $_regionId;
    private  RegionName $_regionName;
    private  $_region= array();
    private  $_district= array();


    public function __construct(RegionName $regionName, string $regionId = null)
    {
        $this->setRegionName($regionName);
        $this->setRegionId($regionId);
    }

    public function setRegionId(string $regionId = null)
    {
        if (isset($regionId) && is_null($regionId)) {
            $this->_regionId = $regionId;
        } else {
            $this->_regionId = $this->Guid();
        }
       // $this->_region['regionId'] =  $this->getRegionId();
       $this->array_push_assoc($this->_region, 'regionId', $this->getRegionId());
	}

	public function setRegionName(RegionName $regionName)
    {
		$this->_regionName = $regionName;	
        // $this->_region['regionName'] = $this->getRegionName();
        $this->array_push_assoc($this->_region, 'regionName', $this->getRegionName());
	}

    public function NewDistrict(DistrictName $distrctName) 
    {
        $district = new District();
        $district->setDistrictName($distrctName);
        $this->array_push_assoc($this->_district, 'district', $district->properties());
        $this->array_push_assoc($this->_region, 'district', $this->_district);
	}


    public function RemoveDistrict(string $districtId) 
    {
        $district = new District();
        $district->setDistrictName($distrctName);

        $this->array_pull_assoc($this->_region, 'districtName', $this->_district);
	}


    public function getRegionId() : string 
    {
		return $this->_regionId;	
	}
    
    public function getRegionName() : string
    {
		return $this->_regionName->__toString();	
	}

    //factories
    public function properties() : array
    {
        return $this->objectToArray($this->_region);
    }
}