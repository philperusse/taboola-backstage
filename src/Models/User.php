<?php

namespace Taboola\Backstage\Models;

use philperusse\Api\CollectionTransformer;

class User extends Model
{
    public function accounts()
    {
        return $this->call('users/current/allowed-accounts/', new CollectionTransformer(new Account, 'results'));
    }
}