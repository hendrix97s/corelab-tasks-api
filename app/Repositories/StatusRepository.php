<?php

namespace App\Repositories;

use App\Models\Status;

class StatusRepository extends Repository {

	public function __construct()
	{
		parent::__construct(Status::class);
	} 
}
