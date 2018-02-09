<?php
/**
 * Created by PhpStorm.
 * User: baoerge
 * Email: baoerge123@163.com
 * Date: 2018/2/8
 * Time: 下午4:15
 */
namespace Hycooc\Hashids;

use GrahamCampbell\Manager\AbstractManager;
use Hashids\Hashids;
use Illuminate\Contracts\Config\Repository;

class HashidsManager extends AbstractManager
{
    /**
     * @var HashidsFactory
     */
    private $factory;

    /**
     * HashidsManager constructor.
     *
     * @param Repository $config
     * @param HashidsFactory $factory
     */
    public function __construct(Repository $config, HashidsFactory $factory)
    {
        parent::__construct($config);

        $this->factory = $factory;
    }

    /**
     * @param array $config
     *
     * @return Hashids
     */
    protected function createConnection(array $config)
    {
        return $this->factory->make($config);
    }

    /**
     * @return string
     */
    protected function getConfigName()
    {
        return 'hashids';
    }

    /**
     * @return HashidsFactory
     */
    public function getFactory()
    {
        return $this->factory;
    }
}