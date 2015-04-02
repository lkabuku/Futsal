<?php
// src/Futsal/TournamentBundle/Admin/TournamentTeamAdmin.php

namespace Futsal\TournamentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TournamentTeamAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            /*
            ->add('team', 'sonata_type_collection', 
                    array(
                        'type_options' => array(
                                            // Prevents the "Delete" option from being displayed
                                            'delete' => true,
                                            'delete_options' => array(
                                                                    // You may otherwise choose to put the field but hide it
                                                                    'type'         => 'hidden',
                                                                    // In that case, you need to fill in the options as well
                                                                    'type_options' => array(
                                                                                            'mapped'   => false,
                                                                                            'required' => false,
                                                                                            )
                                                                    )
                                            )
                        ), array(
                                'edit' => 'inline',
                                'inline' => 'table',
                                'sortable' => 'position',
                                )
                )
             * 
             */    
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

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('team.name', array(), array('expanded' => false, 'multiple' => false))
            ->add('tournament.name')
        ;
    }

    // Fields to be shown on lists
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
