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
        $menu->addChild('Biblioteca', array('route' => 'capitular'))->setAttribute('icon', 'icon-book');

        return $menu;
    }
    
    
    public function userMenu(FactoryInterface $factory, array $options)
    {
    	$menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right ');

    	$securityContext = $this->container->get('security.context');
    	
    	if ($securityContext->isGranted(array('ROLE_ADMIN'))) {
    		$menu->addChild('User', array('label' => 'Administrar'))
    		->setAttribute('dropdown', true)
    		->setAttribute('icon', 'icon-user');
    		
    		$menu['User']->addChild('admin1', array('route' => 'index'))
    		->setAttribute('icon', 'icon-edit');
    		
    		$menu->addChild('Sortir', array('route' => 'fos_user_security_logout'))->setAttribute('icon', 'icon-signout');
    	} else if ($securityContext->isGranted(array('ROLE_USER'))) {
    	
    		$menu->addChild('User', array('label' => 'Autentificat'))
    		->setAttribute('dropdown', true)
    		->setAttribute('icon', 'icon-user');
    	
    		$menu['User']->addChild('Sortir', array('route' => 'fos_user_security_logout'))->setAttribute('icon', 'icon-signout');
    	}
    	else {
    		$menu->addChild('Autentificació', array('route' => 'fos_user_security_login'))->setAttribute('icon', 'icon-signin');
    		
    	}

    	return $menu;
    }
    
}