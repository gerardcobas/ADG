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
        $menu->addChild('Biblioteca', array('route' => 'biblioteca'))->setAttribute('icon', 'icon-book');

        return $menu;
    }
    
    
    public function userMenu(FactoryInterface $factory, array $options)
    {
    	$menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right ');

    	$securityContext = $this->container->get('security.context');
    	
    	if ($securityContext->isGranted(array('ROLE_ADMIN'))) {
    		$menu->addChild('Admin', array('label' => 'Administrar'))
    		->setAttribute('dropdown', true)
    		->setAttribute('icon', 'icon-user');
    		
    		$menu['Admin']->addChild('General', array('route' => 'admin'))
    		->setAttribute('icon', 'icon-edit-sign');
    		
    		$menu['Admin']->addChild('arxiu_divider')
    		->setAttribute('class', 'divider');
    		$menu['Admin']->addChild('Arxiu')
    		->setAttribute('class', 'dropdown-header');
    		
    		
    		$menu['Admin']->addChild('Classificació', array('route' => 'guia'))
    		->setAttribute('icon', 'icon-edit');
    		
    		$menu['Admin']->addChild('Fons i series', array('route' => 'fons'))
    		->setAttribute('icon', 'icon-edit');
    		
    		
    		$menu['Admin']->addChild('altres_divider')
    		->setAttribute('class', 'divider');
    		$menu['Admin']->addChild('Altres')
    		->setAttribute('class', 'dropdown-header');
    		
    		
    		$menu['Admin']->addChild('Notícies', array('route' => 'noticies_index'))
    		->setAttribute('icon', 'icon-edit');
    		
    		$menu['Admin']->addChild('Usuaris', array('route' => 'admin_usuaris'))
    		->setAttribute('icon', 'icon-edit');
    		
    		$menu['Admin']->addChild('Logout')
    		->setAttribute('class', 'divider');
    		$menu['Admin']->addChild('Sortir', array('route' => 'fos_user_security_logout'))
    		->setAttribute('icon', 'icon-signout');

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