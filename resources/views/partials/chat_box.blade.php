@props(['report', 'currentUserRole'])

<div class="d-flex flex-column border rounded shadow-sm" style="height: 550px; overflow: hidden;">

    {{-- BAGIAN 1: HEADER --}}
    <div class="px-3 py-2 bg-white border-bottom d-flex align-items-center gap-3">
        <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center text-white fw-bold"
            style="width: 40px; height: 40px;">
            <i class="bi bi-shield-lock-fill"></i>
        </div>
        <div>
            <h6 class="mb-0 fw-bold">Diskusi Laporan</h6>
            <small class="text-muted" style="font-size: 0.75rem;">Satgas PPKPT & Pelapor</small>
        </div>
    </div>

    {{-- BAGIAN 2: ISI CHAT (CONTAINER) --}}
    {{-- Background: Abu-abu bersih (#f4f6f9) --}}
    <div id="chat-container" class="flex-grow-1 p-3" style="overflow-y: auto; background-color: #f4f6f9;">

        {{-- Panggil konten chat di sini --}}
        <div id="chat-content-area">
            @include('partials.chat_content', ['report' => $report])
        </div>

    </div>

    {{-- BAGIAN 3: INPUT PESAN --}}
    <div class="p-2 border-top d-flex align-items-center gap-2 bg-white">
        <form id="chat-form"
            action="{{ $currentUserRole == 'admin' ? route('admin.reports.storeMessage', $report->id) : route('student.reports.storeMessage', $report->id) }}"
            method="POST" class="w-100 d-flex gap-2">
            @csrf

            {{-- Textarea Input --}}
            <div class="flex-grow-1 bg-light rounded-4 px-3 py-2 border d-flex align-items-center">
                <textarea name="message" id="message-input" class="border-0 w-100 bg-transparent" rows="1"
                    placeholder="Ketik pesan..." style="resize: none; outline: none; font-size: 0.95rem; max-height: 100px;" required></textarea>
            </div>

            {{-- Tombol Kirim (ORANGE / WARNING) --}}
            <button
                class="btn btn-warning rounded-circle shadow-sm d-flex align-items-center justify-content-center text-white"
                type="submit" style="width: 45px; height: 45px; flex-shrink: 0; border: none;">
                <i class="bi bi-send-fill fs-5 ps-1"></i>
            </button>
        </form>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const chatContainer = document.getElementById('chat-container');
        const contentArea = document.getElementById('chat-content-area'); // Area konten chat (Wajib ada div ini)
        const messageInput = document.getElementById('message-input');
        const chatForm = document.getElementById('chat-form');

        // URL untuk Auto-Refresh (Polling)
        // Menggunakan logika Blade untuk memilih route Admin atau Student
        const fetchUrl = "{{ Auth::user()->role == 'admin' ? route('admin.reports.fetchChat', $report->id) : route('student.reports.fetchChat', $report->id) }}";

        // --- 1. Fungsi Scroll ke Bawah ---
        function scrollToBottom() {
            if (chatContainer) {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }
        }

        // Scroll awal saat halaman dimuat
        scrollToBottom();

        // --- 2. LOGIKA REALTIME (Polling 3 Detik) ---
        if (contentArea) {
            setInterval(function() {
                // Cek apakah user sedang melihat chat paling bawah?
                // Kita hanya auto-scroll jika user memang ada di bawah. 
                // Kalau user lagi scroll ke atas baca chat lama, jangan dipaksa turun.
                const isAtBottom = chatContainer.scrollHeight - chatContainer.scrollTop <= chatContainer.clientHeight + 150;

                fetch(fetchUrl)
                    .then(response => {
                        if (!response.ok) throw new Error('Network response was not ok');
                        return response.text();
                    })
                    .then(html => {
                        // Update isi chat dengan HTML baru
                        contentArea.innerHTML = html;

                        // Jika user tadi ada di bawah, scroll ke bawah lagi untuk lihat pesan baru
                        if (isAtBottom) {
                            scrollToBottom();
                        }
                    })
                    .catch(error => console.error('Gagal memuat chat:', error));
            }, 3000); // Refresh setiap 3000ms (3 detik)
        }

        // --- 3. LOGIKA FORM INPUT (Fitur Lama) ---
        if (messageInput && chatForm) {
            // Auto resize textarea saat mengetik
            messageInput.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
                if (this.value === '') {
                    this.style.height = 'auto';
                }
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
