<section>
    <div class="flex ">
        <a href="{{ route('application.index') }}">
            <x-secondary-button>Back</x-secondary-button>
        </a>
    </div>
    @if ($applications->isEmpty())
        <div class="text-center text-gray-600 dark:text-gray-300">
            There is no data for this status.
        </div>
    @else
        @foreach ($applications->chunk(3) as $chunk)
            <div class="flex gap-4 p-3">
                @foreach ($chunk as $application)
                    <div>
                        <div
                            class="p-3 mb-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                Applicant Name - {{ $application->user->name }}
                            </p>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                Status - {{ $application->application_status }}
                            </p>
                            <a class="btn btn-info"
                                href="{{ route('application.opportunity.applicant', ['application' => $application->id, 'opportunity' => $application->opportunity->id, 'applicant' => $application->user->id ]) }}">
                                Check
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    @endif

    <div>
        @if (empty($user))
        @else
        @include('admin.application.partials.applicant')
        @endif
    </div>
</section>
