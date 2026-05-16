<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RoomMaster - Gestion de Salles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-900">

    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-indigo-600 font-black text-xl tracking-tight">
                        <i data-lucide="layout-dashboard" class="w-6 h-6"></i>
                        ROOM<span class="text-slate-800">MASTER</span>
                    </a>
                </div>

                <div class="flex items-center gap-6">
                    <a href="{{ route('dashboard') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition">Salles</a>
                    <a href="{{ route('rooms.create') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition">Ajouter</a>
                    <a href="{{ route('reservations.history') }}" class="text-sm font-medium text-slate-600 hover:text-indigo-600 transition">Historique</a>
                    
                    <div class="h-6 w-px bg-slate-200"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-bold text-rose-500 hover:text-rose-700 transition flex items-center gap-1">
                            <i data-lucide="log-out" class="w-4 h-4"></i> Quitter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>