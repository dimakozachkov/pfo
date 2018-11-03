<?php
/**
 * Created by PhpStorm.
 * User: 38095
 * Date: 07.08.2018
 * Time: 23:36
 */

namespace App\Attributes;

/**
 * Class RoleAttributes contain user roles
 * @package App\Attributes
 */
abstract class RoleAttributes
{

    public const ROOT      = 0;
    public const ADMIN     = 1;
    public const USER      = 2;

}