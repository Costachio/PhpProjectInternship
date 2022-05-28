<?php

namespace App\Handler;

use App\Entity\Stats;
use App\Exception\InvalidFormException;
use App\Form\StatsFormType;
use App\Repository\StatsRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;

class StatsHandler
{


    public function __construct(
        private FormFactoryInterface $formFactory,
        private EntityManagerInterface $entityManager ,
        private StatsRepository $statsRepository
   )
    {
    }

    /**
     * @throws InvalidFormException
     */
    public function  create(array $parameters)
    {
        $form=$this->formFactory->create(StatsFormType::class,new Stats());
        $form->submit($parameters);

        if(!$form->isValid()){
            throw new InvalidFormException($form);
        }
        $stats=$form->getData();
        $this->entityManager->persist($stats);
        try {
            $this->entityManager->flush();
        } catch (\Exception $e) {
            echo 'General exception ' . $e->getMessage();
        }
        return $stats;



    }

    public function update(Stats $stats, array $parameters)
    {
        $form=$this->formFactory->create(StatsFormType::class,$stats);
        $form->submit($parameters,false);

        if(!$form->isValid()){
            throw new InvalidFormException($form);
        }
        $stats=$form->getData();
        $this->entityManager->persist($stats);
        $this->entityManager->flush();
        return $stats;
    }

    public function delete($stats)
    {
        $this->statsRepository->remove($stats);
    }
}