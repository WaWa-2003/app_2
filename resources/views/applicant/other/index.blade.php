@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('successOther'))
    <div id="success-message-other">
        {{ session('successOther') }}
    </div>
@endif

<form action="{{ $others->isEmpty() ? route('others.store') : route('others.update', ['other' => $others->first()->id]) }}" method="POST">
    @csrf
    @if (!$others->isEmpty())
        @method('PUT')
    @endif

    <div>
        <label for="others">
            {{ $others->isEmpty() ? 'Add' : 'Update' }} Other History
            <x-secondary-button id="toggle-edit-other" class="ml-2 mb-1">Edit</x-secondary-button>

        </label>
        <div id="others-view" class="space-y-2">
            <div class="header-row flex bg-gray-200 py-2 px-4">
                <div class="w-full mt-1 flex justify-center">Start Date</div>
                <div class="w-full mt-1 flex justify-center">End Date</div>
                <div class="w-full mt-1 flex justify-center">Position</div>
                <div class="w-full mt-1 flex justify-center">Organization</div>
                <div class="w-full mt-1 flex justify-center">Country</div>
                <div class="w-full mt-1 flex justify-center">Type</div>
                <div class="w-full mt-1 flex justify-center">Actions</div>
            </div>
            @forelse ($others as $other)
            <div class="header-row flex bg-white px-4" data-id="{{ $other->id }}">
                <div class="w-full flex justify-center">{{ $other->start_date }}</div>
                <div class="w-full flex justify-center">{{ $other->end_date }}</div>
                <div class="w-full flex justify-center">{{ $other->position }}</div>
                <div class="w-full flex justify-center">{{ $other->organization_name }}</div>
                <div class="w-full flex justify-center">{{ $other->country }}</div>
                <div class="w-full flex justify-center">{{ $other->type }}</div>
                <div class="w-full flex justify-center">Remove</div></div>
            </div>
            @empty
            @endforelse
        </div>
        <div id="others-container" class="space-y-2" style="display: none">
            <div class="header-row flex bg-gray-200 py-2 px-4">
                <div class="w-full mt-1 flex justify-center">Start Date</div>
                <div class="w-full mt-1 flex justify-center">End Date</div>
                <div class="w-full mt-1 flex justify-center">Position</div>
                <div class="w-full mt-1 flex justify-center">Organization</div>
                <div class="w-full mt-1 flex justify-center">Country</div>
                <div class="w-full mt-1 flex justify-center">Type</div>
                <div class="w-full mt-1 flex justify-center">Actions</div>
            </div>
            @forelse ($others as $other)
                <div class="input-group flex items-center" data-id="{{ $other->id }}">
                    <input type="hidden" name="id[]" value="{{ $other->id }}">
                    <input type="hidden" name="user_id[]" class="form-control w-full mt-1" placeholder="User ID" value="{{ $other->user_id }}" required>
                    <input type="date" name="start_date[]" class="form-control w-full mt-1" placeholder="Start Date" value="{{ $other->start_date }}" required>
                    <input type="date" name="end_date[]" class="form-control w-full mt-1" placeholder="End Date" value="{{ $other->end_date }}" required>
                    <input type="text" name="position[]" class="form-control w-full mt-1" placeholder="Position" value="{{ $other->position }}" required>
                    <input type="text" name="organization_name[]" class="form-control w-full mt-1" placeholder="Organization" value="{{ $other->organization_name }}" required>
                    <input type="text" name="country[]" class="form-control w-full mt-1" placeholder="Country" value="{{ $other->country }}" required>
                    <input type="text" name="type[]" class="form-control w-full mt-1" placeholder="Type" value="{{ $other->type }}" required>
                    <x-danger-button type="button" class="remove-other form-control w-full mt-1 justify-center">Remove</x-danger-button>
                </div>
            @empty
            @endforelse
        </div>
        <x-secondary-button type="button" id="add-other" class="mt-2" style="display: none;">
            Add Others
        </x-secondary-button>
        <x-primary-button type="submit" id="submit-button-other" class="btn btn-primary mt-2" style="display: none;">
            {{ $others->isEmpty() ? 'Create' : 'Update' }}
        </x-primary-button>
    </div>
</form>

<form id="delete-other-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const toggleEditButtonOther = document.getElementById('toggle-edit-other');
        const othersView = document.getElementById('others-view');
        const othersContainer = document.getElementById('others-container');
        const addOtherButton = document.getElementById('add-other');
        const submitButtonOther = document.getElementById('submit-button-other');

        let isEditableOther = false;

        toggleEditButtonOther.addEventListener('click', function () {
            isEditableOther = !isEditableOther;
            othersView.style.display = isEditableOther ? 'none' : 'block';
            othersContainer.style.display = isEditableOther ? 'block' : 'none';
            addOtherButton.style.display = isEditableOther ? 'inline-block' : 'none';
            submitButtonOther.style.display = isEditableOther ? 'inline-block' : 'none';
            toggleEditButtonOther.textContent = isEditableOther ? 'Cancel Edit' : 'Edit';
        });

        document.getElementById('add-other').addEventListener('click', function () {
            var container = document.getElementById('others-container');
            var newGroup = document.createElement('div');
            newGroup.className = 'input-group flex items-center';
            newGroup.innerHTML = `
                <input type="hidden" name="id[]" value="">
                <input type="hidden" name="user_id[]" class="form-control w-full mt-1" placeholder="User ID" value="{{ auth()->user()->id }}" required>
                <input type="date" name="start_date[]" class="form-control w-full mt-1" placeholder="Start Date" required>
                <input type="date" name="end_date[]" class="form-control w-full mt-1" placeholder="End Date" required>
                <input type="text" name="position[]" class="form-control w-full mt-1" placeholder="Position" required>
                <input type="text" name="organization_name[]" class="form-control w-full mt-1" placeholder="Organization" required>
                <input type="text" name="country[]" class="form-control w-full mt-1" placeholder="Country" required>
                <input type="text" name="type[]" class="form-control w-full mt-1" placeholder="Type" required>
                <x-danger-button type="button" class="remove-other form-control w-full mt-1 justify-center">Remove</x-danger-button>
            `;
            container.appendChild(newGroup);
        });

        document.getElementById('others-container').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-other')) {
                var otherId = e.target.closest('.input-group').getAttribute('data-id');
                e.target.closest('.input-group').remove();
            }
        });
    });

    // Hide success message after 5 seconds
    setTimeout(function () {
        var successMessageOther = document.getElementById('success-message-other');
        if (successMessageOther) {
            successMessageOther.style.display = 'none';
        }
    }, 5000);

</script>
