<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;

use App\Service\OpenOverheidService;

class CommongroundTabel33RsinCommand extends Command
{
    /**
     * @var EntityManagerInterface
     * @var OpenOverheidService
     */
    private $em;
    private $openOverheidService;
    
    public function __construct(EntityManagerInterface $em, OpenOverheidService $openOverheidService)
    {
        $this->em = $em;
        $this->openOverheidService = $openOverheidService;
        
        parent::__construct();
    }
    
    protected static $defaultName = 'commonground:tabel33:rsin';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
                
        // Lets loop through all the gemeente codes that we have
        foreach($this->em->getRepository('App:Tabel33')->findAll() as $tabel33){
            // Lets skip if this gemeente is onbekend
            if($tabel33->getGemeenteCode() == "0000"){
                $io->warning('Skipped '.$tabel33->getOmschrijving().'('.$tabel33->getGemeenteCode().') becouse it is the deafult');
                continue;
            }
            // Lets skip if this gemeente is onbekend
            if($tabel33->getGemeenteCode() == "1999"){
            	$io->warning('Skipped '.$tabel33->getOmschrijving().'('.$tabel33->getGemeenteCode().') becouse it is onbekend');
            	continue;
            }
            // Lets skip if this gemeente is nomore
            if($tabel33->getDatumEinde()){                
                $io->warning('Skipped '.$tabel33->getOmschrijving().'('.$tabel33->getGemeenteCode().') becouse it is no longer a valid gemeente');
                continue;
            }
            
            // Lets get the date
            $rsin = $this->openOverheidService->getRSINFromTabel33($tabel33);
            if($rsin){
                $io->success('Checked '.$tabel33->getOmschrijving().'('.$tabel33->getGemeenteCode().') as RSIN:'.$rsin->getRSIN());                
            }
            else{
                $io->error('Skipped '.$tabel33->getOmschrijving().'('.$tabel33->getGemeenteCode().') for invalid responce');                
            }
        }

    }
}
