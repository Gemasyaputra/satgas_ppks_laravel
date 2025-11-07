@props(['report', 'currentUserRole'])

<div class="d-flex flex-column" style="height: 500px;">
    <div class="flex-grow-1 p-4" style="overflow-y: auto; background-color: #f8f9fa;">
        @forelse ($report->messages->sortBy('created_at') as $message)
            @php
                // $isOwnMessage adalah true jika pengirim pesan adalah user yang sedang login
                $isOwnMessage = $message->user_id == Auth::id(); 

                $align = $isOwnMessage ? 'flex-row-reverse' : 'flex-row';
                $bubble = $isOwnMessage ? 'bg-warning text-dark' : 'bg-light border';
                $textAlign = $isOwnMessage ? 'text-end' : 'text-start';

                // Logika penamaan pengirim
                if ($isOwnMessage) {
                    $name = 'Anda';
                } elseif ($message->sender_role == 'admin') {
                    $name = 'Admin Satgas';
                } else {
                    // Jika admin melihat chat, tunjukkan nama mhs (jika tidak anonim)
                    // Jika mhs melihat chat, dia tidak akan pernah melihat ini (karena $isOwnMessage akan true)
                    $name = $report->is_anonymous ? 'Pelapor (Anonim)' : $message->user->name;
                }
            @endphp

            <div class="d-flex {{ $align }} mb-3">
                <div class="d-flex flex-column" style="max-width: 80%;">
                    <span class="small text-muted {{ $textAlign }}">{{ $name }} · {{ $message->created_at->format('H:i') }}</span>
                    <div class="p-3 rounded {{ $bubble }}" style="white-space: pre-wrap;">
                        {{ $message->message }}
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted p-5">
                <i class="bi bi-chat-dots fs-1"></i>
                <p class="mt-2">Belum ada percakapan.</p>
            </div>
        @endforelse
    </div>

    <div class="p-3 border-top bg-white">
        <form action="{{ $currentUserRole == 'admin' ? route('admin.reports.storeMessage', $report->id) : route('student.reports.storeMessage', $report->id) }}" method="POST">
            @csrf
            <div class="input-group">
                <textarea name="message" class="form-control" rows="2" placeholder="Ketik pesan Anda... (Shift+Enter untuk baris baru)" onkeydown="if(event.keyCode == 13 && !event.shiftKey) { event.preventDefault(); this.form.submit(); }"></textarea>
                <button class="btn btn-warning text-white" type="submit"><i class="bi bi-send-fill"></i></button>
            </div>
        </form>
    </div>
</div>