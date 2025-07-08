<div
    class="gaze-banner @if($show) gaze-banner--has-content @endif"
    x-data="{}"
    wire:poll.keep-alive.{{ $pollTimer }}s="$refresh"
>
    @if($show)
        <div>
            <div class="flex flex-row gap-4 rounded-xl p-6 border border-primary-500 text-primary-500 bg-gray-100 dark:bg-gray-900">
                <div class="flex flex-col justify-center">
                    @if($isLockable && !$hasControl)
                        <x-filament::icon
                            alias="filament-gaze::banner.locked"
                            icon="heroicon-m-lock-closed"
                            class="h-5 w-5 my-auto"
                        />
                    @else
                        <x-filament::icon
                            alias="filament-gaze::banner.view"
                            icon="heroicon-m-eye"
                            class="h-5 w-5 my-auto"
                        />
                    @endif
                </div>

                <div class="flex flex-col md:flex-row w-full justify-between">
                    <div>
                        <p>{{ $text }}</p>
                        @if($isLockable)
                            @if($hasControl)
                                <p>{{ __('filament-gaze::gaze.lock_is_controller') }}</p>
                            @elseif($controlUser)
                                <p>{{ __('filament-gaze::gaze.lock_user_controller', ['name' => $controlUser['name']]) }}</p>
                            @endif

                            @if($canTakeControl && !$hasControl)
                            @endif
                        @endif
                    </div>

                    @if($isLockable && !$hasControl && $canTakeControl)
                        <x-filament::button class="my-auto mt-2 md:mt-0" color="primary" wire:click="$dispatch('FilamentGaze::takeControl')">
                            {{ __('filament-gaze::gaze.lock_take_control') }}
                        </x-filament::button>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
