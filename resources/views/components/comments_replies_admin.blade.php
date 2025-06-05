{{-- resources/views/components/comments_replies_admin.blade.php --}}
@if ($replies->count())
    <div class="ms-6 mt-3 border-l-2 border-gray-200 pl-4">
        @foreach($replies as $reply)
            <div class="bg-gray-100 p-4 rounded-lg shadow-xs mb-2 border border-gray-100 relative">
                <div class="flex items-center mb-2">
                    <div class="flex-shrink-0">
                        {{-- Avatar User Reply --}}
                        @if($reply->user->profile_picture)
                            <img src="{{ asset('storage/' . $reply->user->profile_picture) }}" alt="{{ $reply->user->name }}" class="w-8 h-8 rounded-full object-cover border-2 border-gray-300">
                        @else
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 text-lg font-bold">
                                {{ $reply->user->name[0] }}
                            </div>
                        @endif
                    </div>
                    <div class="ml-3">
                        <p class="text-md font-semibold text-gray-800">{{ $reply->user->name }}</p>
                        <p class="text-xs text-gray-500">{{ $reply->created_at->diffForHumans() }} ({{ $reply->created_at->format('d M Y, H:i') }})</p>
                    </div>
                </div>
                <p class="text-gray-700 leading-relaxed mt-2">{{ $reply->content }}</p>

                <div class="flex items-center mt-3 text-sm text-gray-500 space-x-4">
                    {{-- Tombol Balas Balasan --}}
                    <button class="flex items-center hover:text-blue-600 transition-colors duration-200"
                            onclick="toggleReplyForm('replyForm{{ $reply->id }}')">
                        <i class="fas fa-reply mr-1"></i> Balas
                    </button>
                    {{-- Tombol Hapus Balasan untuk Admin (dan alumni pemilik komentar) --}}
                    {{-- PERBAIKAN 6: Menggunakan 'comments.destroy' (tanpa 'admin.') sesuai route:list --}}
                    <form action="{{ route('comments.destroy', $reply) }}" method="POST" onsubmit="return confirmDeleteComment(event);" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center hover:text-red-600 transition-colors duration-200" title="Hapus Balasan">
                            <i class="fas fa-trash-alt mr-1"></i> Hapus
                        </button>
                    </form>
                </div>

                {{-- Form Balas Balasan (tersembunyi secara default) --}}
                <div id="replyForm{{ $reply->id }}" class="hidden mt-4 pl-4 border-l-2 border-gray-100">
                    <h5 class="text-md font-semibold text-gray-700 mb-3">Balas balasan ini:</h5>
                    {{-- PERBAIKAN 7: Menggunakan 'admin.comments.reply' sesuai route:list --}}
                    <form action="{{ route('admin.comments.reply', $reply) }}" method="POST">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                        <textarea name="content" rows="2"
                                  class="shadow-sm appearance-none border border-gray-300 rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 @error('content') border-red-500 @enderror"
                                  placeholder="Tulis balasan Anda..." required></textarea>
                        @error('content')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                        <button type="submit"
                                class="mt-2 inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-full text-sm shadow-md
                                       hover:bg-blue-600 transition duration-300 transform hover:scale-105">
                            <i class="fas fa-paper-plane mr-1"></i> Kirim Balasan
                        </button>
                    </form>
                </div>

                {{-- Rekursif untuk balasan yang lebih dalam --}}
                @if ($reply->replies->count())
                    @include('components.comments_replies_admin', ['replies' => $reply->replies])
                @endif
            </div>
        @endforeach
    </div>
@endif