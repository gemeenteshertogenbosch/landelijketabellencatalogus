<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\RSIN;

class RSINFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$csv = fopen(dirname(__FILE__).'/Resources/RSIN.csv', 'r');
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
    		
    		// Lets skip empty lines
    		if(!$line[1]){
    			$i++;
    			continue;
    		}
    		
    		//var_dump($line);
    		// Creating the enity fro the csv values
	    	$entity = New RSIN();
	    	$entity->setRSIN($line[1]);
	    	$entity->setGemeenteCode($line[2]);
	    	$entity->setKVK($line[3]);
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
