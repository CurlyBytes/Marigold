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

    protected  string $regionId;
    protected  RegionName $regionName;
    protected  $region= array();
    protected  $district= array();


    public function __construct(RegionName $regionName, string $regionId = null)
    {
        $this->setRegionId($regionId);
        $this->setRegionName($regionName);
    }

    public function setRegionId(string $regionId = null)
    {
        if (isset($regionId) && is_null($regionId)) {
            $this->regionId = $regionId;
        } else {
            $this->regionId = $this->Guid();
        }
       // $this->region['regionId'] =  $this->getRegionId();
       $this->array_push_assoc($this->region, 'regionId', $this->getRegionId());
	}

	public function setRegionName(RegionName $regionName)
    {
		$this->regionName = $regionName;	
        // $this->region['regionName'] = $this->getRegionName();
        $this->array_push_assoc($this->region, 'regionName', $this->getRegionName());
	}

    public function NewDistrict(DistrictName $districtName) 
    {
        $district = new District();
        $district->setDistrictName($districtName);

        $this->array_push_assoc($this->district, 'district', $district->properties());
        $this->array_push_assoc($this->region, 'district', $this->district);
	}

    public function RemoveDistrict(string $districtId) 
    {
        $district = new District();
        $district->setDistrictName($districtName);

        $this->array_pull_multi_assoc($this->district, 'district', $district->properties());
        $this->array_pull_multi_assoc($this->region, 'district', $this->district);
	}


    public function getRegionId() : string 
    {
		return $this->regionId;	
	}
    
    public function getRegionName() : string
    {
		return $this->regionName->__toString();	
	}

    //factories
    public function properties() : array
    {
        return $this->objectToArray($this->region);
    }
}