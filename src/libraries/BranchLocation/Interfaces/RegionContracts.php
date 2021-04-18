<?php
declare(strict_types=1);
 
namespace Marigold\Domain\BranchLocation\Interfaces;

use Marigold\Domain\BranchLocation\ValueObjects\RegionName;

interface RegionContracts
{
 	public function setRegionId(string $regionId);
 	public function getRegionId() : string;
 	public function setRegionName(RegionName $regionName);
 	public function getRegionName() : string;
  //  public function create(RegionName $regionName) : self;
}