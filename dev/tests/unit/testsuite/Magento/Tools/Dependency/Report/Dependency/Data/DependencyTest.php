<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Tools\Dependency\Report\Dependency\Data;

use Magento\TestFramework\Helper\ObjectManager;

class DependencyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $module
     * @param string|null $type One of \Magento\Tools\Dependency\Dependency::TYPE_ const
     * @return \Magento\Tools\Dependency\Report\Dependency\Data\Dependency
     */
    protected function createDependency($module, $type = null)
    {
        $objectManagerHelper = new ObjectManager($this);
        return $objectManagerHelper->getObject(
            'Magento\Tools\Dependency\Report\Dependency\Data\Dependency',
            ['module' => $module, 'type' => $type]
        );
    }

    public function testGetModule()
    {
        $module = 'module';

        $dependency = $this->createDependency($module);

        $this->assertEquals($module, $dependency->getModule());
    }

    public function testGetType()
    {
        $type = Dependency::TYPE_SOFT;

        $dependency = $this->createDependency('module', $type);

        $this->assertEquals($type, $dependency->getType());
    }

    public function testThatHardTypeIsDefault()
    {
        $dependency = $this->createDependency('module');

        $this->assertEquals(Dependency::TYPE_HARD, $dependency->getType());
    }

    public function testThatHardTypeIsDefaultIfPassedWrongType()
    {
        $dependency = $this->createDependency('module', 'wrong_type');

        $this->assertEquals(Dependency::TYPE_HARD, $dependency->getType());
    }
}
