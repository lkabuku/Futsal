<?php
// src/Futsal/TournamentBundle/Admin/ResultAdmin.php

namespace Futsal\TournamentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ResultAdmin extends Admin
{
    /*
     * Create child admins (Here => ResultAdmin class become a child of GameAdmin and then others routes are created, for example /result/{id}/game/list)
     *  
     * @return String
     */
    public function getParentAssociationMapping()
    {
        return 'game';
    }
    
    /**
     * Configures fields to be shown on create/edit forms
     * 
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
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
            ->add('tournament', 'integer', array(
                                            'label' => 'Tournament',
                                            'property' => 'id',
                                            )
                )
            ->add('group', 'integer', array(
                                            'label' => 'Tournament',
                                            'property' => 'id',
                                            )
                )
        ;
    }

    /**
     * Configures fields to be shown on filter forms
     * 
     * @param \Sonata\AdminBundle\Datagrid\DatagridMapper $datagridMapper
     * @return void
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('game.id')
            ->add('team.id')
            ->add('tournament.id')
            ->add('group.id')
            ->add('goals')
        ;
    }

    /**
     * Configures fields to be shown on lists
     * 
     * @param \Sonata\AdminBundle\Datagrid\ListMapper $listMapper
     * @return void
     */
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
            ->add('tournament', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Tournament',
                                            'property' => 'id',
                                            'associated_property' => 'labelname'
                                            )
                )
            ->add('group', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Group',
                                            'property' => 'id',
                                            'associated_property' => 'id'
                                            )
                )
            ->add('result')
            ->add('goals')
        ;
    }
    
    /*
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);
        
        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0] . '.game', ':id')
        );
        $query->setParameter('id', 1);
        
        return $query;
    }
    */
    
}

