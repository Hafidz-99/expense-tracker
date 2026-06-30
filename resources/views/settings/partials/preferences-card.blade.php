<x-ui.card title="Theme" description="Choose how the application should look.">
    <form method="POST" action="{{ route('settings.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <x-ui.label for="theme">
                Theme Preference
            </x-ui.label>

            @if ($setting->theme === 'system')
                <div
                    class="mb-3 rounded-xl border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-700 dark:border-blue-500/30 dark:bg-blue-500/10 dark:text-blue-300">
                    Your current theme is using your device setting by default.
                </div>
            @endif

            <x-ui.select id="theme" name="theme">
                @if ($setting->theme === 'system')
                    <option value="" selected disabled>
                        Choose Light or Dark
                    </option>
                @endif

                <option value="light" @selected(old('theme', $setting->theme) === 'light')>
                    Light
                </option>

                <option value="dark" @selected(old('theme', $setting->theme) === 'dark')>
                    Dark
                </option>
            </x-ui.select>

            <x-ui.form-error field="theme" />

            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                New accounts use your device appearance by default. Choosing Light or Dark will override it.
            </p>
        </div>

        <div class="flex justify-end">
            <x-ui.button type="submit">
                Save Theme
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
