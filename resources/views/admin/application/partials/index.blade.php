<div>
    <div class="header-row flex bg-gray-200 py-2 px-4">
        <div class="w-full mt-1 flex justify-center text-2xl font-bold">Opportunity Name</div>
        <div class="w-full mt-1 flex justify-center text-2xl font-bold">Number of Applications</div>
        <div class="w-full mt-1 flex justify-center text-2xl font-bold">Actions</div>
    </div>
    @forelse ($groupedApplications as $opportunityId => $applications)
    <div class="header-row flex bg-white px-4 py-1 border-b border-gray-300 justify-center align-center" data-id="{{ $opportunityId }}">
        <div class="w-full flex justify-center">{{ $applications->first()->opportunity->name }}</div>
        <div class="w-full flex justify-center">{{ $applications->count() }}</div>
        <div class="w-full flex justify-center">
            <x-secondary-button>
                <a href="{{ route('application.opportunity.show', $opportunityId) }}">Show</a>
            </x-secondary-button>
        </div>
    </div>
    @empty
        <div class="header-row flex bg-white px-4">
            <div class="w-full flex justify-center" colspan="3">No applications found.</div>
        </div>
    @endforelse
</div>

{{-- Alternative design
@foreach ($groupedApplications as $opportunityId => $applications)
    <div class="p-3 mb-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h3 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ $applications->first()->opportunity->name }}
        </h3>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            Number of Applications: {{ $applications->count() }}
        </p>
        <x-secondary-button>
            <a href="{{ route('application.opportunity.show', $opportunityId) }}">Show</a>
        </x-secondary-button>
    </div>
@endforeach --}}
