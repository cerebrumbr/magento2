<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Webapi\Model\Authorization;

use Magento\Authorization\Model\UserContextInterface;
use Magento\Framework\Oauth\Helper\Request as OauthRequestHelper;
use Magento\Framework\Oauth\OauthInterface as OauthService;
use Magento\Integration\Service\V1\Integration as IntegrationService;
use Magento\Framework\Webapi\Request;

/**
 * A user context determined by OAuth headers in a HTTP request.
 */
class OauthUserContext implements UserContextInterface
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var IntegrationService
     */
    protected $integrationService;

    /**
     * @var OauthService
     */
    protected $oauthService;

    /**
     * @var  OauthRequestHelper
     */
    protected $oauthHelper;

    /**
     * @var int
     */
    protected $integrationId;

    /**
     * Initialize dependencies.
     *
     * @param Request $request
     * @param IntegrationService $integrationService
     * @param OauthService $oauthService
     * @param OauthRequestHelper $oauthHelper
     */
    public function __construct(
        Request $request,
        IntegrationService $integrationService,
        OauthService $oauthService,
        OauthRequestHelper $oauthHelper
    ) {
        $this->request = $request;
        $this->integrationService = $integrationService;
        $this->oauthService = $oauthService;
        $this->oauthHelper = $oauthHelper;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserId()
    {
        if ($this->integrationId) {
            return $this->integrationId;
        }
        $oauthRequest = $this->oauthHelper->prepareRequest($this->request);
        //If its not a valid Oauth request no further processing is needed
        if (empty($oauthRequest)) {
            return null;
        }
        $consumerId = $this->oauthService->validateAccessTokenRequest(
            $oauthRequest,
            $this->oauthHelper->getRequestUrl($this->request),
            $this->request->getMethod()
        );
        $integration = $this->integrationService->findActiveIntegrationByConsumerId($consumerId);
        return $this->integrationId = ($integration->getId() ? (int)$integration->getId() : null);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserType()
    {
        return UserContextInterface::USER_TYPE_INTEGRATION;
    }
}
