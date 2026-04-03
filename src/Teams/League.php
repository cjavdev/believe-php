<?php

declare(strict_types=1);

namespace Believe\Teams;

/**
  * Football leagues.
  *
 */
enum League : string
{

    case PREMIER_LEAGUE = 'Premier League';

    case CHAMPIONSHIP = 'Championship';

    case LEAGUE_ONE = 'League One';

    case LEAGUE_TWO = 'League Two';

    case LA_LIGA = 'La Liga';

    case SERIE_A = 'Serie A';

    case BUNDESLIGA = 'Bundesliga';

    case LIGUE_1 = 'Ligue 1';

}