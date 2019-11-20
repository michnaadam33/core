<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Core\Tests\Fixtures\TestBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"bicycle_read"}},
 *     "denormalization_context"={"groups"={"bicycle_write"}}
 * })
 * @ORM\Entity
 */
class VoDummyBicycle extends VoDummyVehicle
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Groups({"bicycle_read", "bicycle_write"})
     */
    private $weight;

    /**
     * @var VoDummyInspection[]|Collection
     *
     * @ORM\OneToMany(targetEntity="VoDummyInspection", mappedBy="vehicle", cascade={"persist"})
     * @Groups({"bicycle_read", "bicycle_write"})
     */
    private $inspections;

    public function __construct(
        string $make,
        VoDummyInsuranceCompany $insuranceCompany,
        array $drivers,
        int $weight,
        string $bodyType = 'coupe'
    ) {
        parent::__construct($make, $insuranceCompany, $drivers);
        $this->weight = $weight;
        $this->bodyType = $bodyType;
        $this->inspections = new ArrayCollection();
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getInspections()
    {
        return $this->inspections;
    }
}
