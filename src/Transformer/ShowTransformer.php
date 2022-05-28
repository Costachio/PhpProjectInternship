<?php

namespace App\Transformer;

use App\Entity\Show;

class ShowTransformer
{
    public function transform(?Show $show): array{
        return[
            'id'=>$show->getId(),
            'title'=>$show->getTitle(),
            'show_status'=>$show->getShowStatus()
        ];
    }

    public function transformList(array $shows): array
    {
        $showsArray = [];
        foreach ($shows as $show) {
            $showsArray[] = $this->transform($show);
        }
        return $showsArray;
    }

}