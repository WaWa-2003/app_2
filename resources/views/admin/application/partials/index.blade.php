{{-- @foreach ($applications->chunk(3) as $chunk)
    <div class="flex gap-4 p-3">
        @foreach ($applications->chunk(3) as $chunk)
            <div class="flex gap-4 p-3">
                @foreach ($chunk as $application)
                    <div class="w-1/3">
                        <div
                            class="p-3 mb-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                    {{ $application->opportunity->name }}
                                </h5>
                            </a>
                            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                {{ $application->user->name }}
                            </p>
                            <a class="btn btn-info" href="{{ route('application.show',$application->id) }}">Show</a>
                            <span class="text-sm font-italic text-gray-400"> Submitted on {{ $application->created_at }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endforeach --}}

@foreach ($groupedApplications as $opportunityId => $applications)
    <div class="p-3 mb-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <h3 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ $applications->first()->opportunity->name }}
        </h3>
        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            Number of Applications: {{ $applications->count() }}
        </p>
        <a class="btn btn-info" href="{{ route('application.opportunity.show',$applications->first()->opportunity->id) }}">Show</a>
    </div>
@endforeach
