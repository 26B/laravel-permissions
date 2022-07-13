<li>
	<div class="flex items-center justify-between w-full p-2 space-x-3 text-left border border-gray-300 rounded-full shadow-sm group">
		<span class="flex items-center flex-1 min-w-0 space-x-3">
			<span class="flex-shrink-0 block">
				<x-backstate::avatar.single
					class="h-10 w-10 rounded-full"
					:title="$user->name"
					:label="$user->initials"
					:photoUrl="$user->profile_photo_url"
				/>
			</span>
			<span class="flex-1 block min-w-0">
				<span class="block text-sm font-medium text-gray-900 truncate">{{ $user->name }}</span>
				<span class="block text-sm font-medium text-gray-500 truncate">{{ $user->tagline }}</span>
			</span>
		</span>
		<span class="inline-flex items-center justify-center flex-shrink-0 w-10 h-10">
			{{ $slot }}
		</span>
	</div>
</li>
