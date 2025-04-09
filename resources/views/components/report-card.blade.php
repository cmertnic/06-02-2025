<div class="flex justify-center items-center bg-gray-100">
    <div class="bg-white shadow-md rounded-lg p-4 max-w-md w-full mb-2">
        <h2 class="font-bold text-xl mb-2">Заявка от {{ $report->created_at ? $report->created_at->format('d.m.Y') : 'Неизвестное время' }}</h2>
        <p><strong></p>
        <p>
            <strong>Статус:</strong> 
            <span class="{{ $report->statues_id == 1 ? 'text-black' : ($report->statues_id == 2 ? 'text-blue-600' : 'text-red-600') }}">
                {{ $report->statue ? $report->statue->name : 'Неизвестно' }}
            </span>
        </p>
    </div>
</div>
