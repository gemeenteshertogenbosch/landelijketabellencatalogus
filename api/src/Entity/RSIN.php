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
 *     			"path"="/rsin/{rsin}"
 *     		}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\RSINRepository")
 */
class RSIN
{    
    /**
     * @var string
     *
     * @ApiFilter(SearchFilter::class, strategy="exact")
     * @Groups({"read"})
	 * @ApiProperty(identifier=true)
	 * @ORM\Id
     * @Assert\Length(
     *      max = 9,
     *      min = 9,
     * )
     * @ORM\Column(type="string", length=9, unique=true)
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
     * @ApiFilter(SearchFilter::class, strategy="exact")
     * @Groups({"read"})
     * @Assert\Length(
     *      max = 4,
     *      min = 4,
     * )
     * @ORM\Column(type="string", length=4)
     */
	private $gemeenteCode;

	public function getId(): ?string
	{
		return $this->rsin;
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
