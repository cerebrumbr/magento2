<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\GiftMessage\Model;

use Magento\Framework\Api\AttributeValueFactory;

/**
 * Gift Message model
 *
 * @method \Magento\GiftMessage\Model\Resource\Message _getResource()
 * @method \Magento\GiftMessage\Model\Resource\Message getResource()
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Message extends \Magento\Framework\Model\AbstractExtensibleModel implements
    \Magento\GiftMessage\Api\Data\MessageInterface
{
    /**
     * @var \Magento\GiftMessage\Model\TypeFactory
     */
    protected $_typeFactory;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Api\MetadataServiceInterface $metadataService
     * @param AttributeValueFactory $customAttributeFactory
     * @param Resource\Message $resource
     * @param \Magento\Framework\Data\Collection\Db $resourceCollection
     * @param TypeFactory $typeFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Api\MetadataServiceInterface $metadataService,
        AttributeValueFactory $customAttributeFactory,
        \Magento\GiftMessage\Model\Resource\Message $resource,
        \Magento\Framework\Data\Collection\Db $resourceCollection,
        \Magento\GiftMessage\Model\TypeFactory $typeFactory,
        array $data = []
    ) {
        $this->_typeFactory = $typeFactory;
        parent::__construct(
            $context,
            $registry,
            $metadataService,
            $customAttributeFactory,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magento\GiftMessage\Model\Resource\Message');
    }

    /**
     * Return model from entity type
     *
     * @param string $type
     * @return mixed
     */
    public function getEntityModelByType($type)
    {
        return $this->_typeFactory->createType($type);
    }

    /**
     * Checks if the gift message is empty
     *
     * @return bool
     */
    public function isMessageEmpty()
    {
        return trim($this->getMessage()) == '';
    }

    //@codeCoverageIgnoreStart
    /**
     * {@inheritdoc}
     */
    public function getGiftMessageId()
    {
        return $this->getData(self::GIFT_MESSAGE_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setGiftMessageId($id)
    {
        return $this->setData(self::GIFT_MESSAGE_ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setCustomerId($id)
    {
        return $this->setData(self::CUSTOMER_ID, $id);
    }

    /**
     * {@inheritdoc}
     */
    public function getSender()
    {
        return $this->getData(self::SENDER);
    }

    /**
     * {@inheritdoc}
     */
    public function setSender($sender)
    {
        return $this->setData(self::SENDER, $sender);
    }

    /**
     * {@inheritdoc}
     */
    public function getRecipient()
    {
        return $this->getData(self::RECIPIENT);
    }

    /**
     * {@inheritdoc}
     */
    public function setRecipient($recipient)
    {
        return $this->setData(self::RECIPIENT, $recipient);
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }
    //@codeCoverageIgnoreEnd
}
