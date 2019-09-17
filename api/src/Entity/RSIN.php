<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiFilter;
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
 *     		"get"
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
     * @Groups({"read"})
     * @Assert\Length(
     *      max = 4,
     *      min = 4,
     * )
     * @ORM\Column(type="string", length=4)
     */
    private $gemeenteCode;

    public function getId(): ?int
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
