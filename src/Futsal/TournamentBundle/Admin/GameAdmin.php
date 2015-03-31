<?php
// src/Futsal/TournamentBundle/Admin/GameAdmin.php

namespace Futsal\TournamentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

use Sonata\AdminBundle\Route\RouteCollection;

class GameAdmin extends Admin
{
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('view', $this->getRouterIdParameter().'/view');
    }
    
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('referee', 'text', array('label' => 'Referee'))
            ->add('date', 'date', array(
                                    'label' => 'Game date',
                                    'attr' => array('data-sonata-select2' => 'false')
                                )
                )
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
            ->addIdentifier("id")
            ->add('referee')
            ->add('date')
            ->add('isValid')
            ->add('gameResults', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\GameTeam',
                                            'property' => 'id',
                                            'associated_property' => 'id'
                                            )
                )
            ->add('_action', 'actions', array(
                'actions' => array(
                'edit' => array(),
                'delete' => array(),
            )
        ))
        ;
    }
}

