@extends('layouts.custom')

@section('content')
<div class="flex justify-between items-center mb-10">
    <div>
        <h1 class="text-3xl font-black text-slate-900 tracking-tight uppercase">Espaces de travail</h1>
        <p class="text-slate-500 text-sm">Gérez vos salles et organisez vos réunions en un clic.</p>
    </div>
    <a href="{{ route('rooms.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100 flex items-center gap-2">
        <i data-lucide="plus-circle" class="w-5 h-5"></i>
        <span>Nouvelle Salle</span>
    </a>
</div>

@if(session('success'))
    <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-8 rounded-r-xl">
        <div class="flex items-center gap-2">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @foreach($rooms as $room)
    <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-2xl transition-all group">
        
        <div class="relative h-56 w-full overflow-hidden bg-slate-100">
            <img src="{{ $room->room_image }}" alt="{{ $room->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700"><img src="{{ $room->image ? asset('storage/' . $room->image) : 'https://placehold.co/600x400?text=Pas+d%27image' }}" alt="{{ $room->name }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
            
            <div class="absolute top-4 left-4 flex gap-2">
                <a href="{{ route('rooms.edit', $room) }}" 
                   class="bg-white/90 backdrop-blur-md p-2.5 rounded-xl shadow-sm text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all duration-300"
                   title="Modifier">
                    <i data-lucide="settings" class="w-5 h-5"></i>
                </a>

                <form action="{{ route('rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Supprimer cette salle définitivement ?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-white/90 backdrop-blur-md p-2.5 rounded-xl shadow-sm text-rose-500 hover:bg-rose-500 hover:text-white transition-all duration-300">
                        <i data-lucide="trash-2" class="w-5 h-5"></i>
                    </button>
                </form>
            </div>

            <div class="absolute top-4 right-4">
                <span class="px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest shadow-sm {{ $room->is_available ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white' }}">
                    {{ $room->is_available ? 'Libre' : 'Occupée' }}
                </span>
            </div>
        </div>

        <div class="p-6">
            <div class="flex justify-between items-start mb-2">
                <h2 class="text-xl font-bold text-slate-800">{{ $room->name }}</h2>
                <span class="flex items-center gap-1 text-slate-400 text-xs font-bold">
                    <i data-lucide="users" class="w-3.5 h-3.5"></i> {{ $room->capacity }}
                </span>
            </div>
            
            <p class="text-slate-500 text-sm leading-relaxed mb-6 h-10 overflow-hidden">
                {{ $room->description ?: 'Aucune description disponible.' }}
            </p>

            <form action="{{ route('reservations.store') }}" method="POST" class="pt-4 border-t border-slate-50 space-y-4">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-1">Début</label>
                        <input type="datetime-local" name="start_time" required 
                               class="w-full text-[11px] border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-indigo-500 outline-none bg-slate-50">
                    </div>
                    <div class="space-y-1">
                        <label class="text-[10px] font-black text-slate-400 uppercase ml-1">Fin</label>
                        <input type="datetime-local" name="end_time" required 
                               class="w-full text-[11px] border-slate-200 rounded-xl p-2.5 focus:ring-2 focus:ring-indigo-500 outline-none bg-slate-50">
                    </div>
                </div>

                <button type="submit" 
                        {{ !$room->is_available ? 'disabled' : '' }}
                        class="w-full py-3.5 rounded-2xl text-xs font-black tracking-widest transition-all {{ $room->is_available ? 'bg-slate-900 text-white hover:bg-indigo-600 shadow-lg' : 'bg-slate-100 text-slate-400 cursor-not-allowed' }}">
                    {{ $room->is_available ? 'RÉSERVER MAINTENANT' : 'INDISPONIBLE' }}
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection