<?php
// src/Futsal/TournamentBundle/Admin/TournamentTeamAdmin.php

namespace Futsal\TournamentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TournamentTeamAdmin extends Admin
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
            ->add('id')
            ->add('team.name', array(), array('expanded' => false, 'multiple' => false))
            ->add('tournament.name')
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
            ->addIdentifier("id")
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
        ;
    }
}
