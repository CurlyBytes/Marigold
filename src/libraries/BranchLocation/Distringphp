<?php
declare(strict_types=1);
 
namespace Marigold\Domain\BranchLocation;

use Marigold\Domain\BranchLocation\ValueObjects\DistrictName,
    Marigold\Domain\SharedKernel\Models\Entity,
    Marigold\Domain\SharedKernel\Arrayable;

class District extends Entity{
    use Arrayable;

    private int $_DistrictId = 0;
    private DistrictName $_DistrictName;
    private $_District= array();
    //TODO: array push

    public function __construct(DistrictName $DistrictName )
    {
        $this->setDistrictName($DistrictName);
    }

    public function setDistrictId(int $DistrictId)
    {
	    $this->_DistrictId = $DistrictId;	
       // $this->_District['DistrictId'] =  $this->getDistrictId();
       $this->array_push_assoc($this->_District, 'DistrictId', $this->getDistrictId());
	}

	public function setDistrictName(DistrictName $DistrictName)
    {
		$this->_DistrictName = $DistrictName;	
       // $this->_District['DistrictName'] = $this->getDistrictName();
       $this->array_push_assoc($this->_District, 'DistrictName', $this->getDistrictName());
	}

    public function getDistrictId() : int 
    {
		return $this->_DistrictId;	
	}
    
    public function getDistrictName() : string
    {
		return $this->_DistrictName->__toString();	
	}

    //factories
    public function __toArray() : array{
        return $this->objectToArray($this->_District);


    }
}