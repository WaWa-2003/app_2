<section>

    <a href="{{ route('opportunity.index') }}">
        <x-secondary-button>Back</x-secondary-button>
    </a>

    <header>
        <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
            <strong>
                Edit Opportunity
            </strong>
        </h2>
    </header>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('opportunity.update', $opportunity->id) }}" method="POST" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')


        <div class="flex gap-4">

            <!-- Name -->
            <div class="w-1/3">
                <x-input-label for="name" :value="__('Opportunity Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ $opportunity->name }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Experience Level -->
            <div class="w-1/3">
                <x-input-label for="experience_level" :value="__('Experience Level')" />
                <x-text-input id="experience_level" name="experience_level" type="text" class="mt-1 block w-full" value="{{ $opportunity->experience_level }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('experience_level')" />
            </div>
            <!-- Department -->
            <div class="w-1/3">
                <x-input-label for="department" :value="__('Department')" />
                <x-text-input id="department" name="department" type="text" class="mt-1 block w-full" value="{{ $opportunity->department }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('department')" />
            </div>
        </div>

        <div class="flex gap-4">
            <!-- Salary Min -->
            <div class="w-1/3">
                <x-input-label for="salary_min" :value="__('Salary Min')" />
                <x-text-input id="salary_min" name="salary_min" type="number" class="mt-1 block w-full" value="{{ $opportunity->salary_min }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('salary_min')" />
            </div>

            <!-- Salary Max -->
            <div class="w-1/3">
                <x-input-label for="salary_max" :value="__('Salary Max')" />
                <x-text-input id="salary_max" name="salary_max" type="number" class="mt-1 block w-full" value="{{ $opportunity->salary_max }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('salary_max')" />
            </div>

            <!-- Salary Currency -->
            <div class="w-1/3">
                <x-input-label for="salary_currency" :value="__('Salary Currency')" />
                <x-text-input id="salary_currency" name="salary_currency" type="text" class="mt-1 block w-full" value="{{ $opportunity->salary_currency }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('salary_currency')" />
            </div>
        </div>

        <div class="flex gap-4">

            <!-- Job Type -->
            <div class="w-1/3">
                <x-input-label for="job_type" :value="__('Job Type')" />
                <x-text-input id="job_type" name="job_type" type="text" class="mt-1 block w-full" value="{{ $opportunity->job_type }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('job_type')" />
            </div>

            <!-- Location -->
            <div class="w-1/3">
                <x-input-label for="location" :value="__('Location')" />
                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" value="{{ $opportunity->location }}" required />
                <x-input-error class="mt-2" :messages="$errors->get('location')" />
            </div>
            <!-- Job Closing Date -->
            <div class="w-1/3">
                <x-input-label for="jobClosingDate" :value="__('Job Closing Date')" />
                <x-text-input id="jobClosingDate" name="jobClosingDate" type="date" class="mt-1 block w-full" value="{{ $opportunity->jobClosingDate }}" />
            </div>
        </div>

        <div class="flex gap-4">
            <div class="w-1/3 flex">
                <!-- Available Status -->
                <div class="w-1/2">
                    <x-input-label for="availableStatus" :value="__('Available Status')" />
                    <input id="availableStatus" name="availableStatus" type="checkbox" class="form-check-input ml-2" value="1" {{ $opportunity->availableStatus ? 'checked' : '' }}>
                    <input type="hidden" name="availableStatusHidden" value="0">
                </div>


                <!-- Created By (User ID) -->
                <div class="w-1/2">
                    <x-input-label for="createdByWho" :value="__('Created By')" />
                    <x-text-input id="createdByWho" name="createdByWho" type="text" class="ml-0 mt-1 block w-full text-gray-400" value="{{ $opportunity->createdByWho }}" required disabled/>
                    <x-input-error class="mt-2" :messages="$errors->get('createdByWho')" />
                    <input type="hidden" name="createdByWho" value="{{ $opportunity->createdByWho }}">
                </div>


            </div>


            <!-- Hashtag Keywords -->
            <div class="w-1/3">
                <x-input-label for="hashtagKeyWords" :value="__('Hashtag Keywords')" />
                <x-text-input id="hashtagKeyWords" name="hashtagKeyWords" type="text" class="mt-1 block w-full" value="{{ $opportunity->hashtagKeyWords }}" />
            </div>

            <!-- Open to Gender -->
            <div class="w-1/3">
                <x-input-label for="openToGender" :value="__('Open to Gender')" />
                <x-text-input id="openToGender" name="openToGender" type="text" class="mt-1 block w-full" value="{{ $opportunity->openToGender }}" />
            </div>
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="description" :value="__('Description')" />
            <textarea id="description" name="description" class="mt-1 block w-full" required>{{ $opportunity->description }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <!-- Requirements -->
        <div>
            <x-input-label for="requirements" :value="__('Requirements')" />
            <div id="requirements-container" class="space-y-2">

                @foreach ($requirements as $requirement)
                    <div class="input-group flex items-center">
                        <input type="text" name="requirements[]" class="form-control w-full mt-1" value="{{ $requirement->requirement  }}" placeholder="Qualifications" required>
                        <button type="button" class="btn btn-danger remove-requirement ml-2">Remove</button>
                    </div>
                @endforeach
            </div>
            <button type="button" id="add-requirement" class="btn btn-success mt-2">Add Requirement</button>
        </div>

        <!-- Qualifications -->
        <div>
            <x-input-label for="qualifications" :value="__('Qualifications')" />
            <div id="qualifications-container" class="space-y-2">
                @foreach ($qualifications as $qualification)
                <div class="input-group flex items-center">
                    <input type="text" name="qualifications[]" class="form-control w-full mt-1" value="{{ $qualification->qualification }}" placeholder="Qualifications"  required>
                    <button id="remove-qualification" type="button" class="btn btn-danger ml-2">Remove</button>
                </div>
                @endforeach
            </div>
            <button id="add-qualification" type="button" class="btn btn-success mt-2">Add Qualifications</button>
        </div>

        <!-- Employer Questions -->
        <div>
            <x-input-label for="employer_questions" :value="__('Employer Questions')" />
            <div id="employer_questions-container" class="space-y-2">
                @foreach ($employer_questions as $employer_question)
                <div class="input-group flex items-center">
                    <input type="text" name="employer_questions[]" class="form-control w-full mt-1" value="{{ $employer_question->employer_question }}" placeholder="Employer Questions"  required>
                    <button id="remove-employer_questions" type="button" class="btn btn-danger ml-2">Remove</button>
                </div>
                @endforeach
            </div>
            <button id="add-employer_questions" type="button" class="btn btn-success mt-2">Add Employer Question</button>
        </div>

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Submit') }}</x-primary-button>
        </div>
    </form>
</section>

<script>
    document.getElementById('add-requirement').addEventListener('click', function() {
        var container = document.getElementById('requirements-container');
        var newRequirement = document.createElement('div');
        newRequirement.classList.add('input-group', 'flex', 'items-center', 'mt-2');
        newRequirement.innerHTML = '<input type="text" name="requirements[]" class="form-control w-full" placeholder="Requirement" required>' +
            '<button type="button" class="btn btn-danger remove-requirement ml-2">Remove</button>';
        container.appendChild(newRequirement);
    });

    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('remove-requirement')) {
            event.target.closest('.input-group').remove();
        }
    });

    document.getElementById('add-qualification').addEventListener('click', function() {
        var container = document.getElementById('qualifications-container');
        var newQualification = document.createElement('div');
        newQualification.classList.add('input-group', 'flex', 'items-center', 'mt-2');
        newQualification.innerHTML = '<input type="text" name="qualifications[]" class="form-control w-full" placeholder="Qualification" required>' +
                                    '<button id="remove-qualification" type="button" class="btn btn-danger ml-2">Remove</button>' ;
        container.appendChild(newQualification);
    });

    document.addEventListener('click', function(event){
        if (event.target.id === 'remove-qualification') {
            event.target.closest('.input-group').remove();
        }
    });

    document.getElementById('add-employer_questions').addEventListener('click', function() {
        var container = document.getElementById('employer_questions-container');
        var newEmployerQuestions = document.createElement('div');
        newEmployerQuestions.classList.add('input-group', 'flex', 'items-center', 'mt-2');
        newEmployerQuestions.innerHTML = '<input type="text" name="employer_questions[]" class="form-control w-full" placeholder="Employer Questions" required>' +
                                    '<button id="remove-employer_questions" type="button" class="btn btn-danger ml-2">Remove</button>' ;
        container.appendChild(newEmployerQuestions);
    });

    document.addEventListener('click', function(event){
        if (event.target.id === 'remove-employer_questions') {
            event.target.closest('.input-group').remove();
        }
    });

</script>
