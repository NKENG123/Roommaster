@extends('layouts.custom')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-xl p-8">
    <h1 class="text-2xl font-bold mb-6 flex items-center gap-2 text-slate-800">
        <i data-lucide="edit" class="text-indigo-600"></i> Modifier : {{ $room->name }}
    </h1>
    <form action="{{ route('rooms.update', $room) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Nom de la salle</label>
            <input type="text" name="name" value="{{ $room->name }}" required 
                   class="w-full border border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Capacité</label>
                <input type="number" name="capacity" value="{{ $room->capacity }}" required min="1"
                       class="w-full border border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Photo de la salle</label>
                @if ($room->image)
                    <img src="{{ asset('storage/' . $room->image) }}" alt="Image actuelle"
                         class="w-full h-32 object-cover rounded-lg mb-2">
                @endif
                <input type="file" name="image" accept="image/*"
                       class="w-full border border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 outline-none">
                <p class="text-xs text-gray-400 mt-1">Laisser vide pour garder l'image actuelle.</p>
            </div>
        </div>
        <div>
            <label class="block text-[10px] font-black uppercase text-slate-400 mb-1">Description</label>
            <textarea name="description" rows="3" class="w-full border border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-indigo-500 outline-none">{{ $room->description }}</textarea>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('dashboard') }}" class="flex-1 bg-slate-100 text-slate-600 text-center font-bold py-3 rounded-xl hover:bg-slate-200 transition">Annuler</a>
            <button type="submit" class="flex-1 bg-indigo-600 text-white font-bold py-3 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">Enregistrer les modifications</button>
        </div>
    </form>
</div>
@endsection