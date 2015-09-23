<?php

namespace BrainHub\Dto\User;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="users") */
class UserListElementDTO {

    /** @ODM\Id */
    public $id;

    /** @ODM\String */
    public $name;

    /** @ODM\String @ODM\Index */
    public $email;

    /** @ODM\Int */
    public $type;

//    /** @ODM\String @ODM\Index */
//    public $authToken;

}