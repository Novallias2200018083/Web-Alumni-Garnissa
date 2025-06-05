{{-- resources/views/components/comments_replies_admin.blade.php --}}
@if ($replies->count())
    <div class="ms-6 mt-3 border-l-2 border-gray-200 pl-4"> @foreach($replies as $reply)
            <div class="bg-white p-4 rounded-lg shadow-xs mb-2 border border-gray-100 relative">
                <p class="text-md font-semibold text-gray-800 mb-1">{{ $reply->user->name }}</p>
                <p class="text-xs text-gray-500 mb-2">{{ $reply->created_at->diffForHumans() }} ({{ $reply->created_at->format('d M Y, H:i') }})</p>
                <p class="text-gray-700 leading-relaxed">{{ $reply->content }}</p>

                {{-- Tombol Hapus Balasan untuk Admin --}}
                {{-- Asumsikan Anda memiliki rute bernama 'comments.destroy' --}}
                <form action="{{ route('comments.destroy', $reply) }}" method="POST" onsubmit="return confirmDeleteComment(event);" class="absolute top-2 right-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 transition-colors duration-200" title="Hapus Balasan">
                        <i class="fas fa-trash-alt text-lg"></i>
                    </button>
                </form>

                @if ($reply->replies->count())
                    @include('components.comments_replies_admin', ['replies' => $reply->replies])
                @endif
            </div>
        @endforeach
    </div>
@endif