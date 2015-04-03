<?php
// src/Futsal/TournamentBundle/Admin/GameTeamAdmin.php

namespace Futsal\TournamentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class GameTeamAdmin extends Admin
{
    public function getParentAssociationMapping()
    {
        return 'game';
    }

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('game', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Game',
                                            'property' => 'id'
                                            )
                )
            ->add('team', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Team',
                                            'property' => 'labelname',
                                            )
                )
            ->add('goals', 'integer', array(
                                            'label' => 'Goals',
                                            'required' => false
                                            )
                )
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('goals')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('game', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Game',
                                            'property' => 'id',
                                            'associated_property' => 'id',
                                            'route' => array(
                                                            'name' => 'view',
                                                            'identifier_parameter_name' => 'id'
                                                            )
                                            )
                )
            ->add('team', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Team',
                                            'property' => 'id',
                                            'associated_property' => 'labelname'
                                            )
                )
            ->add('goals')
        ;
    }
    
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        //$query->groupBy($query->getRootAliases()[0] . '.game');
        
        /*
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0] . '.game', ':id')
        );
        $query->setParameter('id', 1);
        */
        
        return $query;
    }
    
}

