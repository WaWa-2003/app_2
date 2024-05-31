@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@if (session('success'))
    <div>
        {{ session('success') }}
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
        </label>
        <div id="educations-container" class="space-y-2">
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
                    <button type="button" class="btn btn-danger ml-2 remove-education">Remove</button>
                </div>
            @empty
            @endforelse
        </div>
        <button type="button" id="add-education" class="btn btn-success mt-2">Add Educations</button>
    </div>

    <button type="submit" class="btn btn-primary mt-2">
        {{ $educations->isEmpty() ? 'Create' : 'Update' }}
    </button>

</form>

<form id="delete-education-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
                <button type="button" class="btn btn-danger ml-2 remove-education">Remove</button>
            `;
            container.appendChild(newGroup);
        });

        document.getElementById('educations-container').addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-education')) {
                var educationId = e.target.closest('.input-group').getAttribute('data-id');
                // if (educationId) {
                //     if (confirm('Are you sure you want to delete this record?')) {
                //         var deleteForm = document.getElementById('delete-education-form');
                //         deleteForm.setAttribute('action', '/educations/' + educationId);
                //         deleteForm.submit();
                //     }
                // } else {
                //     e.target.closest('.input-group').remove();
                // }
                e.target.closest('.input-group').remove();
            }
        });
    });
</script>
