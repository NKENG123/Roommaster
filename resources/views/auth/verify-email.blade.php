<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification Email - RoomMaster</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-900 flex items-center justify-center min-h-screen p-4">

    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-100 p-8 md:p-10">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-indigo-50 text-indigo-600 rounded-2xl mb-4">
                <i data-lucide="mail-check" class="w-8 h-8"></i>
            </div>
            <h1 class="text-2xl font-black tracking-tight text-slate-900 uppercase">Vérifiez votre email</h1>
            <p class="text-slate-500 text-sm mt-2">
                Merci pour votre inscription ! Cliquez sur le lien envoyé à votre adresse email pour activer votre compte.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-medium rounded-xl px-4 py-3 mb-6 flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4"></i>
                Un nouveau lien de vérification a été envoyé à votre adresse email.
            </div>
        @endif

        <div class="space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit" class="w-full bg-slate-900 text-white font-black text-xs tracking-widest py-4 rounded-2xl hover:bg-indigo-600 shadow-lg shadow-slate-200 transition-all transform active:scale-[0.98]">
                    RENVOYER L'EMAIL DE VÉRIFICATION
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-slate-100 text-slate-600 font-black text-xs tracking-widest py-4 rounded-2xl hover:bg-rose-50 hover:text-rose-600 transition-all flex items-center justify-center gap-2">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    SE DÉCONNECTER
                </button>
            </form>
        </div>
    </div>

    <script>lucide.createIcons();</script>
</body>
</html>