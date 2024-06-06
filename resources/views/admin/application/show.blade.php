<x-app-layout>
    <div class="flex justify-center items-center my-4 gap-1">
        <a href="{{ route('application.opportunity.show.all', $opportunity_id) }}">
            <x-primary-button>
                All
            </x-primary-button>
        </a>
        <a href="{{ route('application.opportunity.show.new', $opportunity_id) }}">
            <x-primary-button id="button-new">
                New
            </x-primary-button>
        </a>
        <a href="{{ route('application.opportunity.show.prescreen', $opportunity_id) }}">
            <x-primary-button id="button-prescreen">
                Prescreen
            </x-primary-button>
        </a>
        <a href="{{ route('application.opportunity.show.firstInterview', $opportunity_id) }}">
            <x-primary-button id="button-first-interview">
                First Interview
            </x-primary-button>
        </a>
        <a href="{{ route('application.opportunity.show.secondInterview', $opportunity_id) }}">
            <x-primary-button id="button-second-interview">
                Second Interview
            </x-primary-button>
        </a>
        <a href="{{ route('application.opportunity.show.thirdInterview', $opportunity_id) }}">
            <x-primary-button id="button-third-interview">
                Third Interview
            </x-primary-button>
        </a>
        <a href="{{ route('application.opportunity.show.offer', $opportunity_id) }}">
            <x-primary-button id="button-offer">
                Offer
            </x-primary-button>
        </a>
        <a href="{{ route('application.opportunity.show.accept', $opportunity_id) }}">
            <x-primary-button id="button-accept">
                Accept
            </x-primary-button>
        </a>
        <a href="{{ route('application.opportunity.show.reject', $opportunity_id) }}">
            <x-primary-button id="button-reject">
                Reject
            </x-primary-button>
        </a>
        <a href="{{ route('application.opportunity.show.notSuitable', $opportunity_id) }}">
            <x-primary-button id="button-not-suitable">
                Not Suitable
            </x-primary-button>
        </a>

    </div>

    <div class="mb-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('admin.application.partials.show')
        </div>
    </div>
</x-app-layout>
