@csrf

<div class="mb-4">
    <label class="block text-gray-700">Título <span class="text-red-500">*</span></label>
    <input type="text" name="title" required
           class="w-full border border-gray-300 p-2 rounded"
           value="{{ old('title', $invitation->title ?? '') }}">
    @error('title')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label class="block text-gray-700">Mensaje</label>
    <textarea name="body"
              class="w-full border border-gray-300 p-2 rounded"
              rows="4">{{ old('body', $invitation->body ?? '') }}</textarea>
    @error('body')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label class="block text-gray-700">Fecha y hora <span class="text-red-500">*</span></label>
    <input type="datetime-local" name="scheduled_at" required
           class="w-full border border-gray-300 p-2 rounded"
           value="{{ old('scheduled_at', isset($invitation) ? \Carbon\Carbon::parse($invitation->scheduled_at)->format('Y-m-d\TH:i') : '') }}">
    @error('scheduled_at')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

<button type="submit"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
    {{ $buttonText }}
</button>
