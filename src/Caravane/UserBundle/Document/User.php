<?php
// src/Acme/UserBundle/Document/User.php

namespace Caravane\UserBundle\Document;

use FOS\UserBundle\Document\User as BaseUser;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class User extends BaseUser
{
    /**
     * @MongoDB\Id(strategy="auto")
     */
    protected $id;

    /**
     * @MongoDB\String
     */
    protected $facebookID;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function serialize()
    {
        return serialize(array($this->facebookID, parent::serialize()));
    }

    public function unserialize($data)
    {
        list($this->facebookID, $parentData) = unserialize($data);
        parent::unserialize($parentData);
    }
}
