<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - RoomMaster</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-900 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100 p-8 md:p-10">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl mb-4">
                <i data-lucide="key-round" class="w-8 h-8"></i>
            </div>
            <h1 class="text-2xl font-black tracking-tight text-slate-900 uppercase">Mot de passe oublié</h1>
            <p class="text-slate-500 text-sm mt-2">Entrez votre email et nous vous enverrons un lien de réinitialisation.</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 ml-1 mb-1">Adresse Email</label>
                <div class="relative">
                    <i data-lucide="mail" class="absolute left-4 top-3.5 w-4 h-4 text-slate-400"></i>
                    <input type="email" name="email" required autofocus placeholder="nom@exemple.com"
                           value="{{ old('email') }}"
                           class="w-full bg-slate-50 border border-slate-200 rounded-xl py-3 pl-11 pr-4 outline-none focus:ring-2 focus:ring-indigo-500 focus:bg-white transition">
                </div>
                @error('email') <span class="text-rose-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-slate-900 text-white font-black text-xs tracking-widest py-4 rounded-2xl hover:bg-indigo-600 shadow-lg shadow-slate-200 transition-all transform active:scale-[0.98]">
                ENVOYER LE LIEN
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-slate-100 text-center">
            <p class="text-sm text-slate-500">
                Vous vous souvenez ?
                <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:text-indigo-700 underline underline-offset-4">
                    Se connecter
                </a>
            </p>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>