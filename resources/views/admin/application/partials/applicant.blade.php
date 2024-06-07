<section>
    <div>
        <header>
            <h2 class="text-xl font-medium text-gray-900 dark:text-gray-100">
                <strong>
                    Personal Information
                </strong>
            </h2>
        </header>
        <div>
            <strong> {{ 'Name - '}}</strong> {{ $user->name }}
        </div>
        <div>
            <strong> {{ 'Email - '}}</strong> {{ $user->email }}
        </div>
        <div>
            <strong> {{ 'Gender - '}}</strong> {{ $user->gender }}
        </div>
        <div>
            <strong> {{ 'DoB - '}}</strong> {{ $user->date_of_birth }}
        </div>
        <div>
            <strong> {{ 'Phone - '}}</strong> {{ $user->phone_number }}
        </div>
        <div>
            <strong> {{ 'Avaliable - '}}</strong> {{ $user->currently_looking_job }}
        </div>
        <div>
            <strong> {{ 'Current Job - '}}</strong> {{ $user->current_job_position }}
        </div>
        <div>
            <strong> {{ 'Expected Salary - '}}</strong> {{ $user->expected_salary }}
        </div>
    </div>
</section>
