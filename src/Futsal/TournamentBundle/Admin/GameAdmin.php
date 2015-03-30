<?php
// src/Futsal/TournamentBundle/Admin/GameAdmin.php

namespace Futsal\TournamentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class GameAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('referee', 'text', array('label' => 'Referee'))
            ->add('date', 'date')
            ->add('isValid', 'integer')
            ->add('gameResults', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\GameTeam',
                                            'property' => 'id'
                                            )
                )
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('date')
            ->add('isValid')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('referee')
            ->add('date')
            ->add('isValid')
            ->add('gameResults', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\GameTeam',
                                            'property' => 'id',
                                            'associated_property' => 'id'
                                            )
                )
        ;
    }
}

