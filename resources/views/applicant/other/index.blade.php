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

<form action="{{ $others->isEmpty() ? route('others.store') : route('others.update', ['other' => $others->first()->id]) }}" method="POST">
    @csrf
    @if (!$others->isEmpty())
        @method('PUT')
    @endif

    <div>
        <label for="others">
            {{ $others->isEmpty() ? 'Add' : 'Update' }} Other History
        </label>
        <div id="others-container" class="space-y-2">
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
                    <button type="button" class="btn btn-danger ml-2 remove-other">Remove</button>
                </div>
            @empty
            @endforelse
        </div>
        <button type="button" id="add-other" class="btn btn-success mt-2">Add Other</button>
    </div>

    <button type="submit" class="btn btn-primary mt-2">
        {{ $others->isEmpty() ? 'Create' : 'Update' }}
    </button>
</form>

<form id="delete-other-form" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
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
                <button type="button" class="btn btn-danger ml-2 remove-other">Remove</button>
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
</script>
