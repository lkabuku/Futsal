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

    /**
     * Sets routes to be added on the routing
     * 
     * @param \Sonata\AdminBundle\Route\RouteCollection $collection
     * 
     * @return void
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('view', $this->getRouterIdParameter().'/view');
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
            ->add('referee', 'text', array(
                                        'label' => 'Referee',
                                        'required' => false
                                        )
                )
            ->add('date', 'date', array(
                                        'label' => 'Game date',
                                        'required' => false,
                                        'attr' => array('data-sonata-select2' => false)
                                        )
                )
            ->add('isValid', 'integer', array('required' => false))
            // sonata_type_collection => add a link_add
            ->add('gameResults', 'sonata_type_collection', 
                array(
                    'type_options' => 
                        array(
                            'delete' => false,
                            'delete_options' => 
                                array(
                                    'type'         => 'hidden',
                                    'type_options' => 
                                        array(
                                            'mapped'   => false,
                                            'required' => false,
                                        )
                                )
                        )
                ),  array(
                        'edit' => 'inline',
                        'inline' => 'table',
                        'sortable' => 'position',
                    )
            )
            /*
            ->add('gameResults', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\GameTeam',
                                            'property' => 'id'
                                            )
                )
             * 
             */
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
            ->add('referee')
            ->add('date')
            ->add('isValid')
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
            ->add('referee')
            ->add('date')
            ->add('isValid')
            ->add('gameResults', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\GameTeam',
                                            'property' => 'id',
                                            'associated_property' => 'id',
                                            //@param template => Determines the template to use for this field
                                            'template' => 'FutsalTournamentBundle:Admin:list__gameResults.html.twig'
                                            )
                )
            ->add('_action', 'actions', array(
                'actions' => array(
                'edit' => array(),
            )
        ))
        ;
    }
    
    /*
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        $query->andWhere(
            $query->expr()->eq($query->getRootAliases()[0] . '.id', ':id')
        );
        $query->setParameter('id', 1);

        return $query;
    }
    */
}

