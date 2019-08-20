<?php

namespace Taboola\Backstage\Transformers;

use philperusse\Api\CollectionTransformer;
use Taboola\Backstage\Models\Campaign;
use Taboola\Backstage\Models\Section;

class SectionMetricCollection extends CollectionTransformer
{
    public function __invoke($results)
    {
        // We are only replacing campaign_name and campaign in name and id
        $results['results'] =
            collect($results['results'])->map(function($row){
                $row['id'] = $row['site'];
                return $row;
            })->toArray();

        return $this->transform($results);
    }
}