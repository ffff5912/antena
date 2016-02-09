<?php
namespace App\Factory;

use Doctrine\Common\Collections\ArrayCollection;

interface FactoryInterface
{
    /**
     * @param  ArrayCollection $data
     */
    public function build(ArrayCollection $data);
}
