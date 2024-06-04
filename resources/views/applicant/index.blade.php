<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Background') }}
        </h2>
    </x-slot>
    <div>
        <div class="px-40 py-2 bg-white dark:bg-gray-800">
            @include('applicant.education.index')
        </div>
        <div class="px-40 py-2 bg-white dark:bg-gray-800">
            @include('applicant.job.index')
        </div>
        <div class="px-40 py-2 bg-white dark:bg-gray-800">
            @include('applicant.other.index')
        </div>
    </div>

    {{-- <div>
        <div class="max-w-7xl mx-auto d-flex py-2">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('applicant.education.index')
            </div>
        </div>
        <div class="max-w-7xl mx-auto d-flex pb-2">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('applicant.job.index')
            </div>
        </div>
        <div class="max-w-7xl mx-auto d-flex pb-2">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                @include('applicant.other.index')
            </div>
        </div>
    </div> --}}
</x-app-layout>
