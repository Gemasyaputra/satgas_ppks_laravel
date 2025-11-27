@php
    $statusBadge = [
        "pending" => "bg-warning-subtle text-warning-emphasis",
        "in_progress" => "bg-primary-subtle text-primary-emphasis",
        "resolved" => "bg-success-subtle text-success-emphasis",
        "rejected" => "bg-danger-subtle text-danger-emphasis",
    ];
    $statusText = [
        "pending" => "Menunggu",
        "in_progress" => "Diproses",
        "resolved" => "Selesai",
        "rejected" => "Ditolak",
    ];
@endphp
<span class="badge {{ $statusBadge[$status] ?? 'bg-secondary' }}">
    {{ $statusText[$status] ?? $status }}
</span>