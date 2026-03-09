<?php

declare(strict_types=1);

namespace Believe\Biscuits\Biscuit;

/**
 * Type of biscuit.
 */
enum Type: string
{
    case CLASSIC = 'classic';

    case SHORTBREAD = 'shortbread';

    case CHOCOLATE_CHIP = 'chocolate_chip';

    case OATMEAL_RAISIN = 'oatmeal_raisin';

    case SNICKERDOODLE = 'snickerdoodle';

    case LEMON_DRIZZLE = 'lemon_drizzle';
}
