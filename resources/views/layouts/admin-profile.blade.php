<div class="px-4 py-3 border-t border-slate-100">
    <h3 class="text-sm font-bold text-slate-800 mb-2">👤 Edit Admin Profile</h3>

    <div class="mb-3 flex items-center gap-3">
        <div class="w-14 h-14 rounded-full overflow-hidden bg-white/20 flex items-center justify-center">
            @if(auth()->user()->photo)
                <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="w-full h-full object-cover" alt="Foto Admin">
            @else
                <span class="text-blue-700 font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
            @endif
        </div>
        <div>
            <div class="text-sm font-semibold">{{ auth()->user()->name }}</div>
            <div class="text-xs text-slate-500">Admin</div>
        </div>
    </div>


    @if (session('success'))
        <div class="mb-2 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input
            type="text"
            name="name"
            value="{{ auth()->user()->name }}"
            class="w-full p-2 rounded mb-2 text-black border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-200"
        />

        <input
            type="file"
            name="photo"
            accept="image/*"
            class="w-full p-2 bg-white rounded mb-2 border border-slate-200"
        />

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded font-bold">
            Simpan Profil
        </button>

        @error('photo')
            <div class="mt-2 text-sm text-red-600">{{ $message }}</div>
        @enderror
    </form>
</div>

