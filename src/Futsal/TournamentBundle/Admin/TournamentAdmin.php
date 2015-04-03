<?php
// src/Futsal/TournamentBundle/Admin/TournamentAdmin.php

namespace Futsal\TournamentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TournamentAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Name'))
            ->add('labelname', 'text', array('label' => 'Label Name'))
            ->add('description', 'text', array('label' => 'Descritpion'))
            ->add('dateBegin', 'date', array(
                                            'label' => 'Begin date',
                                            'attr' => array('data-sonata-select2' => false)
                                )
                )
            ->add('dateEnd', 'date', array(
                                            'label' => 'End date',
                                            'attr' => array('data-sonata-select2' => false)
                                    )
                )
            /*
            ->add('teamsSubscribed', 'sonata_type_collection', 
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
            /*    
            ->add('teamsSubscribed', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Team',
                                            'property' => 'id',
                                            )
                )
             * 
             */
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('labelname')
            ->add('dateBegin')
            ->add('dateEnd')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier("id")
            ->add('name')
            ->add('labelname')
            ->add('description')
            ->add('dateBegin')
            ->add('dateEnd')
            /*
            ->add('teamsSubscribed', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\Team',
                                            'property' => 'id',
                                            'associated_property' => 'labelname',
                                            'editable' => true,
                                            )
                )
             * 
             */
        ;
    }
}