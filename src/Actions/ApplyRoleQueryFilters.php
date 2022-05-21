<?php

namespace Mdhesari\LaravelSpatieRolePermission\Actions;

use Mdhesari\LaravelQueryFilters\Abstract\BaseQueryFilters;

class ApplyRoleQueryFilters extends BaseQueryFilters
{
    public function __invoke($query, array $data)
    {
        parent::__invoke($query, $data);

        $query->with(['permissions', 'users']);

        if ( isset($data['role_id']) ) {
            $query->where('id', $data['role_id']);
        }

        return $query;
    }
}
