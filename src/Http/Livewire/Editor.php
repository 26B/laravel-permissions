<?php

namespace TwentySixB\LaravelPermissions\Http\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use TwentySixB\LaravelPermissions\Actions\AbstractQuery;
use TwentySixB\LaravelPermissions\Events\PermissionGranted;
use TwentySixB\LaravelPermissions\Events\PermissionRevoked;

/**
 * Permission editor.
 *
 */
class Editor extends Component
{

	/**
	 * Model where permission applies to.
	 *
	 * @var Model
	 */
	public Model $model;

	/**
	 * Name / Indentifier of the permission.
	 *
	 * @var string
	 */
	public string $identifier;

	/**
	 * Search query.
	 *
	 * @var string
	 */
	public string $query = '';

	/**
	 * Indicates if component is in search mode.
	 *
	 * @var boolean
	 */
	public bool $isSearching = false;

	/**
	 * Class that will handle searching and listing.
	 *
	 * @var string
	 */
	public string $searchAction;

	/**
	 * Users with current permission.
	 *
	 * @var Collection
	 */
	public Collection $usersWithPermission;

	/**
	 * Users eligeble for the current permission.
	 *
	 * @var Collection
	 */
	public Collection $eligebleForPermission;

    /**
     * @inheritDoc
     *
     * @return void
     */
    public function mount()
    {
		$this->usersWithPermission   = collect();
		$this->eligebleForPermission = collect();

		$this->fetchUsersWithPermission();
    }

	/**
	 * Returns the action responsible for searching and listing.
	 *
	 * @return AbstractQuery
	 */
	protected function getAction() : AbstractQuery
	{
		return (new ($this->searchAction)(
			$this->model,
			$this->identifier,
		));
	}

	/**
	 * Performs a search for users without permission.
	 *
	 * @return void
	 */
	public function search() : void
	{
		if (empty($this->query)) {
			$this->resetSearch();
			return;
		}
		
		$this->eligebleForPermission = $this->getAction()->search($this->query)->get();
		$this->isSearching = true;
	}

	/**
	 * Resets the search form.
	 *
	 * @return void
	 */
	public function resetSearch() : void
	{
		$this->eligebleForPermission = collect();
		$this->query = '';
		$this->isSearching = false;
	}

	/**
	 * Populate the list of users with the current permission.
	 *
	 * @return void
	 */
	public function fetchUsersWithPermission() : void
	{
		$this->usersWithPermission = $this->getAction()->list()->get();
	}

	/**
	 * Grant permissions for a given user.
	 *
	 * @param string $user_id
	 * @return void
	 */
	public function grant(string $user_id) : void
	{
		PermissionGranted::dispatch(
			$this->model,
			$this->identifier,
			$user_id,
			Auth::user(),
		);

		$this->fetchUsersWithPermission();
		$this->resetSearch();
	}

	/**
	 * Revoke permissions for a given user.
	 *
	 * @param string $user_id
	 * @return void
	 */
	public function revoke(string $user_id) : void
	{
		PermissionRevoked::dispatch(
			$this->model,
			$this->identifier,
			$user_id,
			Auth::user(),
		);

		$this->fetchUsersWithPermission();
	}

    /**
     * @inheritDoc
     *
     * @return void
     */
    public function render()
    {
        return view('permissions::livewire.editor');
    }
}
