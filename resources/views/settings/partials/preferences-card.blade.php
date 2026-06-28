<x-ui.card title="Appearance & Regional"
    description="Customize your theme, currency, date format, time format, and timezone.">
    <form method="POST" action="{{ route('settings.update') }}" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <x-ui.label for="theme">Theme</x-ui.label>
                <x-ui.select id="theme" name="theme">
                    <option value="light" @selected(old('theme', $setting->theme) === 'light')>Light</option>
                    <option value="dark" @selected(old('theme', $setting->theme) === 'dark')>Dark</option>
                    <option value="system" @selected(old('theme', $setting->theme) === 'system')>System</option>
                </x-ui.select>
                <x-ui.form-error field="theme" />
            </div>

            <div>
                <x-ui.label for="currency">Currency</x-ui.label>
                <x-ui.select id="currency" name="currency">
                    <option value="MYR" @selected(old('currency', $setting->currency) === 'MYR')>MYR - Malaysian Ringgit</option>
                    <option value="USD" @selected(old('currency', $setting->currency) === 'USD')>USD - US Dollar</option>
                    <option value="EUR" @selected(old('currency', $setting->currency) === 'EUR')>EUR - Euro</option>
                    <option value="GBP" @selected(old('currency', $setting->currency) === 'GBP')>GBP - British Pound</option>
                    <option value="JPY" @selected(old('currency', $setting->currency) === 'JPY')>JPY - Japanese Yen</option>
                    <option value="SGD" @selected(old('currency', $setting->currency) === 'SGD')>SGD - Singapore Dollar</option>
                </x-ui.select>
                <x-ui.form-error field="currency" />
            </div>

            <div>
                <x-ui.label for="date_format">Date Format</x-ui.label>
                <x-ui.select id="date_format" name="date_format">
                    <option value="d/m/Y" @selected(old('date_format', $setting->date_format) === 'd/m/Y')>31/12/2026</option>
                    <option value="m/d/Y" @selected(old('date_format', $setting->date_format) === 'm/d/Y')>12/31/2026</option>
                    <option value="Y-m-d" @selected(old('date_format', $setting->date_format) === 'Y-m-d')>2026-12-31</option>
                    <option value="d M Y" @selected(old('date_format', $setting->date_format) === 'd M Y')>31 Dec 2026</option>
                </x-ui.select>
                <x-ui.form-error field="date_format" />
            </div>

            <div>
                <x-ui.label for="time_format">Time Format</x-ui.label>
                <x-ui.select id="time_format" name="time_format">
                    <option value="24" @selected(old('time_format', $setting->time_format) === '24')>24-hour</option>
                    <option value="12" @selected(old('time_format', $setting->time_format) === '12')>12-hour</option>
                </x-ui.select>
                <x-ui.form-error field="time_format" />
            </div>

            <div class="md:col-span-2">
                <x-ui.label for="timezone">Timezone</x-ui.label>
                <x-ui.select id="timezone" name="timezone">
                    <option value="Asia/Kuala_Lumpur" @selected(old('timezone', $setting->timezone) === 'Asia/Kuala_Lumpur')>Asia/Kuala_Lumpur</option>
                    <option value="UTC" @selected(old('timezone', $setting->timezone) === 'UTC')>UTC</option>
                    <option value="Asia/Singapore" @selected(old('timezone', $setting->timezone) === 'Asia/Singapore')>Asia/Singapore</option>
                    <option value="Asia/Tokyo" @selected(old('timezone', $setting->timezone) === 'Asia/Tokyo')>Asia/Tokyo</option>
                    <option value="America/New_York" @selected(old('timezone', $setting->timezone) === 'America/New_York')>America/New_York</option>
                    <option value="Europe/London" @selected(old('timezone', $setting->timezone) === 'Europe/London')>Europe/London</option>
                </x-ui.select>
                <x-ui.form-error field="timezone" />
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4">
            <h3 class="text-sm font-semibold text-slate-900">
                Preview
            </h3>

            <dl class="mt-4 grid gap-3 sm:grid-cols-2">
                <div>
                    <dt class="text-xs uppercase tracking-wide text-slate-500">
                        Theme
                    </dt>
                    <dd class="mt-1 text-sm font-medium text-slate-800">
                        {{ ucfirst($setting->theme) }}
                    </dd>
                </div>

                <div>
                    <dt class="text-xs uppercase tracking-wide text-slate-500">
                        Currency
                    </dt>
                    <dd class="mt-1 text-sm font-medium text-slate-800">
                        {{ $setting->currency }}
                    </dd>
                </div>

                <div>
                    <dt class="text-xs uppercase tracking-wide text-slate-500">
                        Date Format
                    </dt>
                    <dd class="mt-1 text-sm font-medium text-slate-800">
                        {{ now()->format($setting->date_format) }}
                    </dd>
                </div>

                <div>
                    <dt class="text-xs uppercase tracking-wide text-slate-500">
                        Time Format
                    </dt>
                    <dd class="mt-1 text-sm font-medium text-slate-800">
                        {{ $setting->time_format === '24' ? now()->format('H:i') : now()->format('h:i A') }}
                    </dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-xs uppercase tracking-wide text-slate-500">
                        Timezone
                    </dt>
                    <dd class="mt-1 text-sm font-medium text-slate-800">
                        {{ $setting->timezone }}
                    </dd>
                </div>
            </dl>
        </div>

        <div class="flex justify-end">
            <x-ui.button type="submit">
                Save Preferences
            </x-ui.button>
        </div>
    </form>
</x-ui.card>
