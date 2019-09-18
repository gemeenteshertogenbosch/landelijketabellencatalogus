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
            'headers' => ['ovio-api-key' => '9555d033b9cbbb51f06758280c3eb5f6e3e234acc28add4b4c09d7ee59b31420']
        ]);
    }
    
    public function getKvKForGemeente($naam)
    {
    	// Hack-fix becouse open api wont acccept -
    	$name = explode("-",$naam);
    	$name = $name[0];
    	
        // Lets first try the cach
        $item = $this->cash->getItem('openoverheid_kvk_'.md5($naam));
        if ($item->isHit()) {
            return $item->get();
        }
        
        // Oke so we don't have it on cash, let get it from live
        //$query = 'query='.$naam.'&queryfields[]=handelsnaam&filters[sbi]=8411';
        $response = $this->client->request('GET','/openkvk?query=Gemeente '.$naam.'&queryfields[]=handelsnaam&fields[]=rsin&fields[]=subdossiernummer&filters[sbi]=8411');
        
        $response = json_decode($response->getBody(), true);
                
        //We are up to something if we only have 1 hit
        if(array_key_exists ('_embedded', $response) && count($response['_embedded']['bedrijf']) == 1){
            
            $item->set($response['_embedded']['bedrijf'][0]);
            $item->expiresAt(new \DateTime('tomorrow'));
            $this->cash->save($item);
            
            return $item->get();
        }
        elseif(array_key_exists('_embedded', $response) && count($response['_embedded']['bedrijf']) > 1){
        	foreach($response['_embedded']['bedrijf'] as $bedrijf){
        		if(!array_key_exists('subdossiernummer', $bedrijf) && strtolower($bedrijf['handelsnaam']) == strtolower('Gemeente '.$naam )){
        			$item->set($bedrijf);
        			$item->expiresAt(new \DateTime('tomorrow'));
        			$this->cash->save($item);
        			
        			return $item->get();
        			
        		}
        	}
        }
        //If not then we are in error
        else{
        	$response = $this->client->request('GET','/openkvk?query=Gemeente '.$naam.'&queryfields[]=handelsnaam&fields[]=rsin&fields[]=subdossiernummer&exists=rsin');
        	$response = json_decode($response->getBody(), true);
        }
        
        //We are up to something if we only have 1 hit
        if(array_key_exists ('_embedded', $response) && count($response['_embedded']['bedrijf']) == 1){
        	
        	$item->set($response['_embedded']['bedrijf'][0]);
        	$item->expiresAt(new \DateTime('tomorrow'));
        	$this->cash->save($item);
        	
        	return $item->get();
        }
        elseif(array_key_exists('_embedded', $response) && count($response['_embedded']['bedrijf']) > 1){
        	foreach($response['_embedded']['bedrijf'] as $bedrijf){
        		if(!array_key_exists('subdossiernummer', $bedrijf) && strtolower($bedrijf['handelsnaam']) == strtolower('Gemeente '.$naam )){
        			$item->set($bedrijf);
        			$item->expiresAt(new \DateTime('tomorrow'));
        			$this->cash->save($item);
        			
        			return $item->get();
        			
        		}
        	}
        }
        //If not then we are in error
        else{
        	//$response = $this->client->request('GET','/openkvk?query=Gemeente '.$naam.'&queryfields[]=handelsnaam&fields[]=rsin&exists=rsin');
        }
        
        var_dump($name);
        return false;
            
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
        
        //var_dump($response);
        $rsin = New RSIN;
        $rsin->setRSIN($response['rsin']);
        $rsin->setKVK($response['dossiernummer']);
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
