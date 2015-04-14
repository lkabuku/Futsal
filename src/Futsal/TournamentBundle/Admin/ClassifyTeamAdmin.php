<?php
// src/Futsal/TournamentBundle/Admin/ClassifyTeamAdmin.php

namespace Futsal\TournamentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class ClassifyTeamAdmin extends Admin
{
    
    /**
     * Configures fields to be shown on create/edit forms
     * 
     * @param \Sonata\AdminBundle\Form\FormMapper $formMapper
     * @return void
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper   
            ->add('team', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Team',
                                            'property' => 'name',
                                            )
                )
            ->add('tournament', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Tournament',
                                            'property' => 'labelname',
                                            )
                )
            ->add('groups', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Groups',
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
            ->add('team.name', array(), array('expanded' => false, 'multiple' => false))
            ->add('tournament.name')
            ->add('groups.id')
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
            ->add('team', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Team',
                                            'property' => 'id',
                                            'associated_property' => 'name',
                                            'editable' => true,
                                            )
                )
            ->add('tournament', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Tournament',
                                            'property' => 'id',
                                            'associated_property' => 'labelname',
                                            'editable' => true,
                                            )
                )
            ->add('groups', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Groups',
                                            'property' => 'id',
                                            'associated_property' => 'id',
                                            'editable' => true,
                                            )
                )
            ->add('positionGroup')
            ->add('nbPoints')
            ->add('goalFor')
            ->add('goalAgainst')
            ->add('goalDifference')
        ;
    }
}
