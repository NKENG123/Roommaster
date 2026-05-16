@extends('layouts.custom')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-gray-900">Mon Historique</h1>
        <p class="text-gray-500 text-sm">Gérez vos réservations passées et à venir.</p>
    </div>
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-indigo-600 font-bold hover:text-indigo-800 transition">
        <i data-lucide="arrow-left" class="w-5 h-5"></i> Retour aux salles
    </a>
</div>

@if(session('success'))
    <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-r-lg shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    @if($reservations->isEmpty())
        <div class="p-20 text-center">
            <i data-lucide="calendar-x" class="w-12 h-12 text-gray-300 mx-auto mb-4"></i>
            <p class="text-gray-500">Vous n'avez pas encore effectué de réservation.</p>
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-6 py-4 text-xs font-bold uppercase text-gray-400">Salle</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase text-gray-400">Période</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase text-gray-400 text-center">Statut</th>
                        <th class="px-6 py-4 text-xs font-bold uppercase text-gray-400 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($reservations as $res)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $res->room->name }}</div>
                                <div class="text-xs text-gray-400 flex items-center gap-1">
                                    <i data-lucide="map-pin" class="w-3 h-3"></i> Site Principal
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600 flex items-center gap-2">
                                    <span class="font-medium">Du</span> {{ \Carbon\Carbon::parse($res->start_time)->format('d/m H:i') }}
                                </div>
                                <div class="text-sm text-gray-600 flex items-center gap-2">
                                    <span class="font-medium">Au</span> {{ \Carbon\Carbon::parse($res->end_time)->format('d/m H:i') }}
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @php $isPast = \Carbon\Carbon::parse($res->end_time)->isPast(); @endphp
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold {{ $isPast ? 'bg-gray-100 text-gray-500' : 'bg-indigo-100 text-indigo-700' }}">
                                    {{ $isPast ? 'Terminée' : 'Active' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                @if(!$isPast)
                                    <form action="{{ route('reservations.destroy', $res) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment annuler cette réservation ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition" title="Annuler">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-gray-300"><i data-lucide="lock" class="w-4 h-4 ml-auto"></i></span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection