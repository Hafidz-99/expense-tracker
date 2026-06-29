<x-ui.card title="Theme" description="Choose how the application should look.">
    <form method="POST" action="{{ route('settings.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <x-ui.label for="theme">
                Theme Preference
            </x-ui.label>

            <x-ui.select id="theme" name="theme">
                <option value="light" @selected(old('theme', $setting->theme) === 'light')>
                    Light
                </option>

                <option value="dark" @selected(old('theme', $setting->theme) === 'dark')>
                    Dark
                </option>

                <option value="system" @selected(old('theme', $setting->theme) === 'system')>
                    System
                </option>
            </x-ui.select>

            <x-ui.form-error field="theme" />

            <p class="mt-2 text-sm text-slate-500">
                Select your preferred appearance. Choosing <strong>System</strong>
                automatically follows your operating system's theme.
            </p>
        </div>

        <div class="flex justify-end">
            <x-ui.button type="submit">
                Save Theme
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
