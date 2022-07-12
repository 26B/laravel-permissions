<?php

namespace TwentySixB\LaravelPermissions\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;

class PermissionGranted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        protected Model $model,
		protected string $identifier,
		protected string $grantee_id,
		protected User $granter,
    ) {}

	public function getModel() : Model
	{
		return $this->model;
	}

	public function getIdentifier() : string
	{
		return $this->identifier;
	}

	public function getGranteeId() : string
	{
		return $this->grantee_id;
	}

	public function getGranter() : User
	{
		return $this->granter;
	}
}
