@forelse ($report->messages->sortBy('created_at') as $message)
    @php
        $isOwnMessage = $message->user_id == Auth::id(); 
        $align = $isOwnMessage ? 'justify-content-end' : 'justify-content-start';
        $bubbleClass = $isOwnMessage ? 'bg-warning text-dark' : 'bg-white text-dark';
        $borderRadius = $isOwnMessage ? '15px 0px 15px 15px' : '0px 15px 15px 15px';
        
        if ($isOwnMessage) {
            $name = 'Anda'; 
        } elseif ($message->sender_role == 'admin') {
            $name = 'Admin Satgas';
        } else {
            $name = $report->is_anonymous ? 'Pelapor (Anonim)' : optional($message->user)->name ?? 'User';
        }
    @endphp

    <div class="d-flex {{ $align }} mb-2">
        <div class="d-flex flex-column" style="max-width: 75%; min-width: 100px;">
            <div class="p-2 position-relative shadow-sm {{ $bubbleClass }}" 
                 style="border-radius: {{ $borderRadius }}; width: fit-content; min-width: 80px;">
                
                @if(!$isOwnMessage)
                    <div class="fw-bold mb-1 text-warning" style="font-size: 0.75rem;">
                        {{ $name }}
                    </div>
                @endif

                <div style="font-size: 0.95rem; line-height: 1.4; white-space: pre-wrap; margin-bottom: 15px; margin-right: 25px;">{{ $message->message }}</div>

                <div class="position-absolute bottom-0 end-0 mb-1 me-2 d-flex align-items-center gap-1 opacity-75" style="font-size: 0.65rem;">
                    <span>{{ $message->created_at->format('H:i') }}</span>
                    @if($isOwnMessage)
                        <i class="bi bi-check-all fs-6"></i>
                    @endif
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="text-center my-5 text-muted opacity-50">
        <i class="bi bi-chat-square-text display-4"></i>
        <p class="mt-2">Belum ada percakapan.</p>
    </div>
@endforelse