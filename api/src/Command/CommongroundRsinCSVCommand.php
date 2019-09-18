<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;

use App\Service\OpenOverheidService;

class CommongroundRsinCSVCommand extends Command
{
    /**
     * @var EntityManagerInterface
     * @var OpenOverheidService
     */
    private $em;
    private $openOverheidService;
    private $serializer;
    
    public function __construct(EntityManagerInterface $em, OpenOverheidService $openOverheidService, SerializerInterface $serializer)
    {
        $this->em = $em;
        $this->openOverheidService = $openOverheidService;
        $this->serializer= $serializer;
        
        parent::__construct();
    }
    
    protected static $defaultName = 'commonground:rsin:csv';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
       
        $io = new SymfonyStyle($input, $output);
        $rsins = $this->em->getRepository('App:RSIN')->findAll();
        
        $io->warning('Found '.count($rsins).' RSIN numbers to export');
        
        $myfile = fopen('src/DataFixtures/Resources/RSIN.csv', "w") or die("Unable to open file!");
        fwrite($myfile, '"id","rsin","gemeenteCode","kvk"'."\n");
        foreach($rsins as $rsin){
        	fwrite($myfile, $rsin->getId().','.$rsin->getRSIN().','.$rsin->getGemeenteCode().','.$rsin->getKVK()."\n");
        }        
        fclose($myfile);
        
        $io->warning('CSV Export complete');
        
        $json = $this->serializer->serialize($rsins,'json');
        
        $io->warning('json Export complete');
        
        $myfile = fopen('src/DataFixtures/Resources/RSIN.json', "w") or die("Unable to open file!");
        fwrite($myfile, $json);
        fclose($myfile);
        
        $io->success('Writen exports to csv file');                

    }
}
