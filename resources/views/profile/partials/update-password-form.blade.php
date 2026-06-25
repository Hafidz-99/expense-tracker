<section class="overflow-hidden bg-white border shadow-sm border-slate-200 rounded-2xl">
    <div class="px-6 py-4 border-b border-slate-200">
        <h2 class="text-base font-bold text-slate-900">
            Security
        </h2>
        <p class="mt-1 text-sm text-slate-500">
            Update your password to keep your account secure.
        </p>
    </div>

    <div class="p-6">
        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="update_password_current_password" class="block text-sm font-semibold text-slate-700">
                    Current Password
                </label>

                <input id="update_password_current_password" name="current_password" type="password"
                    autocomplete="current-password"
                    class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

                @error('current_password', 'updatePassword')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="update_password_password" class="block text-sm font-semibold text-slate-700">
                    New Password
                </label>

                <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                    class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

                @error('password', 'updatePassword')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="update_password_password_confirmation" class="block text-sm font-semibold text-slate-700">
                    Confirm Password
                </label>

                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    autocomplete="new-password"
                    class="w-full mt-2 shadow-sm rounded-xl border-slate-300 text-slate-700 focus:border-blue-600 focus:ring-blue-600">

                @error('password_confirmation', 'updatePassword')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-2">
                @if (session('status') === 'password-updated')
                    <p class="text-sm font-semibold text-green-600">
                        Saved.
                    </p>
                @endif

                <button type="submit"
                    class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition shadow-sm">
                    Update Password
                </button>
            </div>
        </form>
    </div>
</section>
