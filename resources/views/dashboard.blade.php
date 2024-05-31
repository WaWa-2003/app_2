<x-app-layout>
    <x-slot name="header"> </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- one section --}}
            <div class="mb-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg d-flex">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                    {{ auth()->user()->type }}
                    {{ auth()->user()->complete_profile_status }}

                    @if(auth()->user()->complete_profile_status === 0)
                    <br>
                    <a href="{{ route('profile.edit') }}">
                        {{ __("Complete your profile!") }}
                    </a>
                    @endif
                </div>
            </div>

            {{-- opportunities --}}
            <div class="mb-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg d-flex">
                @include('opportunity.partials.index')
            </div>

        </div>
    </div>
</x-app-layout>

