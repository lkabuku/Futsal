<?php
// src/Futsal/TournamentBundle/Admin/GameTeamAdmin.php

namespace Futsal\TournamentBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Futsal\TournamentBundle\Entity\Game;
use Futsal\TournamentBundle\Entity\Team;

class GameTeamAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('game', 'entity', array(
                                            'class' => 'Futsal\TournamentBundle\Entity\GameTeam',
                                            'property' => "gameResults",
                                            )
                )
            ->add('team', 'entity', array('class' => 'Futsal\TournamentBundle\Entity\Team'))    
            ->add('goals', 'integer', array('label' => 'Goals'))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('game')
            ->add('team')
            ->add('goals')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('game', 'entity', array(
                                            'data_class' => 'Futsal\TournamentBundle\Entity\Game',
                                            'property_path' => "gameResults",
                                            )
                )
            ->add('team')
            ->add('goals')
        ;
    }
}

