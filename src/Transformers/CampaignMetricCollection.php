<?php

namespace Taboola\Backstage\Transformers;

use philperusse\Api\CollectionTransformer;
use Taboola\Backstage\Models\Campaign;

class CampaignMetricCollection extends CollectionTransformer
{
    public function __invoke($results)
    {
        // We are only replacing campaign_name and campaign in name and id
        $results['results'] =
            collect($results['results'])
                ->map(function($row){
                    $row['id'] = $row['campaign'];
                    $row['name'] = $row['campaign_name'];
                    return $row;
                })->filter(function($row){
                    return $row['spent'] > 0;
                })
                  ->toArray();

        return $this->transform($results)->keyBy(function(Campaign $campaign){
            return $campaign->id;
        });
    }
}