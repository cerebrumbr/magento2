<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\View\Asset\Minified;

use Magento\Framework\Object;

class ImmutablePathAssetTest extends AbstractAssetTestCase
{
    /**
     * @var ImmutablePathAsset
     */
    protected $_model;

    protected function setUp()
    {
        parent::setUp();

        $this->_model = new ImmutablePathAsset(
            $this->_asset,
            $this->_logger,
            $this->_filesystem,
            $this->_baseUrl,
            $this->_adapter
        );
    }

    public function testImmutableFilePath()
    {
        $this->prepareAttemptToMinifyMock(false);
        $this->_asset->method('getContext')->willReturn($this->_baseUrl);
        $this->_asset->expects($this->once())->method('getContent')->will($this->returnValue('content'));
        $this->_adapter->expects($this->once())->method('minify')->with('content')->will($this->returnValue('mini'));
        $this->_staticViewDir->expects($this->once())->method('writeFile')->with($this->anything(), 'mini');
        $this->assertEquals('test/admin.js', $this->_model->getFilePath());
        $this->assertEquals('http://example.com/test/admin.js', $this->_model->getUrl());
    }
}
