@if (session('error'))
    <div class="mb-4 p-2 text-red-700 bg-red-100 rounded">
        {{ session('error') }}
    </div>
@endif
@if (session('success'))
    <div class="mb-4 p-2 text-green-700 bg-green-100 rounded">
        {{ session('success') }}
    </div>
@endif
