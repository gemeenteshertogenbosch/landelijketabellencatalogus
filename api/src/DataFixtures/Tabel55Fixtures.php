<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Tabel55;

class Tabel55Fixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
    	$csv = fopen(dirname(__FILE__).'/Resources/Tabel55_PK-Afnemers.csv', 'r');
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
	    	$entity = New Tabel55();
	    	$entity->setAfnemersaanduiding($line[0]);
	    	$entity->setOmschrijving($line[1]);
	    	
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
