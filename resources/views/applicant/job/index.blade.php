@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('successJob'))
<div id="success-message-job">
    {{ session('successJob') }}
</div>
@endif

<form action="{{ $jobs->isEmpty() ? route('jobs.store') : route('jobs.update', ['job' => $jobs->first()->id]) }}" method="POST">
    @csrf
    @if (!$jobs->isEmpty())
        @method('PUT')
    @endif

    <div>
        <label for="jobs">
            {{ $jobs->isEmpty() ? 'Add' : 'Update' }} Job History
            <x-secondary-button id="toggle-edit-job" class="ml-2 mb-1">Edit</x-secondary-button>
        </label>
        <div id="jobs-view" class="space-y-2">
            <div class="header-row flex bg-gray-200 py-2 px-4">
                <div class="w-full mt-1 flex justify-center">Start Date</div>
                <div class="w-full mt-1 flex justify-center">End Date</div>
                <div class="w-full mt-1 flex justify-center">Position</div>
                <div class="w-full mt-1 flex justify-center">Company</div>
                <div class="w-full mt-1 flex justify-center">Country</div>
                <div class="w-full mt-1 flex justify-center">Responsibility</div>
                <div class="w-full mt-1 flex justify-center">Resign Reason</div>
                <div class="w-full mt-1 flex justify-center">Salary</div>
                <div class="w-full mt-1 flex justify-center">Type</div>
                <div class="w-full mt-1 flex justify-center">Actions</div>
            </div>
            @forelse ($jobs as $job)
            <div class="header-row flex bg-white px-4" data-id="{{ $job->id }}">
                <div class="w-full flex justify-center">{{ $job->start_date }}</div>
                <div class="w-full flex justify-center">{{ $job->end_date }}</div>
                <div class="w-full flex justify-center">{{ $job->position }}</div>
                <div class="w-full flex justify-center">{{ $job->company_name }}</div>
                <div class="w-full flex justify-center">{{ $job->country }}</div>
                <div class="w-full flex justify-center">{{ $job->responsibility }}</div>
                <div class="w-full flex justify-center">{{ $job->resign_reason }}</div>
                <div class="w-full flex justify-center">{{ $job->salary }}</div>
                <div class="w-full flex justify-center">{{ $job->type }}</div>
                <div class="w-full flex justify-center">Remove</div>
            </div>
            @empty
            @endforelse
        </div>
        <div id="jobs-container" class="space-y-2" style="display: none;">
            <div class="header-row flex bg-gray-200 py-2 px-4">
                <div class="w-full mt-1 flex justify-center">Start Date</div>
                <div class="w-full mt-1 flex justify-center">End Date</div>
                <div class="w-full mt-1 flex justify-center">Position</div>
                <div class="w-full mt-1 flex justify-center">Company</div>
                <div class="w-full mt-1 flex justify-center">Country</div>
                <div class="w-full mt-1 flex justify-center">Responsibility</div>
                <div class="w-full mt-1 flex justify-center">Resign Reason</div>
                <div class="w-full mt-1 flex justify-center">Salary</div>
                <div class="w-full mt-1 flex justify-center">Type</div>
                <div class="w-full mt-1 flex justify-center">Actions</div>
            </div>
            @forelse ($jobs as $job)
                <div class="input-group flex items-center" data-id="{{ $job->id }}">
                    <input type="hidden" name="user_id[]" class="form-control w-full mt-1" value="{{ $job->user_id }}" placeholder="User ID" required>
                    <input type="date" name="start_date[]" class="form-control w-full mt-1" value="{{ $job->start_date }}" placeholder="Start Date" required>
                    <input type="date" name="end_date[]" class="form-control w-full mt-1" value="{{ $job->end_date }}" placeholder="End Date" required>
                    <input type="text" name="position[]" class="form-control w-full mt-1" value="{{ $job->position }}" placeholder="Position" required>
                    <input type="text" name="company_name[]" class="form-control w-full mt-1" value="{{ $job->company_name }}" placeholder="Company" required>
                    <input type="text" name="country[]" class="form-control w-full mt-1" value="{{ $job->country }}" placeholder="Country" required>
                    <input type="text" name="responsibility[]" class="form-control w-full mt-1" value="{{ $job->responsibility }}" placeholder="Responsibility">
                    <input type="text" name="resign_reason[]" class="form-control w-full mt-1" value="{{ $job->resign_reason }}" placeholder="Resign Reason">
                    <input type="number" name="salary[]" class="form-control w-full mt-1" value="{{ $job->salary }}" placeholder="Salary" required>
                    <input type="text" name="type[]" class="form-control w-full mt-1" value="{{ $job->type }}" placeholder="Type">

                    <x-danger-button type="button" class="remove-job form-control w-full mt-1 justify-center">Remove</x-danger-button>
                </div>
            @empty
                <!-- Fields for a new job can be added dynamically -->
                <div class="input-group flex items-center" data-id="{{ $job->id }}">
                    <input type="hidden" name="user_id[]" class="form-control w-full mt-1" value="{{ auth()->user()->id }}" placeholder="User ID" required>
                    <input type="date" name="start_date[]" class="form-control w-full mt-1" placeholder="Start Date" required>
                    <input type="date" name="end_date[]" class="form-control w-full mt-1" placeholder="End Date" required>
                    <input type="text" name="position[]" class="form-control w-full mt-1" placeholder="Position" required>
                    <input type="text" name="company_name[]" class="form-control w-full mt-1" placeholder="Company" required>
                    <input type="text" name="country[]" class="form-control w-full mt-1" placeholder="Country" required>
                    <input type="text" name="responsibility[]" class="form-control w-full mt-1" placeholder="Responsibility">
                    <input type="text" name="resign_reason[]" class="form-control w-full mt-1" placeholder="Resign Reason">
                    <input type="number" name="salary[]" class="form-control w-full mt-1" placeholder="Salary" required>
                    <input type="text" name="type[]" class="form-control w-full mt-1" placeholder="Type">
                    <x-danger-button type="button" class="remove-job form-control w-full mt-1 justify-center">Remove</x-danger-button>
                </div>
            @endforelse
        </div>
        <x-secondary-button type="button" id="add-job" class="mt-2" style="display: none;">
            Add Jobs
        </x-secondary-button>
        <x-primary-button type="submit" id="submit-button-job" class="btn btn-primary mt-2" style="display: none;">
            {{ $jobs->isEmpty() ? 'Create' : 'Update' }}
        </x-primary-button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const toggleEditButtonJob = document.getElementById('toggle-edit-job');
        const jobsView = document.getElementById('jobs-view');
        const jobsContainer = document.getElementById('jobs-container');
        const addJobButton = document.getElementById('add-job');
        const submitButtonJob = document.getElementById('submit-button-job');

        let isEditableJob = false;

        toggleEditButtonJob.addEventListener('click', function () {
            isEditableJob = !isEditableJob;
            jobsView.style.display = isEditableJob ? 'none' : 'block';
            jobsContainer.style.display = isEditableJob ? 'block' : 'none';
            addJobButton.style.display = isEditableJob ? 'inline-block' : 'none';
            submitButtonJob.style.display = isEditableJob ? 'inline-block' : 'none';
            toggleEditButtonJob.textContent = isEditableJob ? 'Cancel Edit' : 'Edit';
        });

        document.getElementById('add-job').addEventListener('click', function () {
            var container = document.getElementById('jobs-container');
            var newGroup = document.createElement('div');
            newGroup.className = 'input-group flex items-center';
            newGroup.innerHTML = `
                <input type="hidden" name="user_id[]" class="form-control w-full mt-1" value="{{ auth()->user()->id }}" placeholder="User ID" required>
                <input type="date" name="start_date[]" class="form-control w-full mt-1" placeholder="Start Date" required>
                <input type="date" name="end_date[]" class="form-control w-full mt-1" placeholder="End Date" required>
                <input type="text" name="position[]" class="form-control w-full mt-1" placeholder="Position" required>
                <input type="text" name="company_name[]" class="form-control w-full mt-1" placeholder="Company" required>
                <input type="text" name="country[]" class="form-control w-full mt-1" placeholder="Country" required>
                <input type="text" name="responsibility[]" class="form-control w-full mt-1" placeholder="Responsibility">
                <input type="text" name="resign_reason[]" class="form-control w-full mt-1" placeholder="Resign Reason">
                <input type="number" name="salary[]" class="form-control w-full mt-1" placeholder="Salary" required>
                <input type="text" name="type[]" class="form-control w-full mt-1" placeholder="Type">
                <x-danger-button type="button" class="remove-job form-control w-full mt-1 justify-center">Remove</x-danger-button>
            `;
            container.appendChild(newGroup);
        });

        document.getElementById('jobs-container').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-job')) {
                e.target.closest('.input-group').remove();
            }
        });
    });

    // Hide success message after 10 seconds
    setTimeout(function () {
        var successMessageJob = document.getElementById('success-message-job');
        if (successMessageJob) {
            successMessageJob.style.display = 'none';
        }
    }, 5000);
</script>
