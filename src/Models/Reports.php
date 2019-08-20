<?php

namespace Taboola\Backstage\Models;

use philperusse\Api\CollectionTransformer;
use philperusse\Api\Concerns\ValidatesParameters;
use philperusse\Api\Transformer;
use Taboola\Backstage\Transformers\CampaignMetricCollection;
use Taboola\Backstage\Transformers\SectionMetricCollection;

class Reports extends Model
{
    use ValidatesParameters;

    protected $parameterRules = [
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ];

    public function campaigns(Account $account, $params)
    {
        return $this->report($account, 'campaign_breakdown', $params, new CampaignMetricCollection(new Campaign, 'results'));
    }

    public function sections(Account $account, $params)
    {
        return $this->report($account, 'campaign_site_day_breakdown', $params, new SectionMetricCollection(new Section, 'results'));
    }

    public function sites(Account $account, $params)
    {
        return $this->report($account, 'site_breakdown', $params);
    }

    public function visit_value(Account $account, $params)
    {
        $this->validateParameters($params);

        return $this->call($account->id .'/reports/visit-value/dimensions/by_campaign', new CollectionTransformer(null, 'results'), $params);
    }

    public function revenues(Account $account, $params)
    {
        $this->validateParameters($params);

        return $this->call($account->id .'/reports/revenue-summary/dimensions/day', new CollectionTransformer(null, 'results'), $params);
    }

    private function report(Account $account, $dimension, $params, $prototype = null)
    {
        $this->validateParameters($params);
        return $this->call($account->id .'/reports/campaign-summary/dimensions/' .$dimension , $prototype, $params);
    }

}