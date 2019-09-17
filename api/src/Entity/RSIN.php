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
 * RSIN
 * 
 * Tevens te vinden via https://openkvk.nl/, te checken via SBI 8411 en naam gelijk aan  "Gemeente XXX"
 * 
 * @ApiResource(
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}},
 *     collectionOperations={
 *     		"get"={
 *     			"method"="GET",
 *     			"path"="/rsin"
 *     		}
 *     },
 *     itemOperations={
 *     		"get"={
 *     			"method"="GET", 
 *     			"path"="/rsin/uuid/{id}",
 *     			"swagger_context" = {"summary"="Haal RSIN op UUID", "description"="Beschrijving"}
 *     		},
 *     		"get_on_rsin"={
 *     			"method"="GET", 
 *     			"path"="/rsin/{rsin}",
 *     			"requirements"={"rsin"="\d+"}, 
 *     			"swagger_context" = {
 *     				"summary"="Haal RSIN op rsin", 
 *     				"description"="Beschrijving",
 *                  "parameters" = {
 *                      {
 *                          "name" = "rsin",
 *                          "in" = "path",
 *                          "description" = "De RSIN waarop wordt gezocht",
 *                          "required" = "true",
 *                          "type" : "string",
 *                          "example" : "0001"
 *                      }
 *                  }
 *     			}
 *     		}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\RSINRepository")
 */
class RSIN
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
     *      max = 9,
     *      min = 9,
     * )
     * @ORM\Column(type="string", length=9)
     */
    private $rsin;
	
	/**
	 * @var string
	 *
     * @ApiFilter(SearchFilter::class, strategy="exact")
	 * @Groups({"read"})
	 * @Assert\Length(
	 *      max = 9,
	 *      min = 9,
	 * )
	 * @ORM\Column(type="string", length=9)
	 */
	private $kvk;
	
	/**
	 * @var string
	 *
	 * @Assert\Length(
	 *      max = 9,
	 *      min = 9,
	 * )
	 * @ORM\Column(type="string", length=9)
	 */
	private $openKvk;

    /**     
     * @var string 
     * 
     * @ApiFilter(SearchFilter::class, strategy="exact")
     * @Groups({"read"})
     * @Assert\Length(
     *      max = 4,
     *      min = 4,
     * )
     * @ORM\Column(type="string", length=4)
     */
	private $gemeenteCode;

    public function getId()
    {
        return $this->id;
    }

    public function getRSIN(): ?string
    {
    	return $this->rsin;
    }

    public function setRSIN(string $RSIN): self
    {
    	$this->rsin = $RSIN;

        return $this;
    }
    
    public function getKVK(): ?string
    {
        return $this->kvk;
    }
    
    public function setKVK(string $kvk): self
    {
        $this->kvk = $kvk;
        
        return $this;
    }
    
    public function getOpenKVK(): ?string
    {
        return $this->openKvk;
    }
    
    public function setOpenKVK(string $openKvk): self
    {
        $this->openKvk = $openKvk;
        
        return $this;
    }

    public function getGemeenteCode(): ?string
    {
        return $this->gemeenteCode;
    }

    public function setGemeenteCode(string $gemeenteCode): self
    {
        $this->gemeenteCode = $gemeenteCode;

        return $this;
    }
}
