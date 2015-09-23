<?php

namespace BrainHub\Persistence;

use Doctrine\MongoDB\Connection;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use Slim\Slim;

class SlimConfig{

    /**
     * @var DocumentManager
     */
    private static $dm = null;
    /**
     * @var Slim
     */
    private static $app = null;

    /**
     * @var \Swift_Mailer
     */
    private static $mailer = null;

    /**
     * @return Slim
     */
    public static function getApp() {

        if(!static::$app){
            static::$app = new Slim();

            static::$app->view(new \JsonApiView());
            static::$app->add(new \JsonApiMiddleware());
        }

        return static::$app;

    }

    /**
     * @return DocumentManager
     */
    public static function getDocumentManager(){

        if(!static::$dm){
            AnnotationDriver::registerAnnotationClasses();

            $config = new Configuration();
            $config->setDefaultDB('brain_hub');
            $config->setProxyDir(TMP_DIR.'proxies');
            $config->setProxyNamespace('Proxies');
            $config->setHydratorDir(TMP_DIR.'hydrators');
            $config->setHydratorNamespace('Hydrators');
            $config->setMetadataDriverImpl(AnnotationDriver::create('../Document'));

            static::$dm = DocumentManager::create(new Connection(), $config);
        }

        return static::$dm;
    }

    public static function getMailer() {
        if(!static::$mailer) {
            $transport = new \Swift_SmtpTransport('smtp.zoho.com', 465, 'ssl');

            $transport->setUsername('no-reply@brainhub.me');
            $transport->setPassword('MariLand12*8');

            static::$mailer = \Swift_Mailer::newInstance($transport);
        }

        return static::$mailer;
    }

}

