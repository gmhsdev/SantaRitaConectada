@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Agregar Nuevo Socio</h1>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf

        <div class="row">
            {{-- Nombre --}}
            <div class="mb-3 col-md-6">
                <label for="first_name" class="form-label">Nombre:</label>
                <input type="text" name="first_name" id="first_name"
                       class="form-control @error('first_name') is-invalid @enderror"
                       value="{{ old('first_name') }}" required>
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Apellido --}}
            <div class="mb-3 col-md-6">
                <label for="last_name" class="form-label">Apellido:</label>
                <input type="text" name="last_name" id="last_name"
                       class="form-control @error('last_name') is-invalid @enderror"
                       value="{{ old('last_name') }}" required>
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- RUT --}}
        <div class="mb-3">
            <label for="rut" class="form-label">RUT:</label>
            <input type="text" name="rut" id="rut"
                   class="form-control @error('rut') is-invalid @enderror"
                   value="{{ old('rut') }}" required>
            @error('rut')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico:</label>
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Teléfono --}}
        <div class="mb-3">
            <label for="phone" class="form-label">Teléfono:</label>
            <input type="text" name="phone" id="phone"
                   class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone') }}">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Dirección (opcional) --}}
        <div class="mb-3">
            <label for="address" class="form-label">Dirección:</label>
            <input type="text" name="address" id="address"
                   class="form-control @error('address') is-invalid @enderror"
                   value="{{ old('address') }}">
            @error('address')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Fecha de nacimiento (opcional) --}}
        <div class="mb-3">
            <label for="birth_date" class="form-label">Fecha de nacimiento:</label>
            <input type="date" name="birth_date" id="birth_date"
                   class="form-control @error('birth_date') is-invalid @enderror"
                   value="{{ old('birth_date') }}">
            @error('birth_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Fecha de ingreso (opcional) --}}
        <div class="mb-3">
            <label for="join_date" class="form-label">Fecha de ingreso:</label>
            <input type="date" name="join_date" id="join_date"
                   class="form-control @error('join_date') is-invalid @enderror"
                   value="{{ old('join_date') }}">
            @error('join_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Guardar Socio</button>
        <a href="{{ route('members.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
