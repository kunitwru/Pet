<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class VideoForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => 'Title',
                'rules' => 'required|max:255',
                'error_messages' => [
                    'name.required' => 'Tiêu đề không được để trống.',
                ]
            ])
            ->add('yt_str', 'text', [
                'label' => 'Link Video',
                'rules' => 'required',
                'error_messages' => [
                    'yt_str.required' => 'Youtube không được để trống.',
                ]
            ])
            ->add('source', 'select', [
                'label' => __('video.source'),
                'choices' => ['facebook' => 'Facebook', 'youtube' => 'Youbtube']
            ])
            ->add('status', 'select', [
                'choices' => [1 => 'On', 0 => 'Off'],
            ])
            ->add('submit', 'submit', ['label' => 'Save', 'attr' => ['class' => 'btn btn-primary']], true)
            ->add('clear', 'reset', ['label' => 'Clear', 'attr' => ['class' => 'btn btn-danger']]);
    }
}
