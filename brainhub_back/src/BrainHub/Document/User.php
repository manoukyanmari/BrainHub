<?php

namespace BrainHub\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use BrainHub\Persistence\SlimConfig;

/** @ODM\Document(collection="users") */
class User {

    /** @ODM\Id */
    public $id;

    /** @ODM\String */
    public $name;

    /** @ODM\String @ODM\Index */
    public $email;

    /** @ODM\String */
    public $password;

    /** @ODM\String @ODM\Index */
    public $authToken;

    /** @ODM\Int */
    public $type;

    /** @ODM\Boolean */
    public $isGod;

    /**
     * @var User
     */
    public static $currentUser = null;

    public static function getCurrentUser() {
        if(!static::$currentUser){
            $token = SlimConfig::getApp()->request->headers->get('X-Auth-Token');

            static::$currentUser = SlimConfig::getDocumentManager()->getRepository('\BrainHub\Document\User')
                ->findOneBy(array('authToken' => $token));
        }
        return static::$currentUser;
    }

    public static function isAuthorised() {

        static::getCurrentUser();

        if(static::$currentUser != null)
            return true;
        else
            return false;
    }

    public static function isGod() {

        static::getCurrentUser();

        return true;

        if(static::$currentUser != null and static::$currentUser->isGod)
            return true;
        else
            return false;
    }

}