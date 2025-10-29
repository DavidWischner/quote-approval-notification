<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander\ApproverExpander;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander\BuyerExpander;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander\LinkExpander;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander\QuoteApprovalNotificationExpanderInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander\QuoteExpander;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\QuoteApprovalNotificationBuilder;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\QuoteApprovalNotificationBuilderInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\EventHandler\QuoteApprovalCreateEventHandler;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\EventHandler\QuoteApprovalDeleteEventHandler;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\EventHandler\QuoteApprovalEventHandlerInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\EventHandler\QuoteApprovalUpdateEventHandler;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander\QuoteApprovalExpander;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Mailer\QuoteApprovalMailer;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Mailer\QuoteApprovalMailerInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Mapper\QuoteApprovalEventMapper;
use SprykerCommunity\Zed\QuoteApprovalNotification\Business\Mapper\QuoteApprovalEventMapperInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToCompanyUserFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToCustomerFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToMailFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteApprovalFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToRouterFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\QuoteApprovalNotificationDependencyProvider;

/**
 * @method \SprykerCommunity\Zed\QuoteApprovalNotification\QuoteApprovalNotificationConfig getConfig()
 */
class QuoteApprovalNotificationBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Business\Mailer\QuoteApprovalMailerInterface
     */
    public function createQuoteApprovalMailer(): QuoteApprovalMailerInterface
    {
        return new QuoteApprovalMailer(
            $this->getMailFacade(),
        );
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\QuoteApprovalNotificationBuilderInterface
     */
    public function createQuoteApprovalNotificationBuilder(): QuoteApprovalNotificationBuilderInterface
    {
        return new QuoteApprovalNotificationBuilder(
            $this->getQuoteApprovalNotificationExpanderPlugins(),
        );
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander\QuoteApprovalNotificationExpanderInterface
     */
    public function createApproverExpander(): QuoteApprovalNotificationExpanderInterface
    {
        return new ApproverExpander(
            $this->getCompanyUserFacade(),
        );
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander\QuoteApprovalNotificationExpanderInterface
     */
    public function createBuyerExpander(): QuoteApprovalNotificationExpanderInterface
    {
        return new BuyerExpander(
            $this->getQuoteFacade(),
            $this->getCustomerFacade(),
        );
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander\QuoteApprovalNotificationExpanderInterface
     */
    public function createLinkExpander(): QuoteApprovalNotificationExpanderInterface
    {
        return new LinkExpander(
            $this->getConfig(),
            $this->getRouterFacade(),
        );
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander\QuoteApprovalNotificationExpanderInterface
     */
    public function createQuoteExpander(): QuoteApprovalNotificationExpanderInterface
    {
        return new QuoteExpander(
            $this->getQuoteFacade(),
        );
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Business\EventHandler\QuoteApprovalEventHandlerInterface
     */
    public function createQuoteApprovalCreateEventHandler(): QuoteApprovalEventHandlerInterface
    {
        return new QuoteApprovalCreateEventHandler(
            $this->createQuoteApprovalEventMapper(),
            $this->createQuoteApprovalNotificationBuilder(),
            $this->createQuoteApprovalMailer(),
        );
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Business\EventHandler\QuoteApprovalEventHandlerInterface
     */
    public function createQuoteApprovalUpdateEventHandler(): QuoteApprovalEventHandlerInterface
    {
        return new QuoteApprovalUpdateEventHandler(
            $this->createQuoteApprovalEventMapper(),
            $this->createQuoteApprovalNotificationBuilder(),
            $this->createQuoteApprovalMailer(),
        );
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Business\EventHandler\QuoteApprovalEventHandlerInterface
     */
    public function createQuoteApprovalDeleteEventHandler(): QuoteApprovalEventHandlerInterface
    {
        return new QuoteApprovalDeleteEventHandler(
            $this->createQuoteApprovalEventMapper(),
            $this->createQuoteApprovalNotificationBuilder(),
            $this->createQuoteApprovalMailer(),
        );
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Business\Mapper\QuoteApprovalEventMapperInterface
     */
    public function createQuoteApprovalEventMapper(): QuoteApprovalEventMapperInterface
    {
        return new QuoteApprovalEventMapper();
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Business\Builder\Expander\QuoteApprovalNotificationExpanderInterface
     */
    public function createQuoteApprovalExpander(): QuoteApprovalNotificationExpanderInterface
    {
        return new QuoteApprovalExpander(
            $this->getQuoteApprovalFacade(),
        );
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteApprovalFacadeInterface
     */
    public function getQuoteApprovalFacade(): QuoteApprovalNotificationToQuoteApprovalFacadeInterface
    {
        return $this->getProvidedDependency(QuoteApprovalNotificationDependencyProvider::FACADE_QUOTE_APPROVAL);
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToMailFacadeInterface
     */
    public function getMailFacade(): QuoteApprovalNotificationToMailFacadeInterface
    {
        return $this->getProvidedDependency(QuoteApprovalNotificationDependencyProvider::FACADE_MAIL);
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToCompanyUserFacadeInterface
     */
    public function getCompanyUserFacade(): QuoteApprovalNotificationToCompanyUserFacadeInterface
    {
        return $this->getProvidedDependency(QuoteApprovalNotificationDependencyProvider::FACADE_COMPANY_USER);
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToCustomerFacadeInterface
     */
    public function getCustomerFacade(): QuoteApprovalNotificationToCustomerFacadeInterface
    {
        return $this->getProvidedDependency(QuoteApprovalNotificationDependencyProvider::FACADE_CUSTOMER);
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteFacadeInterface
     */
    public function getQuoteFacade(): QuoteApprovalNotificationToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(QuoteApprovalNotificationDependencyProvider::FACADE_QUOTE);
    }

    /**
     * @return \SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToRouterFacadeInterface
     */
    public function getRouterFacade(): QuoteApprovalNotificationToRouterFacadeInterface
    {
        return $this->getProvidedDependency(QuoteApprovalNotificationDependencyProvider::FACADE_ROUTER);
    }

    /**
     * @return array<\SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Expander\QuoteApprovalNotificationExpanderPluginInterface>
     */
    public function getQuoteApprovalNotificationExpanderPlugins(): array
    {
        return $this->getProvidedDependency(QuoteApprovalNotificationDependencyProvider::PLUGINS_QUOTE_APPROVAL_NOTIFICATION_EXPANDER);
    }
}
