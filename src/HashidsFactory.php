<?php
/**
 * Created by PhpStorm.
 * User: baoerge
 * Email: baoerge123@163.com
 * Date: 2018/2/8
 * Time: 下午4:14
 */
namespace Hycooc\Hashids;

use Hashids\Hashids;

class HashidsFactory
{
    /**
     * @param array $config
     *
     * @return Hashids
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getHashidsClient($config);
    }

    /**
     * @param array $config
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        return [
            'salt'     => array_get($config, 'salt', ''),
            'length'   => array_get($config, 'length', 0),
            'alphabet' => array_get($config, 'alphabet', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'),
        ];
    }

    /**
     * @param array $config
     *
     * @return Hashids
     */
    protected function getHashidsClient(array $config)
    {
        return new Hashids($config['salt'], $config['length'], $config['alphabet']);
    }
}