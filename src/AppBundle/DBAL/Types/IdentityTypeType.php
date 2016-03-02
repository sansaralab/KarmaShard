<?php

namespace AppBundle\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

class IdentityTypeType extends AbstractEnumType
{
    const EMAIL = 'EM';
    const PHONE = 'PH';
    const VKONTAKTE = 'VK';
    const FACEBOOK = 'FB';
    const TWITTER = 'TV';
    const STEAM = 'ST';

    protected static $choices = [
        self::EMAIL => 'Email',
        self::PHONE => 'Phone',
        self::VKONTAKTE => 'Vkontakte',
        self::FACEBOOK => 'Facebook',
        self::TWITTER => 'Twitter',
        self::STEAM => 'Steam',
    ];
}