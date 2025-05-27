@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h1 class="text-2xl font-semibold mb-6 text-gray-800">Agregar Nuevo Socio</h1>

    <form action="{{ route('members.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nombre --}}
            <div>
                <label for="first_name" class="block text-gray-700 font-medium mb-1">Nombre:</label>
                <input
                    type="text"
                    name="first_name"
                    id="first_name"
                    value="{{ old('first_name') }}"
                    required
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
                           @error('first_name') border-red-500 @enderror"
                >
                @error('first_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Apellido --}}
            <div>
                <label for="last_name" class="block text-gray-700 font-medium mb-1">Apellido:</label>
                <input
                    type="text"
                    name="last_name"
                    id="last_name"
                    value="{{ old('last_name') }}"
                    required
                    class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
                           @error('last_name') border-red-500 @enderror"
                >
                @error('last_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- RUT --}}
        <div>
            <label for="rut" class="block text-gray-700 font-medium mb-1">RUT:</label>
            <input
                type="text"
                name="rut"
                id="rut"
                value="{{ old('rut') }}"
                required
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
                       @error('rut') border-red-500 @enderror"
            >
            @error('rut')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label for="email" class="block text-gray-700 font-medium mb-1">Correo electrónico:</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                required
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
                       @error('email') border-red-500 @enderror"
            >
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Teléfono --}}
        <div>
            <label for="phone" class="block text-gray-700 font-medium mb-1">Teléfono:</label>
            <input
                type="text"
                name="phone"
                id="phone"
                value="{{ old('phone') }}"
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
                       @error('phone') border-red-500 @enderror"
            >
            @error('phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Dirección --}}
        <div>
            <label for="address" class="block text-gray-700 font-medium mb-1">Dirección:</label>
            <input
                type="text"
                name="address"
                id="address"
                value="{{ old('address') }}"
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
                       @error('address') border-red-500 @enderror"
            >
            @error('address')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Fecha de nacimiento --}}
        <div>
            <label for="birth_date" class="block text-gray-700 font-medium mb-1">Fecha de nacimiento:</label>
            <input
                type="date"
                name="birth_date"
                id="birth_date"
                value="{{ old('birth_date') }}"
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
                       @error('birth_date') border-red-500 @enderror"
            >
            @error('birth_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Fecha de ingreso --}}
        <div>
            <label for="join_date" class="block text-gray-700 font-medium mb-1">Fecha de ingreso:</label>
            <input
                type="date"
                name="join_date"
                id="join_date"
                value="{{ old('join_date') }}"
                class="w-full rounded border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500
                       @error('join_date') border-red-500 @enderror"
            >
            @error('join_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-4 mt-6">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded shadow">
                Guardar Socio
            </button>
            <a href="{{ route('members.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-6 rounded shadow">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
