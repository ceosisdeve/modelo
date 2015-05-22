<?php
namespace Admin;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    // Configuração do Modulo Admin, so podendo acessar quem tiver login e senhas validos
    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();

        $sharedEvents->attach("Zend\Mvc\Controller\AbstractActionController",
            MvcEvent::EVENT_DISPATCH,
            array($this,'validaAuth'),100);
    }

    public function validaAuth($e)
    {
        // Pega o Controller
        $controller = $e->getTarget();

        $controllerClass = get_class($controller);
        $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));

        $sm = $e->getApplication()->getServiceManager();
        $auth = $sm->get('zfcuser_auth_service');


        // Verifica se for o modulo Admin, ele verifica se esta logado
        if($moduleNamespace == 'Admin'):
            $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();
            //var_dump($matchedRoute);die();

            if ($auth->hasIdentity()) {
                return $controller->redirect()->toRoute("admin-auth");
            }

            if($matchedRoute == 'admin-auth'):
                return;
            else:
                return $controller->redirect()->toRoute("admin-auth");
            endif;
        endif;


    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
