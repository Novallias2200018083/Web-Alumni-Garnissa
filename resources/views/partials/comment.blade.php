{{--
    Partial untuk menampilkan komentar dan balasannya secara rekursif.
    Variabel:
    - $comment: Objek komentar yang akan ditampilkan.
    - $isAdmin: Boolean, true jika tampilan ini untuk admin (menampilkan tombol hapus).
--}}
<div class="bg-gray-50 p-6 rounded-lg shadow-sm border border-gray-200 relative group {{ isset($isReply) && $isReply ? 'ml-8 mt-4' : '' }}"> {{-- Tambahkan margin-left untuk balasan --}}
    <div class="flex items-start mb-3">
        <div class="flex-shrink-0 mr-4">
            {{-- Anda bisa mengganti ini dengan avatar pengguna jika ada --}}
            <i class="fas fa-user-circle text-4xl text-gray-400"></i>
        </div>
        <div class="flex-grow">
            <p class="font-bold text-gray-800 text-lg">{{ $comment->user->name ?? 'Pengguna Tidak Dikenal' }}
                @if ($comment->user && $comment->user->role === 'admin')
                    <span class="ml-2 px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">Admin</span>
                @endif
            </p>
            <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
        </div>
    </div>
    <p class="text-gray-700 leading-relaxed text-base">{{ $comment->content }}</p>

    <div class="flex justify-end mt-4">
        @if (!$isAdmin && Auth::check() && $blog->comments_enabled) {{-- Hanya tampilkan tombol balas jika bukan admin, pengguna login, dan komentar aktif --}}
            <button type="button" onclick="replyToComment({{ $comment->id }}, '{{ $comment->user->name ?? 'Pengguna Ini' }}')"
                    class="text-blue-500 hover:text-blue-700 text-sm font-semibold transition-colors duration-200 inline-flex items-center">
                <i class="fas fa-reply mr-1"></i> Balas
            </button>
        @endif

        @if ($isAdmin) {{-- Hanya tampilkan tombol hapus jika admin --}}
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirmDeleteComment(event);" class="ml-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700 transition-colors duration-200" title="Hapus Komentar">
                    <i class="fas fa-times-circle text-xl"></i>
                </button>
            </form>
        @endif
    </div>

    {{-- Tampilkan balasan secara rekursif --}}
    @if ($comment->replies->isNotEmpty())
        <div class="mt-4 space-y-4 border-l-2 border-gray-200 pl-4">
            @foreach ($comment->replies as $reply)
                @include('partials.comment', ['comment' => $reply, 'isReply' => true, 'isAdmin' => $isAdmin])
            @endforeach
        </div>
    @endif
</div>
