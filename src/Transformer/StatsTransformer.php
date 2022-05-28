<?php

namespace App\Transformer;

use App\Entity\Stats;

class StatsTransformer
{
    public function transform(?Stats $stats): array
    {
        return [
            'id' => $stats?->getId(),
            'season' => $stats->getSeason(),
            'episode' => $stats->getEpisode(),
            'time_stamp' => $stats->getTimeStamp(),
            'tv_show' => $stats->getTVShow()->getId()

        ];
    }
}