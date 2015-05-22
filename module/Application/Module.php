<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Doctrine\DBAL\Logging\LoggerChain;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Validator\AbstractValidator;
use Zend\I18n\Translator\Translator;
use LosLog\Log\SqlLogger;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        // Configuração da Tradução
        \Locale::setDefault('pt_BR');

        $translator = new Translator();
        $translator->addTranslationFile('phpArray', __DIR__ . '/../../vendor/zendframework/zendframework/resources/languages/pt_BR/Zend_Validate.php', 'default', 'pt_BR');
        $translator->addTranslationFile('phpArray', __DIR__ . '/../../vendor/zendframework/zendframework/resources/languages/pt_BR/Zend_Captcha.php', 'default', 'pt_BR');
        AbstractValidator::setDefaultTranslator(new \Zend\Mvc\I18n\Translator($translator));

        // Configuração dos Layout por Modulos
        $e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
            $controller      = $e->getTarget();
            $controllerClass = get_class($controller);
            $moduleNamespace = substr($controllerClass, 0, strpos($controllerClass, '\\'));
            $config          = $e->getApplication()->getServiceManager()->get('config');
            if (isset($config['module_layout'][$moduleNamespace])) {
                $controller->layout($config['module_layout'][$moduleNamespace]);
            }
        }, 100);

        // Configuração da Geração de Logs no Sistema
        $sm = $e->getApplication()->getServiceManager();
        $em = $sm->get('Doctrine\ORM\EntityManager');
        $dataLog = date('d-m-y');
        $myLogger = new SqlLogger($dataLog.".log","data/logs");

        if (null !== $em->getConfiguration()->getSQLLogger()) {
            $logger = new LoggerChain();
            $logger->addLogger($myLogger);
            $logger->addLogger($em->getConfiguration()->getSQLLogger());
            $em->getConfiguration()->setSQLLogger($logger);
        } else {
            $em->getConfiguration()->setSQLLogger($myLogger);
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
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
