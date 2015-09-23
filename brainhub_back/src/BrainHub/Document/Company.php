<?php

namespace BrainHub\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/** @ODM\Document(collection="companies") */
class Company {

    /** @ODM\Id */
    public $id;

    public $title;

    public $website;

    public $employeeCount;

    public $shortDescription;

    public $detailedDescription;

}