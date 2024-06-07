@if(auth()->user()->type === 'admin')
<div class="flex justify-end">
    <a href="{{ route('opportunity.create') }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        New
    </a>
</div>
@endif

@foreach ($opportunities->chunk(3) as $chunk)
<div class="flex gap-4 p-3">
    @foreach ($chunk as $opportunity)
    <div class="w-1/3">
        <div class="p-3 mb-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <a href="#">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{ $opportunity->name }}
                </h5>
            </a>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ $opportunity->description }}
            </p>
            <p class="mb-3 text-sm text-brown">
                Up to <span class="text-lg font-semibold">{{ $opportunity->salary_max }}</span> {{ $opportunity->salary_currency }}
            </p>

            @if(auth()->user()->type === 'admin')

            <form action="{{ route('opportunity.destroy',$opportunity->id) }}" method="POST">
                <a class="btn btn-info" href="{{ route('opportunity.show',$opportunity->id) }}">Show</a>
                <a class="btn btn-primary" href="{{ route('opportunity.edit',$opportunity->id) }}">Edit</a>
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            @else

                @if (isset($applicationsByOpportunity[$opportunity->id]))

                <a href="{{ route('opportunity.show', $opportunity) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Applied
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>

                @else

                <a href="{{ route('opportunity.show', $opportunity) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Apply
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                    </svg>
                </a>

                @endif


            @endif

            <span class="text-sm font-italic text-gray-400"> Posted on {{ $opportunity->created_at }}</span>
        </div>
    </div>
    @endforeach
</div>
@endforeach

