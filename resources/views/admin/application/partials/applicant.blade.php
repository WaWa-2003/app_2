<div class="container mx-auto">
    <nav class="nav flex">
        <x-secondary-button class="bg-blue-500 hover:bg-gray-500 text-white"
            onclick="showSection('overview')">Overview</x-secondary-button>
        <x-secondary-button class="bg-blue-500 hover:bg-gray-500 text-white"
            onclick="showSection('cv')">CV</x-secondary-button>
    </nav>

    <section id="overview">
        <div class="flex justify-between my-4 gap-1">
            <div>

                <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                    <strong>Personal Information</strong>
                </h2>

                <div><strong>Name - </strong> {{ $user->name }}</div>
                <div><strong>Email - </strong> {{ $user->email }}</div>
                <div><strong>Gender - </strong> {{ $user->gender }}</div>
                <div><strong>DoB - </strong> {{ $user->date_of_birth }}</div>
                <div><strong>Phone - </strong> {{ $user->phone_number }}</div>
                <div><strong>Avaliable - </strong> {{ $user->currently_looking_job }}</div>
                <div><strong>Current Job - </strong> {{ $user->current_job_position }}</div>
                <div><strong>Expected Salary - </strong> {{ $user->expected_salary }}</div>
            </div>

            <div>

                <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                    <strong>Note</strong>
                </h2>

                @if (session('messageNote'))
                    <div id="message-note">
                        {{ session('messageNote') }}
                    </div>
                @endif

                <form
                    action="{{ route('note.store', ['opportunity_id' => $application->opportunity->id, 'status' => $status, 'applicant_id' => $user->id]) }}"
                    method="POST" class="mt-6 space-y-6">
                    @csrf

                    <div class="hidden">
                        <x-input-label for="application_id" :value="__('Application Id')" />
                        <x-text-input id="application_id" name="application_id" type="text" class="mt-1 block w-full"
                            value="{{ $application->id }}" placeholder="Application Id" required />
                        <x-input-error class="mt-2" :messages="$errors->get('application_id')" />
                    </div>

                    <div class="hidden">
                        <x-input-label for="applicant_id" :value="__('Applicant Id')" />
                        <x-text-input id="applicant_id" name="applicant_id" type="text" class="mt-1 block w-full"
                            value="{{ $user->id }}" placeholder="Applicant Id" required />
                        <x-input-error class="mt-2" :messages="$errors->get('applicant_id')" />
                    </div>

                    <div class="hidden">
                        <x-input-label for="step" :value="__('Step')" />
                        <x-text-input id="step" name="step" type="text" class="mt-1 block w-full"
                            value="overview" placeholder="Step" required />
                        <x-input-error class="mt-2" :messages="$errors->get('step')" />
                    </div>

                    <div class="hidden">
                        <x-input-label for="commenter_id" :value="__('Commenter Id')" />
                        <x-text-input id="commenter_id" name="commenter_id" type="text" class="mt-1 block w-full"
                            value="{{ auth()->user()->id }}" placeholder="Commenter Id" required />
                        <x-input-error class="mt-2" :messages="$errors->get('commenter_id')" />
                    </div>

                    <!-- Rating 1 to 5  -->
                    <div>
                        <select id="rating" name="rating" class="mt-1 block w-full" required>
                            <option value="" disabled selected>Select Rating</option>
                            @for ($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('rating')" />
                    </div>

                    <!-- Note -->
                    <div>
                        <x-textarea-input id="note" name="note" class="mt-1 block w-full" placeholder="Note"
                            required></x-textarea-input>
                        <x-input-error class="mt-2" :messages="$errors->get('note')" />
                    </div>

                    <div class="flex items-center gap-4 mt-4">
                        <x-primary-button>{{ __('Submit') }}</x-primary-button>
                    </div>
                </form>


            </div>
        </div>
    </section>

    <section id="cv" class="section hidden">
        <div>

            <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                <strong>CV</strong>
            </h2>

            <p>a file here</p>
        </div>
    </section>
</div>

<script>
    function showSection(sectionId) {
        document.getElementById('overview').classList.add('hidden');
        document.getElementById('cv').classList.add('hidden');

        document.getElementById('overview').classList.remove('block');
        document.getElementById('cv').classList.remove('block');

        document.getElementById(sectionId).classList.remove('hidden');
        document.getElementById(sectionId).classList.add('block');
    }
</script>

<script>
    // Hide success message after 5 seconds
    setTimeout(function() {
        var messageNote = document.getElementById('message-note');
        if (messageNote) {
            messageNote.style.display = 'none';
        }
    }, 5000);
</script>
