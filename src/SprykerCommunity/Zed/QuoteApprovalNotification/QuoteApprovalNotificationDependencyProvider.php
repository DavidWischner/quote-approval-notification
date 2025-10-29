<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToCompanyUserFacadeBridge;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToCompanyUserFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToCustomerFacadeBridge;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToCustomerFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToMailFacadeBridge;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToMailFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteApprovalFacadeBridge;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteApprovalFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteFacadeBridge;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToQuoteFacadeInterface;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToRouterFacadeBridge;
use SprykerCommunity\Zed\QuoteApprovalNotification\Dependency\Facade\QuoteApprovalNotificationToRouterFacadeInterface;

class QuoteApprovalNotificationDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const FACADE_QUOTE_APPROVAL = 'FACADE_QUOTE_APPROVAL';

    /**
     * @var string
     */
    public const FACADE_MAIL = 'FACADE_MAIL';

    /**
     * @var string
     */
    public const FACADE_COMPANY_USER = 'FACADE_COMPANY_USER';

    /**
     * @var string
     */
    public const FACADE_CUSTOMER = 'FACADE_CUSTOMER';

    /**
     * @var string
     */
    public const FACADE_QUOTE = 'FACADE_QUOTE';

    /**
     * @var string
     */
    public const FACADE_ROUTER = 'FACADE_ROUTER';

    /**
     * @var string
     */
    public const PLUGINS_QUOTE_APPROVAL_NOTIFICATION_EXPANDER = 'PLUGINS_QUOTE_APPROVAL_NOTIFICATION_EXPANDER';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
        $container = $this->addQuoteApprovalFacade($container);
        $container = $this->addMailFacade($container);
        $container = $this->addCompanyUserFacade($container);
        $container = $this->addCustomerFacade($container);
        $container = $this->addQuoteFacade($container);
        $container = $this->addRouterFacade($container);
        $container = $this->addQuoteApprovalNotificationExpanderPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQuoteApprovalFacade(Container $container): Container
    {
        $container->set(static::FACADE_QUOTE_APPROVAL, static function (Container $container): QuoteApprovalNotificationToQuoteApprovalFacadeInterface {
            return new QuoteApprovalNotificationToQuoteApprovalFacadeBridge(
                $container->getLocator()->quoteApproval()->facade(),
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addMailFacade(Container $container): Container
    {
        $container->set(static::FACADE_MAIL, static function (Container $container): QuoteApprovalNotificationToMailFacadeInterface {
            return new QuoteApprovalNotificationToMailFacadeBridge(
                $container->getLocator()->mail()->facade(),
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCompanyUserFacade(Container $container): Container
    {
        $container->set(static::FACADE_COMPANY_USER, static function (Container $container): QuoteApprovalNotificationToCompanyUserFacadeInterface {
            return new QuoteApprovalNotificationToCompanyUserFacadeBridge(
                $container->getLocator()->companyUser()->facade(),
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCustomerFacade(Container $container): Container
    {
        $container->set(static::FACADE_CUSTOMER, static function (Container $container): QuoteApprovalNotificationToCustomerFacadeInterface {
            return new QuoteApprovalNotificationToCustomerFacadeBridge(
                $container->getLocator()->customer()->facade(),
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQuoteFacade(Container $container): Container
    {
        $container->set(static::FACADE_QUOTE, static function (Container $container): QuoteApprovalNotificationToQuoteFacadeInterface {
            return new QuoteApprovalNotificationToQuoteFacadeBridge(
                $container->getLocator()->quote()->facade(),
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addRouterFacade(Container $container): Container
    {
        $container->set(static::FACADE_ROUTER, static function (Container $container): QuoteApprovalNotificationToRouterFacadeInterface {
            return new QuoteApprovalNotificationToRouterFacadeBridge(
                $container->getLocator()->router()->facade(),
            );
        });

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addQuoteApprovalNotificationExpanderPlugins(Container $container): Container
    {
        $container->set(static::PLUGINS_QUOTE_APPROVAL_NOTIFICATION_EXPANDER, function (): array {
            return $this->getQuoteApprovalNotificationExpanderPlugins();
        });

        return $container;
    }

    /**
     * @return list<\SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Expander\QuoteApprovalNotificationExpanderPluginInterface>
     */
    protected function getQuoteApprovalNotificationExpanderPlugins(): array
    {
        return [];
    }
}
