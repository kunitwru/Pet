<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class FragmentForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('key', 'text', [
                'label' => 'Key',
                'rules' => 'required',
                'error_messages' => [
                    'key.required' => 'Key không được để trống.',
                ],
                'attr' => [
                    'placeholder' => 'home.greeting',
                ]
            ])
            ->add('text', 'textarea', [
                'label' => 'Text',
                'rules' => 'required',
                'error_messages' => [
                    'text.required' => 'Nội dung dịch không được để trống'
                ],
                'attr' => [
                    'rows' => 3,
                    'placeholder' => 'Hello world',
                ]
            ])
            ->add('language', 'select', [
                'choices' => ['en' => 'English', 'vi' => 'Việt Nam']
            ])
            ->add('submit', 'submit', ['label' => 'Save', 'attr' => ['class' => 'btn btn-primary']])
            ->add('clear', 'reset', ['label' => 'Clear', 'attr' => ['class' => 'btn btn-danger']]);
    }
}
