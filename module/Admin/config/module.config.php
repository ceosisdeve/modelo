<?php
/**
 * namespace para nosso modulo Admin
 */
namespace Admin;

/**
 * Arquivo de configuração do modulo Admin
 * Respnsavel por gerenciar as configurações de:
 * Rotas, layout padrão, translator, Doctrine
 * controllers, views, translate, layouts etc.
 * @author Winston Hanun Junior <ceo@sisdeve.com.br> skype ceo_sisdeve
 * @copyright (c) 2015, Winston Hanun Junior
 * @link http://www.sisdeve.com.br
 * @version V0.1
 */return array(
    // Configurações de Rotas
    'router' => array(
        'routes' => array(
            'admin-home' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/app-admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),

            ),
            'admin-geraMvc' => array(
                'type' => 'Literal',
                'options' => array(
                    'route'    => '/app-admin/geraMvc',
                    'defaults' => array(
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'geraMvc',
                    ),
                ),
            ),
        ),
    ),
    // Configurações de Controlleres
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index' => 'Admin\Controller\IndexController',
        ),
    ),
    // Configuração dos Menus no Module Admin
    'service_manager' => array(
        'factories' => array(
            'admin_navigation' => 'Admin\Navigation\Service\AdminNavigationFactory'
        ),
    ),
    //Configurando qual Layout vai ser o padrão mo modelo
    'module_layout' => array(
        'Admin' => 'layout/layout_admin.phtml'
    ),
    // Configurações das Visualizações
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout_admin.phtml',
            'error/404'               => __DIR__ . '/../../Base/view/error/404.phtml',
            'error/index'             => __DIR__ . '/../../Base/view/error/index.phtml',
            //'partials/paginator'      => __DIR__ . '/../../Core/view/partials/paginator.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        // Configurações do Json
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    // Configurações do Doctrine
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ),
            ),
        ),
    ),
    // Configuração dos Menus
    'navigation' => array(
        'admin' => array(
            array(
                'label' => 'Home',
                'route' => 'admin-home',
            ),
            'Cadastros' => array(
                'label' => 'Administração',
                'uri' => '#',

            ),
        ),
    ),

);