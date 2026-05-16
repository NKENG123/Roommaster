@extends('layouts.custom')

@section('content')
<div class="max-w-2xl mx-auto bg-white shadow-md rounded-xl p-8">
    <h1 class="text-2xl font-bold mb-6 flex items-center gap-2">
        <i data-lucide="plus-circle" class="text-indigo-600"></i> Créer une nouvelle salle
    </h1>
    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        <div>
            <label class="block text-sm font-semibold mb-1">Nom de la salle</label>
            <input type="text" name="name" required placeholder="ex: Salle de réunion A"
                   class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 outline-none">
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-semibold mb-1">Capacité</label>
                <input type="number" name="capacity" required min="1" placeholder="10"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Photo de la salle</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 outline-none">
            </div>
        </div>
        <div>
            <label class="block text-sm font-semibold mb-1">Description</label>
            <textarea name="description" rows="3" placeholder="Détails sur l'équipement..."
                      class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-indigo-500 outline-none"></textarea>
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700 transition">
            Enregistrer la salle
        </button>
    </form>
</div>
@endsection