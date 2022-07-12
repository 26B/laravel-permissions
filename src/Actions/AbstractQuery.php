<?php

namespace TwentySixB\LaravelPermissions\Actions;

use Illuminate\Contracts\Database\Eloquent\Builder;

abstract class AbstractQuery
{

	/**
	 * Returns a query for users eligeble for permission granting.
	 *
	 * @param string $query
	 * @return Builder
	 */
	abstract public function search(string $query) : Builder;

	/**
	 * Returns a query for users with given permission.
	 *
	 * @return Builder
	 */
	abstract public function list() : Builder;
}
