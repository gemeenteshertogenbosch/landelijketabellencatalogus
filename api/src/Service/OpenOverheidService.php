<?php
// Conduction/CommonGroundBundle/Service/RequestTypeService.php

/*
 * This file is part of the Conduction Common Ground Bundle
 *
 * (c) Conduction <info@conduction.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use GuzzleHttp\Client ;
use Symfony\Component\Cache\Adapter\AdapterInterface as CacheInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

use App\Entity\RSIN;
use App\Entity\Tabel33;

class OpenOverheidService
{
    private $em;
    private $params;
    private $cash;
    private $client;
    
    public function __construct(EntityManagerInterface $em, ParameterBagInterface $params, CacheInterface $cache)
    {
        $this->em = $em;
        $this->params = $params;
        $this->cash = $cache;
        
        $this->client= new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.overheid.io/openkvk',
            // You can set any number of default request options.
            'timeout'  => 4000.0,
            // This api key needs to go into params
            //'headers' => ['ovio-api-key' => $this->params->get('common_ground.openoverheid.apikey')]
            'headers' => ['ovio-api-key' => '07d3d36bad7b6c47a7825414032e16d9170e093ff9c06c594fd0c423cea510c6']
        ]);
    }
    
    public function getKvKForGemeente($naam)
    {
        // Lets first try the cach
        $item = $this->cash->getItem('openoverheid_kvk_'.md5($naam));
        if ($item->isHit()) {
            return $item->get();
        }
        
        // Oke so we don't have it on cash, let get it from live
        $query = 'query='.$naam.'&queryfields[]=handelsnaam&filters[sbi]=8411';
        $response = $this->client->request('GET','/openkvk?query=Gemeente '.$naam.'&queryfields[]=handelsnaam&fields[]=rsin&filters[sbi]=8411');
        
        $response = json_decode($response->getBody(), true);
                
        //var_dump($response);
        //We are up to something if we only have 1 hit
        if(array_key_exists ('_embedded', $response) && count($response['_embedded']) == 1){
            
            $item->set($response['_embedded']);
            $item->expiresAt(new \DateTime('tomorrow'));
            $this->cash->save($item);
            
            return $item->get();
        }
        //If not then we are in error
        else{
            return false;
        }
            
    }
    
    
    public function getRSINFromTabel33(Tabel33 $tabel33)
    {        
        /// lets first try the database        
        if($rsin = $this->em->getRepository('App:RSIN')->findOneBy(array('gemeenteCode' => $tabel33->getGemeenteCode()))){
            return $rsin;
        }
        
        // If we dont hit the databse we need to maken a new entity 
        $response = $this->getKvKForGemeente($tabel33->getOmschrijving());
        
        If(!$response){
            return false;    
        }
        
        $rsin = New RSIN;
        $rsin->setRSIN($response['bedrijf'][0]['rsin']);
        $rsin->setKVK($response['bedrijf'][0]['dossiernummer']);
        $rsin->setOPenKVK('bla bla');
        $rsin->setGemeenteCode($tabel33->getGemeenteCode());
        
        $this->em->persist($rsin);
        $this->em->flush();
        
        return $rsin;
    }
        
    /*  @todo at the end of it we want to export it all to a csv file*/
    public function RsinToCSV()
    { 
        // Lets loop through all the gemeente codes that we have
        foreach($em->getRepository('App:Tabel33')->findAll() as $tabel33){
            
        }
        
    }
    
}
