<?php

namespace App\Handler;
use App\Entity\Show;
use App\Exception\InvalidFormException;
use App\Form\ShowFormType;
use App\Repository\ShowRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Symfony\Component\Form\FormFactoryInterface;

class ShowHandler
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private FormFactoryInterface $formFactory,
        private ShowRepository $showRepository
    )
    {
    }


    /**
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws InvalidFormException
     */
    public function create(array $parameters):Show
    {
        $form=$this->formFactory->create(ShowFormType::class,new Show());
        $form->submit($parameters);

        if(!$form->isValid()){
            throw new InvalidFormException($form);
        }
        $show=$form->getData();
        $this->entityManager->persist($show);
        $this->entityManager->flush();
        return $show;

    }

    /**
     * @throws InvalidFormException
     */
    public function update(Show $show, array $parameters):Show
    {
        $form=$this->formFactory->create(ShowFormType::class, $show);
        $form->submit($parameters,false);
        $show=$form->getData();
        if(!$form->isValid()){
            throw new InvalidFormException($form);
        }
        $show=$form->getData();
        $this->showRepository->add($show,true);
        return $show;
    }

    public function delete($show)
    {
        $this->showRepository->remove($show);
    }
}