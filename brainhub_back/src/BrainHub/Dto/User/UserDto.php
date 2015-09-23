<?php

namespace BrainHub\Dto\User;

use BrainHub\Document\User;

/** @ODM\Document(collection="users") */
class UserDto {

    public function __construct(User $user){
        $this->id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
    }

    /** @ODM\Id */
    public $id;

    /** @ODM\String */
    public $name;

    /** @ODM\String @ODM\Index */
    public $email;

    /** @ODM\Int */
    public $type;

}