<?php
// src/Futsal/TournamentBundle/Admin/PlayerAdmin.php

namespace Futsal\TournamentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class PlayerAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('firstname', 'text', array('label' => 'First Name'))
            ->add('lastname', 'text', array('label' => 'Last Name'))
            ->add('username', 'text', array('label' => 'User Name'))
            ->add('email', 'text', array('label' => 'E-mail'))
            ->add('birthday', 'date', array(
                                        'label' => 'Birthday',
                                        'attr' => array("width" => "33%"),
                    
                                    )
            )
            ->add('favorite_team', 'text', array('label' => 'Favorite Team'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstname')
            ->add('lastname')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('firstname')
            ->add('lastname')
            ->add('username')
            ->add('birthday')
        ;
    }
}
