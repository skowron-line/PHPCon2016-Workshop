<?php


namespace AppBundle\Entity;

/**
 * @author Krzysztof Skaradziński <skaradzinski.krzysztof@gmail.com>
 */
class Administrator extends \FOS\UserBundle\Model\User
{
    public function __construct()
    {
        parent::__construct();
        $this->roles = ['ROLE_ADMIN'];
    }
}