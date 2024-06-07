<x-app-layout>
    <div>
        @include('admin.application.partials.statusBar')
    </div>

    <div class="mb-4 p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg d-flex">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @include('admin.application.partials.index')
        </div>
    </div>

</x-app-layout>
