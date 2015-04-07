<?php
// src/Futsal/TournamentBundle/Admin/TournamentAdmin.php

namespace Futsal\TournamentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TournamentAdmin extends Admin
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
            ->add('name', 'text', array('label' => 'Name'))
            ->add('labelname', 'text', array('label' => 'Label Name'))
            ->add('description', 'text', array('label' => 'Descritpion'))
            ->add('dateBegin', null, array(
                                            'label' => 'Begin date',
                                            'attr' => array('data-sonata-select2' => false)
                                            )
                )
            ->add('dateEnd', null, array(
                                            'label' => 'End date',
                                            'attr' => array('data-sonata-select2' => false)
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
            ->add('name')
            ->add('labelname')
            ->add('dateBegin')
            ->add('dateEnd')
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
            ->add('name')
            ->add('labelname')
            ->add('description')
            ->add('dateBegin')
            ->add('dateEnd')
        ;
    }
}
