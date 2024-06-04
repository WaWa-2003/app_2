@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('successEducation'))
    <div id="success-message-education">
        {{ session('successEducation') }}
    </div>
@endif

<form action="{{ $educations->isEmpty() ? route('educations.store') : route('educations.update', ['education' => $educations->first()->id]) }}" method="POST">
    @csrf
    @if (!$educations->isEmpty())
        @method('PUT')
    @endif

    <div>
        <label for="educations">
            {{ $educations->isEmpty() ? 'Add' : 'Update' }} Education History
            <x-secondary-button id="toggle-edit-education" class="ml-2 mb-1">Edit</x-secondary-button>
        </label>

        <div id="educations-view" class="space-y-2">
            <div class="header-row flex bg-gray-200 py-2 px-4">
                <div class="w-full mt-1 flex justify-center">Start Date</div>
                <div class="w-full mt-1 flex justify-center">End Date</div>
                <div class="w-full mt-1 flex justify-center">Subject</div>
                <div class="w-full mt-1 flex justify-center">Institution</div>
                <div class="w-full mt-1 flex justify-center">Country</div>
                <div class="w-full mt-1 flex justify-center">Type</div>
                <div class="w-full mt-1 flex justify-center">Actions</div>
            </div>
            @forelse ($educations as $education)
            <div class="header-row flex bg-white px-4" data-id="{{ $education->id }}">
                <div class="w-full flex justify-center">{{ $education->start_date }}</div>
                <div class="w-full flex justify-center">{{ $education->end_date }}</div>
                <div class="w-full flex justify-center">{{ $education->subject }}</div>
                <div class="w-full flex justify-center">{{ $education->institution }}</div>
                <div class="w-full flex justify-center">{{ $education->country }}</div>
                <div class="w-full flex justify-center">{{ $education->type }}</div>
                <div class="w-full flex justify-center">Remove</div></div>
            </div>
            @empty
            @endforelse
        </div>
        <div id="educations-container" class="space-y-2" style="display: none;">
            <div class="header-row flex bg-gray-200 py-2 px-4">
                <div class="w-full mt-1 flex justify-center">Start Date</div>
                <div class="w-full mt-1 flex justify-center">End Date</div>
                <div class="w-full mt-1 flex justify-center">Subject</div>
                <div class="w-full mt-1 flex justify-center">Institution</div>
                <div class="w-full mt-1 flex justify-center">Country</div>
                <div class="w-full mt-1 flex justify-center">Type</div>
                <div class="w-full mt-1 flex justify-center">Actions</div>
            </div>
            @forelse ($educations as $education)
                <div class="input-group flex items-center" data-id="{{ $education->id }}">
                    <input type="hidden" name="id[]" value="{{ $education->id }}">
                    <input type="hidden" name="user_id[]" class="form-control w-full mt-1" placeholder="User ID" value="{{ $education->user_id }}" required>
                    <input type="date" name="start_date[]" class="form-control w-full mt-1" placeholder="Start Date" value="{{ $education->start_date }}" required>
                    <input type="date" name="end_date[]" class="form-control w-full mt-1" placeholder="End Date" value="{{ $education->end_date }}" required>
                    <input type="text" name="subject[]" class="form-control w-full mt-1" placeholder="Subject" value="{{ $education->subject }}" required>
                    <input type="text" name="institution[]" class="form-control w-full mt-1" placeholder="Institution" value="{{ $education->institution }}" required>
                    <input type="text" name="country[]" class="form-control w-full mt-1" placeholder="Country" value="{{ $education->country }}" required>
                    <input type="text" name="type[]" class="form-control w-full mt-1" placeholder="Type" value="{{ $education->type }}" required>
                    <x-danger-button type="button" class="remove-education form-control w-full mt-1 justify-center">Remove</x-danger-button>
                </div>
            @empty
            @endforelse
        </div>
        <x-secondary-button type="button" id="add-education" class="mt-2" style="display: none;">
            Add Educations
        </x-secondary-button>
        <x-primary-button type="submit" id="submit-button" class="btn btn-primary mt-2" style="display: none;">
            {{ $educations->isEmpty() ? 'Create' : 'Update' }}
        </x-primary-button>
    </div>


</form>

<form id="delete-education-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleEditButtonEducation = document.getElementById('toggle-edit-education');
        const educationsView = document.getElementById('educations-view');
        const educationsContainer = document.getElementById('educations-container');
        const addEducationButton = document.getElementById('add-education');
        const submitButton = document.getElementById('submit-button');

        let isEditable = false;

        toggleEditButtonEducation.addEventListener('click', function () {
            isEditable = !isEditable;
            educationsView.style.display = isEditable ? 'none' : 'block';
            educationsContainer.style.display = isEditable ? 'block' : 'none';
            addEducationButton.style.display = isEditable ? 'inline-block' : 'none';
            submitButton.style.display = isEditable ? 'inline-block' : 'none';
            toggleEditButtonEducation.textContent = isEditable ? 'Cancel Edit' : 'Edit';
        });

        document.getElementById('add-education').addEventListener('click', function () {
            var container = document.getElementById('educations-container');
            var newGroup = document.createElement('div');
            newGroup.className = 'input-group flex items-center';
            newGroup.innerHTML = `
                <input type="hidden" name="id[]" value="">
                <input type="hidden" name="user_id[]" class="form-control w-full mt-1" placeholder="User ID" value="{{ auth()->user()->id }}" required>
                <input type="date" name="start_date[]" class="form-control w-full mt-1" placeholder="Start Date" required>
                <input type="date" name="end_date[]" class="form-control w-full mt-1" placeholder="End Date" required>
                <input type="text" name="subject[]" class="form-control w-full mt-1" placeholder="Subject" required>
                <input type="text" name="institution[]" class="form-control w-full mt-1" placeholder="Institution" required>
                <input type="text" name="country[]" class="form-control w-full mt-1" placeholder="Country" required>
                <input type="text" name="type[]" class="form-control w-full mt-1" placeholder="Type" required>
                <x-danger-button type="button" class="remove-education form-control w-full mt-1 justify-center">Remove</x-danger-button>
            `;
            container.appendChild(newGroup);
        });

        document.getElementById('educations-container').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-education')) {
                var educationId = e.target.closest('.input-group').getAttribute('data-id');
                e.target.closest('.input-group').remove();
            }
        });
    });

    // Hide success message after 5 seconds
    setTimeout(function () {
        var successMessageEducation = document.getElementById('success-message-education');
        if (successMessageEducation) {
            successMessageEducation.style.display = 'none';
        }
    }, 5000);
</script>
