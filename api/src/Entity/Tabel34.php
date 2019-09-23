<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * Landen Tabels
 * 
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     collectionOperations={
 *     		"get"={
 *     			"method"="GET",
 *     			"path"="/tabel34"
 *     		}
 *     },
 *     itemOperations={
 *     		"get"={
 *     			"method"="GET", 
 *     			"path"="/tabel34/{landcode}"
 *     		}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\Tabel34Repository")
 */
class Tabel34
{
	
	/**
	 *
	 * @var string
	 *
     * @ApiFilter(SearchFilter::class, strategy="exact")
     * @Groups({"read"})
	 * @ApiProperty(identifier=true)
	 * @ORM\Id
	 * @Assert\Length(
	 *      min = 4,
	 *      max = 5,
	 * )
	 * @Assert\NotBlank
	 * @ORM\Column(type="string", length=5, unique=true)
	 */
	private $landcode;
	
	/**
	 *
	 * @var string
	 *
     * @ApiFilter(SearchFilter::class, strategy="partial")
     * @Groups({"read"})
	 * @Assert\Length(
	 *      max = 255,
	 * )
	 * @Assert\NotBlank
	 * @ORM\Column(type="string", length=255)
	 */
	private $omschrijving;
	
	/**
	 * @var string A "Y-m-d" formatted value
	 *
     * @Groups({"read"})
	 * @Assert\Date
	 * @ORM\Column(type="date", nullable=true)
	 */
	private $datumIngang;
	
	/**
	 * @var string A "Y-m-d" formatted value
	 *
     * @Groups({"read"})
	 * @Assert\Date
	 * @ORM\Column(type="date", nullable=true)
	 */
	private $datumEinde;
	
	/**
	 * @var string A "Y-m-d" formatted value
	 *
     * @Groups({"read"})
	 * @Assert\Date
	 * @ORM\Column(type="date", nullable=true)
	 */
	private $fictieveDatumEinde;

	public function getId(): ?string
    {
        return $this->id;
    }

    public function getLandcode(): ?string
    {
        return $this->landcode;
    }

    public function setLandcode(string $landcode): self
    {
        $this->landcode = $landcode;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getDatumIngang(): ?\DateTimeInterface
    {
        return $this->datumIngang;
    }

    public function setDatumIngang(?\DateTimeInterface $datumIngang): self
    {
        $this->datumIngang = $datumIngang;

        return $this;
    }

    public function getDatumEinde(): ?\DateTimeInterface
    {
        return $this->datumEinde;
    }

    public function setDatumEinde(?\DateTimeInterface $datumEinde): self
    {
        $this->datumEinde = $datumEinde;

        return $this;
    }

    public function getFictieveDatumEinde(): ?\DateTimeInterface
    {
        return $this->fictieveDatumEinde;
    }

    public function setFictieveDatumEinde(?\DateTimeInterface $fictieveDatumEinde): self
    {
        $this->fictieveDatumEinde = $fictieveDatumEinde;

        return $this;
    }
}
