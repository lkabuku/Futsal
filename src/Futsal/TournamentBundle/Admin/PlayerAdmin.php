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
            ->add('firstname', 'text', array(
                                            'label' => 'First Name',
                                            'required' => false
                                            )
                )
            ->add('lastname', 'text', array(
                                            'label' => 'Last Name',
                                            'required' => false
                                            )
                )
            ->add('username', 'text', array(
                                            'label' => 'User Name',
                                            'required' => false
                                            )
                )
            ->add('email', 'text', array(
                                        'label' => 'E-mail',
                                        'required' => false
                                        )
                )
            ->add('birthday', 'date', array(
                                            'label' => 'Birthday',
                                            'attr' => array('data-sonata-select2' => false),
                                            'required' => false
                                )
                )
            ->add('favorite_team', 'text', array('label' => 'Favorite Team'))
            ->add('team', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Team',
                                            'property' => 'labelname',
                                            )
                )
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('firstname')
            ->add('lastname')
            ->add('team.labelname')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier("id")
            ->add('firstname')
            ->add('lastname')
            ->add('username')
            ->add('birthday')
            ->add('team', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Team',
                                            'property' => 'id',
                                            'associated_property' => 'team.labelname',
                                            'editable' => true,
                                            )
                )
        ;
    }
}
