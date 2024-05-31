<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6"  enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex gap-4">

            <!-- Name -->
            <div class="w-1/2">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <!-- Email -->
            <div class="w-1/2">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        <div class="flex gap-4">
            <!-- Gender -->
            <div class="w-1/2">
                <x-input-label for="gender" :value="__('Gender')" />
                <select id="gender" name="gender" class="mt-1 block w-full" required autofocus>
                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                    <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('gender')" />
            </div>

            <!-- Date of Birth -->
            <div class="w-1/2">
                <x-input-label for="date_of_birth" :value="__('Date of Birth')" />
                <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth', $user->date_of_birth)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
            </div>
        </div>
        <div class="flex gap-4">

            <!-- Phone Number -->
            <div class="w-1/2">
                <x-input-label for="phone_number" :value="__('Phone Number')" />
                <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number', $user->phone_number)" required />
                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
            </div>

            <!-- Currently Looking for Job -->
            <div class="w-1/2">
                <x-input-label for="currently_looking_job" :value="__('Currently Looking for Job')" />
                <select id="currently_looking_job" name="currently_looking_job" class="mt-1 block w-full" required>
                    <option value="1" {{ old('currently_looking_job', $user->currently_looking_job) == '1' ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ old('currently_looking_job', $user->currently_looking_job) == '0' ? 'selected' : '' }}>No</option>
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('currently_looking_job')" />
            </div>
        </div>
        <div class="flex gap-4">
            <!-- Current Job Position -->
            <div class="w-1/2">
                <x-input-label for="current_job_position" :value="__('Current Job Position')" />
                <x-text-input id="current_job_position" name="current_job_position" type="text" class="mt-1 block w-full" :value="old('current_job_position', $user->current_job_position)" />
                <x-input-error class="mt-2" :messages="$errors->get('current_job_position')" />
            </div>

            <!-- Expected Salary -->
            <div class="w-1/2">
                <x-input-label for="expected_salary" :value="__('Expected Salary')" />
                <x-text-input id="expected_salary" name="expected_salary" type="number" class="mt-1 block w-full" :value="old('expected_salary', $user->expected_salary)" />
                <x-input-error class="mt-2" :messages="$errors->get('expected_salary')" />
            </div>
        </div>
        <div class="flex gap-4">

            <!-- Resume CV File -->
            <div class="w-1/2">
                <x-input-label for="resume_cv_file_path" :value="__('Resume/CV File')" />
                <input id="resume_cv_file_path" name="resume_cv_file_path" type="file" class="mt-1 block w-full" />


                @if ($user->resume_cv_file_path)
                    <a href="{{ asset('resumes/' . $user->resume_cv_file_path) }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline" download>
                        {{ __('Download Current Resume') }}
                    </a>
                @else
                    <x-input-error class="mt-2" :messages="$errors->get('resume_cv_file_path')" />
                @endif
            </div>

            <!-- Experience Year -->
            <div class="w-1/2">
                <x-input-label for="experience_year" :value="__('Experience (Years)')" />
                <x-text-input id="experience_year" name="experience_year" type="number" step="0.01" class="mt-1 block w-full" :value="old('experience_year', $user->experience_year)" />
                <x-input-error class="mt-2" :messages="$errors->get('experience_year')" />
            </div>

        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
