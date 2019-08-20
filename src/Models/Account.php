<?php

namespace Taboola\Backstage\Models;

use philperusse\Api\CollectionTransformer;

class Account extends Model
{
    public function all()
    {
        return $this->call('users/current/allowed-accounts', new CollectionTransformer($this, 'results'));
    }

    public function get($id)
    {
        $account = new static($id);
        return $account;
    }

    public function campaigns()
    {
        $this->needsMultipleAttributes([
            'id',
        ]);

        return $this->call($this->id . '/campaigns', new CollectionTransformer(new Campaign, 'results'));
    }

}