@props(['report', 'currentUserRole'])

<div class="d-flex flex-column border rounded shadow-sm" style="height: 550px; overflow: hidden;">
    
    {{-- BAGIAN 1: HEADER --}}
    <div class="px-3 py-2 bg-white border-bottom d-flex align-items-center gap-3">
        <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center text-white fw-bold" style="width: 40px; height: 40px;">
            <i class="bi bi-shield-lock-fill"></i>
        </div>
        <div>
            <h6 class="mb-0 fw-bold">Diskusi Laporan</h6>
            <small class="text-muted" style="font-size: 0.75rem;">Satgas PPKPT & Pelapor</small>
        </div>
    </div>

    {{-- BAGIAN 2: ISI CHAT (CONTAINER) --}}
    {{-- Background: Abu-abu bersih (#f4f6f9) --}}
    <div id="chat-container" class="flex-grow-1 p-3" 
         style="overflow-y: auto; background-color: #f4f6f9;">
        
        @forelse ($report->messages->sortBy('created_at') as $message)
            @php
                $isOwnMessage = $message->user_id == Auth::id(); 
                
                // Alignment: Kanan (Sendiri), Kiri (Orang lain)
                $align = $isOwnMessage ? 'justify-content-end' : 'justify-content-start';
                
                // WARNA: 
                // Sendiri = Warning/Orange (Tema Satgas)
                // Orang Lain = Putih
                $bubbleClass = $isOwnMessage ? 'bg-warning text-dark' : 'bg-white text-dark';
                
                // BENTUK BUBBLE (Radius):
                // Sendiri = Lancip di Kanan Atas
                // Orang Lain = Lancip di Kiri Atas
                $borderRadius = $isOwnMessage ? '15px 0px 15px 15px' : '0px 15px 15px 15px';
                
                // Nama Pengirim
                if ($isOwnMessage) {
                    $name = 'Anda'; 
                } elseif ($message->sender_role == 'admin') {
                    $name = 'Admin Satgas';
                } else {
                    $name = $report->is_anonymous ? 'Pelapor (Anonim)' : $message->user->name;
                }
            @endphp

            <div class="d-flex {{ $align }} mb-2">
                <div class="d-flex flex-column" style="max-width: 75%; min-width: 100px;">
                    
                    {{-- Bubble Chat --}}
                    {{-- width: fit-content (Agar bubble pas dengan teks) --}}
                    <div class="p-2 position-relative shadow-sm {{ $bubbleClass }}" 
                         style="border-radius: {{ $borderRadius }}; width: fit-content; min-width: 80px;">
                        
                        {{-- Nama Pengirim (Hanya muncul jika BUKAN pesan sendiri) --}}
                        @if(!$isOwnMessage)
                            <div class="fw-bold mb-1 text-warning" style="font-size: 0.75rem;">
                                {{ $name }}
                            </div>
                        @endif

                        {{-- Isi Pesan --}}
                        {{-- Margin-bottom & right diberi ruang supaya tidak menabrak jam --}}
                        <div style="font-size: 0.95rem; line-height: 1.4; white-space: pre-wrap; margin-bottom: 15px; margin-right: 25px;">{{ $message->message }}</div>

                        {{-- Metadata (Jam & Centang) --}}
                        <div class="position-absolute bottom-0 end-0 mb-1 me-2 d-flex align-items-center gap-1 opacity-75" style="font-size: 0.65rem;">
                            
                            {{-- Waktu --}}
                            <span>{{ $message->created_at->format('H:i') }}</span>

                            {{-- Ikon Centang (Hanya di pesan sendiri) --}}
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
    </div>

    {{-- BAGIAN 3: INPUT PESAN --}}
    <div class="p-2 border-top d-flex align-items-center gap-2 bg-white">
        <form id="chat-form" action="{{ $currentUserRole == 'admin' ? route('admin.reports.storeMessage', $report->id) : route('student.reports.storeMessage', $report->id) }}" method="POST" class="w-100 d-flex gap-2">
            @csrf
            
            {{-- Textarea Input --}}
            <div class="flex-grow-1 bg-light rounded-4 px-3 py-2 border d-flex align-items-center">
                <textarea 
                    name="message" 
                    id="message-input"
                    class="border-0 w-100 bg-transparent" 
                    rows="1" 
                    placeholder="Ketik pesan..." 
                    style="resize: none; outline: none; font-size: 0.95rem; max-height: 100px;"
                    required
                ></textarea>
            </div>

            {{-- Tombol Kirim (ORANGE / WARNING) --}}
            <button class="btn btn-warning rounded-circle shadow-sm d-flex align-items-center justify-content-center text-white" 
                    type="submit" 
                    style="width: 45px; height: 45px; flex-shrink: 0; border: none;">
                <i class="bi bi-send-fill fs-5 ps-1"></i>
            </button>
        </form>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chatContainer = document.getElementById('chat-container');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        const messageInput = document.getElementById('message-input');
        const chatForm = document.getElementById('chat-form');

        if (messageInput && chatForm) {
            // Auto resize textarea saat mengetik
            messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
                if(this.value === '') { this.style.height = 'auto'; }
            });

            // Enter = Kirim, Shift+Enter = Baris baru
            messageInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault(); 
                    if (this.value.trim() !== '') {
                        chatForm.submit(); 
                    }
                }
            });
        }
    });
</script>