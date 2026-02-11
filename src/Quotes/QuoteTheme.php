<?php

declare(strict_types=1);

namespace Believe\Quotes;

/**
 * Themes that quotes can be categorized under.
 */
enum QuoteTheme: string
{
    case BELIEF = 'belief';

    case TEAMWORK = 'teamwork';

    case CURIOSITY = 'curiosity';

    case KINDNESS = 'kindness';

    case RESILIENCE = 'resilience';

    case VULNERABILITY = 'vulnerability';

    case GROWTH = 'growth';

    case HUMOR = 'humor';

    case WISDOM = 'wisdom';

    case LEADERSHIP = 'leadership';

    case LOVE = 'love';

    case FORGIVENESS = 'forgiveness';

    case PHILOSOPHY = 'philosophy';

    case ROMANCE = 'romance';

    case CULTURAL_PRIDE = 'cultural-pride';

    case CULTURAL_DIFFERENCES = 'cultural-differences';

    case ANTAGONISM = 'antagonism';

    case CELEBRATION = 'celebration';

    case IDENTITY = 'identity';

    case ISOLATION = 'isolation';

    case POWER = 'power';

    case SACRIFICE = 'sacrifice';

    case STANDARDS = 'standards';

    case CONFIDENCE = 'confidence';

    case CONFLICT = 'conflict';

    case HONESTY = 'honesty';

    case INTEGRITY = 'integrity';
}
