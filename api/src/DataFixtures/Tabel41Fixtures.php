<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Tabel41;

class Tabel41Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$csv = fopen(dirname(__FILE__).'/Resources/Tabel41_Reden_ontbinding_nietigverklaring_huwelijk_geregistreerd_partnerschap.csv', 'r');
    	$i = 0;
    	
    	//var_dump(array_map("str_getcsv", file(dirname(__FILE__).'/Resources/Tabel32_Nationaliteitentabel.csv')));
    	while (!feof($csv)) {   
    		// Lets get a line from the csv file
    		$line = fgetcsv($csv);
    		
    		// Lets skip the first line sine it contains colum names
    		if($i == 0){
    			$i++;
    			continue;
    		}
    		
    		// Creating the enity fro the csv values
	    	$entity = New Tabel41();
	    	$entity->setRedenOntbindingNietigverklaringHuwelijkGeregistreerdPartnerschap($line[0]);
	    	$entity->setOmschrijving($line[1]);
	    	if($line[2] && $datumIngang = date_create_from_format('Ymd', $line[2])){$entity->setDatumIngang($datumIngang);}
	    	if($line[3] && $datumEinde = date_create_from_format('Ymd', $line[3])){$entity->setDatumEinde($datumEinde);}
	    	
	    	// Persisting the enity 
	    	$manager->persist($entity);
	    	
	    	// Every 25 rows we want to save to the database and clear our objects in order to prevent an extreme memory load
	    	if (($i % 25) === 0) {
	    		$manager->flush(); // Saves our entities to the database
	    		$manager->clear(); // Detaches all objects from Doctrine
	    	}
	    	
	    	$i++;
    	}
    	
    	$manager->flush(); // Saves our entities to the database
    	$manager->clear(); // Detaches all objects from Doctrine
    }
}
