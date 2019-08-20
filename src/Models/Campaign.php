<?php

namespace Taboola\Backstage\Models;


class Campaign extends Model
{
    public function get(Account $account, $id)
    {
        return $this->call($account->id . '/campaigns/' . $id,  $this);
    }

    public function update(Account $account, $params)
    {
        $this->needsAttribute('id');

        return $this->call($account->id . '/campaigns/' . $this->id, $this, $params, 'PUT');
    }
}