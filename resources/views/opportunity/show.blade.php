
<x-app-layout>

    <a href="{{ route('opportunity.index') }}" class="btn btn-primary">Back</a>

    <div class="mb-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg d-flex">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('opportunity.partials.show')
        </div>
    </div>

    {{-- <div class="mb-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg d-flex">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('opportunity.partials.index')
        </div>
    </div> --}}

</x-app-layout>

