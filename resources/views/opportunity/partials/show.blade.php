
<section>
    <header>
        <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
            {{ $opportunity->name }}
        </h2>
    </header>
    <p class="mt-1 text-sm text-gray-800 dark:text-gray-400">

        <span class="inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
            </svg>
            {{ $opportunity->location }}
        </span> <br>

        <span class="inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
            </svg>
            {{ $opportunity->department }}
        </span> <br>

        <span class="inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            {{ $opportunity->job_type }}
        </span> <br>
    </p>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        Posted 1 day ago
    </p>

    <div class="inline-flex">

        <a href="{{ route('opportunity.show',$opportunity->id) }}" class="inline-flex items-center p-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Apply Now
        </a>

        <button class="ms-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold p-2 inline-flex rounded-lg items-center">
            <span class="inline-flex">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
                Wishlist
            </span>
        </button>

    </div>
    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ $opportunity->description }} <br>

        <strong> Reporting to : </strong> Someone <br>
        <strong> Open to gender : </strong> Any <br>

        <strong> Requirements : </strong> <br>
        <ul>
            @foreach ($requirements as $requirement)
                <li>{{ $requirement->requirement }}</li>
            @endforeach
        </ul>
    </p>

</section>