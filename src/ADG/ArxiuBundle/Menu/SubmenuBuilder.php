<?php

namespace ADG\ArxiuBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class SubmenuBuilder extends ContainerAware
{   
    public function SubMenu(FactoryInterface $factory, array $options)
    {
    	$menu = $factory->createItem('root');

    	$menu->addChild("Classificació de l'arxiu", array('route' => 'guia'))
    		->setAttribute('icon', 'icon-archive');
    		
    	$menu->addChild('Dispenses matrimonials', array('route' => 'altre'))
    		->setAttribute('icon', 'icon-legal');
    	
    	$menu->addChild('Recerca per fons i sèries', array('route' => 'fons'))
    	->setAttribute('icon', 'icon-list');

    	$menu->addChild('Index de llocs i persones', array('route' => 'altre'))
    	->setAttribute('icon', 'icon-group');
    	
    	$menu->addChild('Documents i textos', array('route' => 'altre'))
    	->setAttribute('icon', 'icon-file-text');

    	$menu->addChild('Parròquies', array('route' => 'altre'))
    	->setAttribute('icon', 'icon-bell-alt')->setAttribute('class', 'last');
    	
    	return $menu;
    }
    
}