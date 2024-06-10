<section>
    <div class="flex align-center">
        <div>
            <a href="{{ route('application.index') }}">
                <x-secondary-button>Back</x-secondary-button>
            </a>
        </div>
        @if (!$applications->isEmpty())
            <div class="ms-3">
                <h2 class="text-2xl font-medium text-gray-900 dark:text-gray-100">
                    <strong>
                        {{ $applications->first()->opportunity->name }} - {{ $status }}
                    </strong>
                </h2>
            </div>
        @endif
    </div>

    @if ($applications->isEmpty())
        <div class="text-center text-gray-600 dark:text-gray-300">
            There is no data for this status.
        </div>
    @else
        @if (empty($user))
            @foreach ($applications->chunk(3) as $chunk)
                <div class="flex gap-4 p-3">
                    @foreach ($chunk as $application)
                        <div class="applicant-div" id="applicant-div-{{ $application->id }}">
                            <div class="applicant-content p-3 mb-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    Name - {{ $application->user->name }}
                                </p>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    Status - {{ $application->application_status }}
                                </p>
                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                    Applied Date - {{ $application->created_at }}
                                </p>
                                <a class="btn btn-info check-button" data-applicant-id="{{ $application->id }}"
                                    href="{{ route('application.opportunity.applicant', ['opportunity_id' => $application->opportunity->id, 'status' => $status, 'applicant_id' => $application->user->id]) }}">
                                    Check
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <div class="flex gap-4">
                <div class="w-1/4">
                    @foreach ($applications->chunk(3) as $chunk)
                        <div class="flex flex-col gap-4 p-3">
                            @foreach ($chunk as $application)

                                <div class="applicant-div" id="applicant-div-{{ $application->id }}">

                                    @if ($applicant_id == $application->user->id)

                                    <div class="applicant-content p-3 mb-3 bg-black border border-gray-200 rounded-lg shadow dark:bg-gray-200 dark:border-gray-700">

                                        <p class="mb-3 font-normal text-white dark:text-gray-200">
                                            Name - {{ $application->user->name }}
                                        </p>
                                        <p class="mb-3 font-normal text-white dark:text-gray-200">
                                            Status - {{ $application->application_status }}
                                        </p>

                                        <p class="mb-3 font-normal text-white dark:text-gray-200">
                                            Applied Date - {{ $application->created_at }}
                                        </p>

                                        <a class="btn btn-info check-button text-white" data-applicant-id="{{ $application->id }}"
                                            href="{{ route('application.opportunity.applicant', ['opportunity_id' => $application->opportunity->id, 'status' => $status, 'applicant_id' => $application->user->id]) }}">
                                            Check
                                        </a>
                                    </div>

                                    @else

                                    <div class="applicant-content p-3 mb-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            Name - {{ $application->user->name }}
                                        </p>
                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            Status - {{ $application->application_status }}
                                        </p>

                                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                            Applied Date - {{ $application->created_at }}
                                        </p>

                                        <a class="btn btn-info check-button" data-applicant-id="{{ $application->id }}"
                                            href="{{ route('application.opportunity.applicant', ['opportunity_id' => $application->opportunity->id, 'status' => $status, 'applicant_id' => $application->user->id]) }}">
                                            Check
                                        </a>
                                    </div>

                                    @endif

                                </div>

                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="w-3/4">
                    @include('admin.application.partials.applicant')
                </div>
            </div>
        @endif
    @endif
</section>
