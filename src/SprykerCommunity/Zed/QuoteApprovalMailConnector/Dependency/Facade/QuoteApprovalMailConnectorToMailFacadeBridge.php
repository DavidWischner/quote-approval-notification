<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace SprykerCommunity\Zed\QuoteApprovalMailConnector\Dependency\Facade;

use Generated\Shared\Transfer\MailTransfer;

class QuoteApprovalMailConnectorToMailFacadeBridge implements QuoteApprovalMailConnectorToMailFacadeInterface
{
    /**
     * @param \Spryker\Zed\Mail\Business\MailFacadeInterface $mailFacade
     */
    public function __construct(
        protected MailFacadeInterface $mailFacade
    ) {
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return void
     */
    public function handleMail(MailTransfer $mailTransfer): void
    {
        $this->mailFacade->handleMail($mailTransfer);
    }
}
