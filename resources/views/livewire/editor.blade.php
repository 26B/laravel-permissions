<div>
	@if ($usersWithPermission->isNotEmpty())
	<div class="mb-6">
		<h3 class="text-xs font-semibold tracking-wide text-gray-500 uppercase">{{ __('Users with permission') }}</h3>
		<ul role="list" class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-3">
			@foreach ($usersWithPermission as $user)
				<x-permissions::user :user="$user">
					<button
						class="rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green"
						wire:click.prevent="revoke('{{ $user->id }}')"
					>
						<!-- Heroicon name: solid/trash -->
						<svg class="w-5 h-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
						</svg>
					</button>
				</x-permissions::user>
			@endforeach
		</ul>
	</div>
	@endif

	<div class="block">
		<p class="mt-1 text-sm text-gray-500">
			{{ __('Search for an e-mail or user name.') }}
		</p>
		<div class="sm:flex sm:items-center">
			<label for="emails" class="sr-only">@lang('Search for')</label>
			<div class="relative sm:min-w-0 sm:flex-1">
				<input type="text" name="emails" id="emails" class="rounded-md shadow-sm block w-full pr-32 border-gray-300 focus:ring-green-500 focus:border-green-500 sm:text-sm" wire:model="query" placeholder="Enter a name or email">
			</div>
			<div class="mt-3 sm:mt-0 sm:ml-4 sm:flex-shrink-0">
				<button
					type="submit"
					wire:click.prevent="search"
					wire:loading.attr="disabled"
					class="block w-full px-4 py-2 text-sm font-medium text-center text-white bg-green border border-transparent rounded-md shadow-sm hover:bg-green focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
				>
					{{ __('Find') }}
				</button>
			</div>
		</div>
	</div>

	@if ($eligebleForPermission->isNotEmpty())
	<div class="mt-10">
		<h3 class="text-xs font-semibold tracking-wide text-gray-500 uppercase">{{ __('Users found') }}</h3>
		<ul role="list" class="grid grid-cols-1 gap-4 mt-4 sm:grid-cols-2">
			@foreach ($eligebleForPermission as $user)
				<x-permissions::user :user="$user">
					<button
						class="rounded-full hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green"
						wire:click.prevent="grant('{{ $user->id }}')"
					>
						<!-- Heroicon name: solid/plus -->
						<svg class="w-5 h-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
						</svg>
					</button>
				</x-permissions::user>
			@endforeach
		</ul>
	</div>
	@elseif($isSearching)
		<x-permissions::empty-list />
	@endif
</div>
