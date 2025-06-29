<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Akun Admin') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui Akun") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

<!-- Foto Profil -->
<div class="mt-4">
    <x-input-label for="foto" :value="__('Foto Profil')" />
    <input id="foto" type="file" name="foto" class="mt-1 block w-full border border-gray-300 rounded px-3 py-2"
        accept="image/*">
    <x-input-error :messages="$errors->get('foto')" class="mt-2" />

    @if (Auth::user()->foto)
        <div class="mt-2">
            <img src="{{ asset('img/' . Auth::user()->foto) }}" alt="Foto Profil" class="h-20 rounded">
            <p class="text-sm text-gray-500">Foto saat ini</p>
        </div>
    @endif
</div>


        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Klik disini untuk re-send password') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Verifikasi baru telah dikirim ke emailmu') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
