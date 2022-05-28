<?php

namespace App\Exception;


use Exception;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;

class InvalidFormException extends Exception
{
    private $formErrorsArray;

    public function __construct(FormInterface $form)
    {

        $this->formErrorsArray=[];
        $this->transformErrors($form);
        parent::__construct("INVALID_FORM_EXCEPTION", Response::HTTP_BAD_REQUEST);
    }

    public function transformErrors(FormInterface $form){
        foreach ($form->getErrors() as $formError){
            $this->formErrorsArray['form'][]=$formError->getMessage();
        }
        foreach ($form as $formItem)
        {
            $name=$formItem->getName();
            foreach ($formItem->getErrors() as $formError)
            {
                $this->formErrorsArray[$name][]=$formError->getMessage();
            }
        }
    }

    /**
     * @return array
     */
    public function getFormErrorsArray(): array
    {
        return $this->formErrorsArray;
    }


}