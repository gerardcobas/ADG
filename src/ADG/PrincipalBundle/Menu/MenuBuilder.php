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

        $menu->addChild('menu.principal', array('route' => 'index'))->setAttribute('icon', 'icon-home');
        $menu->addChild('menu.diocesa', array('route' => 'arxiu'))->setAttribute('icon', 'icon-folder-close');
        $menu->addChild('menu.capitular', array('route' => 'capitular'))->setAttribute('icon', 'icon-folder-close-alt');
        $menu->addChild('menu.biblioteca', array('route' => 'biblioteca'))->setAttribute('icon', 'icon-book');

        return $menu;
    }
    
    
    public function userMenu(FactoryInterface $factory, array $options)
    {
    	$menu = $factory->createItem('root');
    	$menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right ');

    	$securityContext = $this->container->get('security.context');
    	
    	if ($securityContext->isGranted(array('ROLE_ADMIN'))) {
    		$menu->addChild('Admin', array('label' => 'menu.administrar'))
    		->setAttribute('dropdown', true)
    		->setAttribute('icon', 'icon-user');
    		
    		$menu['Admin']->addChild('menu.general', array('route' => 'admin'))
    		->setAttribute('icon', 'icon-edit-sign');
    		
    		$menu['Admin']->addChild('arxiu_divider')
    		->setAttribute('class', 'divider');
    		$menu['Admin']->addChild('menu.arxiu')
    		->setAttribute('class', 'dropdown-header');
    		
    		
    		$menu['Admin']->addChild('menu.classificacio', array('route' => 'guia'))
    		->setAttribute('icon', 'icon-edit');
    		$menu['Admin']->addChild('menu.dispenses', array('route' => 'dispenses'))
    		->setAttribute('icon', 'icon-edit');
    		$menu['Admin']->addChild('menu.fons', array('route' => 'fons'))
    		->setAttribute('icon', 'icon-edit');
    		$menu['Admin']->addChild('menu.llistat', array('route' => 'llistat'))
    		->setAttribute('icon', 'icon-edit');
    		$menu['Admin']->addChild('menu.documents', array('route' => 'documents'))
    		->setAttribute('icon', 'icon-edit');
    		$menu['Admin']->addChild('menu.parroquies', array('route' => 'parroquies'))
    		->setAttribute('icon', 'icon-edit');
    		
    		
    		$menu['Admin']->addChild('altres_divider')
    		->setAttribute('class', 'divider');
    		$menu['Admin']->addChild('menu.altres')
    		->setAttribute('class', 'dropdown-header');
    		
    		
    		$menu['Admin']->addChild('menu.noticies', array('route' => 'noticies_index'))
    		->setAttribute('icon', 'icon-edit');
    		
    		$menu['Admin']->addChild('menu.usuaris', array('route' => 'admin_usuaris'))
    		->setAttribute('icon', 'icon-edit');
    		
    		$menu['Admin']->addChild('Logout')
    		->setAttribute('class', 'divider');
    		$menu['Admin']->addChild('menu.sortir', array('route' => 'fos_user_security_logout'))
    		->setAttribute('icon', 'icon-signout');

    	} else if ($securityContext->isGranted(array('ROLE_USER'))) {
    	
    		$menu->addChild('User', array('label' => 'menu.autentificat'))
    		->setAttribute('dropdown', true)
    		->setAttribute('icon', 'icon-user');
    	
    		$menu['User']->addChild('Sortir', array('route' => 'fos_user_security_logout'))->setAttribute('icon', 'icon-signout');
    	}
    	else {
    		$menu->addChild('menu.autentificacio', array('route' => 'fos_user_security_login'))->setAttribute('icon', 'icon-signin');
    		
    	}

    	return $menu;
    }
    
}