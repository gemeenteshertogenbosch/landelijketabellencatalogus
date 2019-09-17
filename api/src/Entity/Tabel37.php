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
 * redenOpnemenBeeindigenNationaliteit
 * 
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     collectionOperations={
 *     		"get"={
 *     			"method"="GET",
 *     			"path"="/tabel37"
 *     		}
 *     },
 *     itemOperations={
 *     		"get"={
 *     			"method"="GET", 
 *     			"path"="/tabel37/uuid/{id}",
 *     			"swagger_context" = {"summary"="Haal redenOpnemenBeeindigenNationaliteit op UUID", "description"="Beschrijving"}
 *     		},
 *     		"get_on_code"={
 *     			"method"="GET", 
 *     			"path"="/tabel37/{code}",
 *     			"requirements"={"code"="\d+"}, 
 *     			"swagger_context" = {
 *     				"summary"="Haal redenOpnemenBeeindigenNationaliteit op code", 
 *     				"description"="Beschrijving",
 *                  "parameters" = {
 *                      {
 *                          "name" = "code",
 *                          "in" = "path",
 *                          "description" = "De redenOpnemenBeeindigenNationaliteitcode waarop wordt gezocht",
 *                          "required" = "true",
 *                          "type" : "string",
 *                          "example" : "0001"
 *                      }
 *                  }
 *     			}
 *     		}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\Tabel37Repository")
 */
class Tabel37
{
	/**
	 * @var \Ramsey\Uuid\UuidInterface
	 *
	 * @Groups({"read"})
	 * @ApiProperty(identifier=true)
	 * @ORM\Id
	 * @ORM\Column(type="uuid", unique=true)
	 * @ORM\GeneratedValue(strategy="CUSTOM")
	 * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
	 */
	private $id;
	
    /**
     * 
     * @var string 
     * 
     * @ApiFilter(SearchFilter::class, strategy="exact")
     * @Groups({"read"})
     * @Assert\Length(
     *      max = 255,
     * )
     * @Assert\NotBlank
     * @ORM\Column(type="string", length=255)
     */
	private $redenOpnemenBeeindigenNationaliteit;
	
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
	 *
	 * @var string
	 *
     * @ApiFilter(SearchFilter::class, strategy="exact")
	 * @Groups({"read"})
	 * @Assert\Length(
	 *      max = 255,
	 * )
	 * @Assert\NotBlank
	 * @ORM\Column(type="string", length=255)
	 */
	private $soort;

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

    public function getId()
    {
        return $this->id;
    }

    public function getRedenOpnemenBeeindigenNationaliteit(): ?string
    {
        return $this->redenOpnemenBeeindigenNationaliteit;
    }

    public function setRedenOpnemenBeeindigenNationaliteit(string $redenOpnemenBeeindigenNationaliteit): self
    {
        $this->redenOpnemenBeeindigenNationaliteit = $redenOpnemenBeeindigenNationaliteit;

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

    public function getSoort(): ?string
    {
        return $this->soort;
    }

    public function setSoort(string $soort): self
    {
        $this->soort = $soort;

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
}
