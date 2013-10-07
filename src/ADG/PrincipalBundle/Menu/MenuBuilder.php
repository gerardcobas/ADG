<?php

namespace ADG\PrincipalBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
		$menu = $factory->createItem('root');
		$menu->setChildrenAttribute('class', 'nav navbar-nav');

        $menu->addChild('Principal', array('route' => 'index'))->setAttribute('icon', 'icon-home');
        $menu->addChild('Arxiu diocesà', array('route' => 'arxiu'))->setAttribute('icon', 'icon-folder-close');
        $menu->addChild('Arxiu capitular', array('route' => 'capitular'))->setAttribute('icon', 'icon-folder-close-alt');
        $menu->addChild('Biblioteca', array('route' => ''))->setAttribute('icon', 'icon-book');
        $menu->addChild('Contacte', array('route' => 'contacte'))->setAttribute('icon', 'icon-envelope');
        $menu->addChild('Normativa', array('route' => 'normativa'))->setAttribute('icon', 'icon-file-text');
        

        return $menu;
    }
    
    
    public function userMenu(FactoryInterface $factory, array $options)
    {
    	$menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');
    
    	/*
    	 You probably want to show user specific information such as the username here. That's possible! Use any of the below methods to do this.
    
    	if($this->container->get('security.context')->isGranted(array('ROLE_ADMIN', 'ROLE_USER'))) {} // Check if the visitor has any authenticated roles
    	$username = $this->container->get('security.context')->getToken()->getUser()->getUsername(); // Get username of the current logged in user
    
    	*/
    	$menu->addChild('Iniciar sessió', array('route' => 'index'))->setAttribute('icon', 'icon-user');
    	
    	

    	return $menu;
    }
    
}