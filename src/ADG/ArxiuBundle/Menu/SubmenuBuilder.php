<?php

namespace ADG\ArxiuBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class SubmenuBuilder extends ContainerAware
{   
    public function SubMenu(FactoryInterface $factory, array $options)
    {
    	$menu = $factory->createItem('root');

    	$menu->addChild("submenu.classificacio", array('route' => 'guia'))
    		->setAttribute('icon', 'icon-archive');
    		
    	$menu->addChild('submenu.dispenses', array('route' => 'dispenses'))
    		->setAttribute('icon', 'icon-legal');
    	
    	$menu->addChild('submenu.recerca', array('route' => 'fons'))
    	->setAttribute('icon', 'icon-list');

    	$menu->addChild('submenu.index', array('route' => 'llistat'))
    	->setAttribute('icon', 'icon-group');
    	
    	$menu->addChild('submenu.documents', array('route' => 'documents'))
    	->setAttribute('icon', 'icon-file-text');

    	$menu->addChild('submenu.parroquies', array('route' => 'altre'))
    	->setAttribute('icon', 'icon-bell-alt')->setAttribute('class', 'last');
    	
    	return $menu;
    }
    
}