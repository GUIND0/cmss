<?php

namespace App\Forms;


class MedecinForm extends Form
{

    protected $resource = '';



    public function buildForm()
    {
        if($this->getModel() && $this->getModel()->id){
            $method = 'PUT';
            $url = route('agence.update',$this->getModel()->id);
        }else{
            $method = 'POST';
            $url = route('agence.store');
        }

        $this->formOptions = [
            'method' => $method,
            'url' => $url
        ];

        $this->add('medecin_specialistes_id','text',[
                'rules' => 'required',
                'attr' => [
                    'placeholder' => "code"
                ]
            ])
            ->add('languages', 'select', [
                'choices' => ['en' => 'English', 'fr' => 'French'],
                'selected' => 'en',
                'empty_value' => '=== Select language ==='
            ]);


        if($this->getData('admin') === true){
            $this->add('status','checkbox');
        }

        $this->add('Enregistrer','submit',[
            'attr' => [
                'class' => "btn btn-success"
            ]
        ]);
    }
}
