<?php

namespace ADG\ArxiuBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class SubmenuBuilder extends ContainerAware
{   
    public function SubMenu(FactoryInterface $factory, array $options)
    {
    	$menu = $factory->createItem('root');

    	$menu->addChild("Classificació de l'arxiu", array('route' => 'altre'))
    		->setAttribute('icon', 'icon-info-sign');
    		
    	$menu->addChild('Dispenses matrimonials', array('route' => 'altre'))
    		->setAttribute('icon', 'icon-legal');
    		
    	return $menu;
    }
    
}