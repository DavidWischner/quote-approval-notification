<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalNotification\Communication\Plugin\Event;

use Spryker\Zed\Event\Dependency\EventCollectionInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventSubscriberInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * Subscribes to events dispatched by the Propel EventBehavior.
 */
class QuoteApprovalEventSubscriberPlugin extends AbstractPlugin implements EventSubscriberInterface
{
    /**
     * @var string
     */
    const EVENT_ENTITY_SPY_QUOTE_APPROVAL_CREATE = 'Entity.spy_quote_approval.create';
    /**
     * @var string
     */
    const EVENT_ENTITY_SPY_QUOTE_APPROVAL_UPDATE = 'Entity.spy_quote_approval.update';
    /**
     * @var string
     */
    const EVENT_ENTITY_SPY_QUOTE_APPROVAL_DELETE = 'Entity.spy_quote_approval.delete';

    /**
     * {@inheritDoc}
     * - Subscribes to quote approval create, update, and delete events.
     *
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return \Spryker\Zed\Event\Dependency\EventCollectionInterface
     *@api
     */
    public function getSubscribedEvents(EventCollectionInterface $eventCollection): EventCollectionInterface
    {
        $this->addQuoteApprovalCreateListener($eventCollection);
        $this->addQuoteApprovalUpdateListener($eventCollection);
        $this->addQuoteApprovalDeleteListener($eventCollection);

        return $eventCollection;
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addQuoteApprovalCreateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            self::EVENT_ENTITY_SPY_QUOTE_APPROVAL_CREATE,
            new QuoteApprovalCreateListenerPlugin(),
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addQuoteApprovalUpdateListener(EventCollectionInterface $eventCollection)
    {
        $eventCollection->addListenerQueued(
            self::EVENT_ENTITY_SPY_QUOTE_APPROVAL_UPDATE,
            new QuoteApprovalUpdateListenerPlugin(),
        );
    }

    /**
     * @param \Spryker\Zed\Event\Dependency\EventCollectionInterface $eventCollection
     *
     * @return void
     */
    protected function addQuoteApprovalDeleteListener(EventCollectionInterface $eventCollection)
    {
        // this event is triggered whenever an approval is deleted which also happens when the quote was placed -> therefore I do not recommend to use it without adjustment
//        $eventCollection->addListenerQueued(
//            self::EVENT_ENTITY_SPY_QUOTE_APPROVAL_DELETE,
//            new QuoteApprovalDeleteListenerPlugin(),
//        );
    }
}
