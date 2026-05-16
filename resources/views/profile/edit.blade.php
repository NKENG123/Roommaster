@extends('layouts.custom')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-xl p-8">
    <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
        <i data-lucide="edit" class="text-indigo-600"></i> Modifier la salle
    </h1>

    <form action="{{ route('rooms.update', $room) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-sm font-semibold mb-1">Nom de la salle</label>
            <input type="text" name="name" required value="{{ old('name', $room->name) }}"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Capacité</label>
                <input type="number" name="capacity" required min="1" value="{{ old('capacity', $room->capacity) }}"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Photo de la salle</label>

                {{-- Aperçu de l'image actuelle --}}
                @if ($room->image)
                    <img src="{{ asset('storage/' . $room->image) }}" alt="Image actuelle"
                         class="w-full h-32 object-cover rounded-lg mb-2">
                @endif

                <input type="file" name="image" accept="image/*"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 outline-none">
                <p class="text-xs text-gray-400 mt-1">Laisser vide pour garder l'image actuelle.</p>
            </div>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1">Description</label>
            <textarea name="description" rows="3"
                      class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 outline-none">{{ old('description', $room->description) }}</textarea>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition">
                Mettre à jour
            </button>
            <a href="{{ route('dashboard') }}" class="w-full text-center bg-gray-100 text-gray-700 font-bold py-3 rounded-lg hover:bg-gray-200 transition">
                Annuler
            </a>
        </div>
    </form>
</div>
@endsection