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

class PermissionRevoked
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

	public function __construct(
        protected Model $model,
		protected string $identifier,
		protected string $revokee_id,
		protected User $revoker,
    ) {}

	public function getModel() : Model
	{
		return $this->model;
	}

	public function getIdentifier() : string
	{
		return $this->identifier;
	}

	public function getRevokeeId() : string
	{
		return $this->revokee_id;
	}

	public function getRevoker() : User
	{
		return $this->revoker;
	}
}
