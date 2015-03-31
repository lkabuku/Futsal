<?php
// src/Futsal/TournamentBundle/Admin/TeamAdmin.php

namespace Futsal\TournamentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class TeamAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text', array('label' => 'Name'))
            ->add('labelname', 'text', array('label' => 'Label name'))
            ->add('logo', 'text', array('label' => 'Logo'))
            ->add('dateCreation', 'date', array('label' => 'Fondation date',
                                                'attr' => array('data-sonata-select2' => false)
                                )
                )
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('labelname')
            ->add('dateCreation')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier("id")
            ->add('name')
            ->add('labelname')
            ->add('logo')
            ->add('dateCreation')
        ;
    }
}
