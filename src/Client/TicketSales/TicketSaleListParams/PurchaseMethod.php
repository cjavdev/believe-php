<?php

declare(strict_types=1);

namespace Believe\Client\TicketSales\TicketSaleListParams;

/**
 * Filter by purchase method.
 */
enum PurchaseMethod: string
{
    case ONLINE = 'online';

    case BOX_OFFICE = 'box_office';

    case WILL_CALL = 'will_call';

    case PHONE = 'phone';
}
