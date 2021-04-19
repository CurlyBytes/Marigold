<?php
defined('BASEPATH') or exit('No direct script access allowed');


use Marigold\Domain\SharedKernel\Models\Entity,
    Marigold\Domain\SharedKernel\Models\Guid,
    Marigold\Domain\SharedKernel\Arrayable;


class MariGold_Controller extends CI_Controller
{
    use Arrayable, Guid;

    public function __construct()
    {
        parent::__construct();
    }
}
