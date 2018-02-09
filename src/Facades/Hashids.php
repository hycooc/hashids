<?php
/**
 * Created by PhpStorm.
 * User: baoerge
 * Email: baoerge123@163.com
 * Date: 2018/2/9
 * Time: 上午11:03
 */
namespace Hycooc\Hashids\Facades;

use Illuminate\Support\Facades\Facade;

class Hashids extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hashids';
    }
}