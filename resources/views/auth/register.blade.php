<x-guest-layout>
    <div class="max-w-lg mx-auto bg-white p-8 shadow-md rounded-lg">
        <h2 class="text-2xl font-bold text-gray-700 text-center mb-6">Register</h2>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Avatar Upload -->
            <div class="mb-4">
                <x-input-label for="avatar" :value="__('Avatar')" />
                <input id="avatar" type="file" name="avatar" class="block mt-1 w-full border p-2 rounded-lg" accept="image/*" onchange="previewAvatar(event)" required>
                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                <img id="avatar-preview" class="mt-3 w-24 h-24 object-cover rounded-full border hidden">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-4">
                <!-- Occupation -->
                <div>
                    <x-input-label for="occupation" :value="__('Occupation')" />
                    <x-text-input id="occupation" class="w-full" type="text" name="occupation" :value="old('occupation')" required />
                    <x-input-error :messages="$errors->get('occupation')" class="mt-2" />
                </div>

                <!-- Description -->
                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <textarea id="description" name="description" class="w-full border p-2 rounded-lg" rows="3">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            <!-- Bank Information -->
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <x-input-label for="bank_name" :value="__('Bank Name')" />
                    <x-text-input id="bank_name" class="w-full" type="text" name="bank_name" :value="old('bank_name')" required />
                    <x-input-error :messages="$errors->get('bank_name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="bank_account" :value="__('Bank Account Name')" />
                    <x-text-input id="bank_account" class="w-full" type="text" name="bank_account" :value="old('bank_account')" required />
                    <x-input-error :messages="$errors->get('bank_account')" class="mt-2" />
                </div>
            </div>

            <!-- Bank Account Number -->
            <div class="mt-4">
                <x-input-label for="bank_account_number" :value="__('Bank Account Number')" />
                <x-text-input id="bank_account_number" class="w-full" type="number" name="bank_account_number" :value="old('bank_account_number')" required />
                <x-input-error :messages="$errors->get('bank_account_number')" class="mt-2" />
            </div>

            <!-- Password & Confirm Password -->
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="w-full" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <!-- Submit & Login Link -->
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">Already registered?</a>
                <x-primary-button>
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <!-- Avatar Preview Script -->
    <script>
        function previewAvatar(event) {
            const input = event.target;
            const preview = document.getElementById('avatar-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-guest-layout>

