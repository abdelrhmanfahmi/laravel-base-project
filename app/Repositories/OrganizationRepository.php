<?php

namespace App\Repositories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;

class OrganizationRepository extends BaseRepository
{
    public function __construct(Organization $organization)
    {
        parent::__construct($organization);
    }

}
