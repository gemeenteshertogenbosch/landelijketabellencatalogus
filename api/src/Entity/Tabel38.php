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
 * Adellijke titel/predikaat
 * 
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     collectionOperations={
 *     		"get"={
 *     			"method"="GET",
 *     			"path"="/tabel38"
 *     		}
 *     },
 *     itemOperations={
 *     		"get"={
 *     			"method"="GET", 
 *     			"path"="/tabel38/uuid/{id}",
 *     			"swagger_context" = {"summary"="Haal Adellijke titel/predikaat op UUID", "description"="Beschrijving"}
 *     		},
 *     		"get_on_code"={
 *     			"method"="GET", 
 *     			"path"="/tabel38/{code}",
 *     			"requirements"={"code"="\d+"}, 
 *     			"swagger_context" = {
 *     				"summary"="Haal Adellijke titel/predikaat op code", 
 *     				"description"="Beschrijving",
 *                  "parameters" = {
 *                      {
 *                          "name" = "code",
 *                          "in" = "path",
 *                          "description" = "De Adellijke titel/predikaat code waarop wordt gezocht",
 *                          "required" = "true",
 *                          "type" : "string",
 *                          "example" : "0001"
 *                      }
 *                  }
 *     			}
 *     		}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\Tabel38Repository")
 */
class Tabel38
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
	private $adellijkeTitelPredikaat;
	
	/**
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
	 * @var string
	 *
	 * @Groups({"read"})
	 * @Assert\Length(
	 *      max = 255,
	 * )
	 * @Assert\NotBlank
	 * @ORM\Column(type="string", length=255)
	 */
	private $soort;

    public function getId()
    {
        return $this->id;
    }

    public function getAdellijkeTitelPredikaat(): ?string
    {
        return $this->adellijkeTitelPredikaat;
    }

    public function setAdellijkeTitelPredikaat(string $adellijkeTitelPredikaat): self
    {
        $this->adellijkeTitelPredikaat = $adellijkeTitelPredikaat;

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
}
