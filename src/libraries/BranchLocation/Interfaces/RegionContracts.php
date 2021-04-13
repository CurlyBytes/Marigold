<?php
declare(strict_types=1);
 
namespace Marigold\Domain\BranchLocation\Interfaces;

use Marigold\Domain\BranchLocation\ValueObjects\RegionName;

interface RegionContracts
{
 	public function setRegionId(int $regionId);
 	public function getRegionId() : int;
 	public function setRegionName(RegionName $regionName);
 	public function getRegionName() : string;
  //  public function create(RegionName $regionName) : self;
}