@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div>
        {{ session('success') }}
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
        </label>
        <div id="jobs-container" class="space-y-2">
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

                    <button type="button" class="btn btn-danger ml-2 remove-job">Remove</button>
                </div>
            @empty
                <!-- Fields for a new job can be added dynamically -->
            @endforelse
        </div>
        <button type="button" id="add-job" class="btn btn-success mt-2">Add Job</button>
    </div>

    <button type="submit" class="btn btn-primary mt-2">
        {{ $jobs->isEmpty() ? 'Create' : 'Update' }}
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
                <button type="button" class="btn btn-danger ml-2 remove-job">Remove</button>
            `;
            container.appendChild(newGroup);
        });

        document.getElementById('jobs-container').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-job')) {
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>
