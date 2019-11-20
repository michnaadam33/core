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
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(attributes={
 *     "normalization_context"={"groups"={"inspection_read"}},
 *     "denormalization_context"={"groups"={"inspection_write"}}
 * })
 * @ORM\Entity
 */
class VoDummyInspection
{
    use VoDummyIdAwareTrait;

    /**
     * @var bool
     *
     * @ORM\Column(type="boolean")
     * @Groups({"car_read", "car_write", "bicycle_read", "bicycle_write", "inspection_read", "inspection_write"})
     */
    private $accepted;

    /**
     * @var VoDummyVehicle
     *
     * @ORM\ManyToOne(targetEntity="VoDummyVehicle", inversedBy="inspections")
     * @Groups({"inspection_read", "inspection_write"})
     */
    private $vehicle;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="datetime")
     * @Groups({"car_read", "car_write", "bicycle_read", "bicycle_write", "inspection_read", "inspection_write"})
     */
    private $performed;

    private $attributeWithoutConstructorEquivalent;

    public function __construct(bool $accepted, VoDummyVehicle $vehicle, DateTime $performed = null, string $parameterWhichIsNotClassAttribute = '')
    {
        $this->accepted = $accepted;
        $this->vehicle = $vehicle;
        $this->performed = $performed ?: new DateTime();
        $this->attributeWithoutConstructorEquivalent = $parameterWhichIsNotClassAttribute;
    }

    public function isAccepted()
    {
        return $this->accepted;
    }

    public function getVehicle()
    {
        return $this->vehicle;
    }

    public function getPerformed()
    {
        return $this->performed;
    }

    public function setPerformed(DateTime $performed)
    {
        $this->performed = $performed;

        return $this;
    }
}
