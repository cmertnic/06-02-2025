@if ($report->acess ==0) <!-- Проверяем значение access -->
<div class="bg-white shadow-md rounded-lg p-4 max-w-md w-full mt-6 ml-auto mr-auto" id="report-{{ $report->id }}">
    <h2 class="font-bold text-xl mb-2">
        Автор: {{ $report->fullname ?? 'Неизвестный автор' }}
    </h2>
    <p><strong>Телефон:</strong> {{ $report->user->tel ?? 'Не указан' }}</p>
    <p><strong>Email:</strong> {{ $report->user->email ?? 'Не указан' }}</p>
    <p><strong>Тема:</strong> {{ $report->theme }}</p>
    <p><strong>Секция:</strong> {{ $report->section->title ?? 'Не указана' }}</p>
    @if ($report->path_img)
        <img src="{{ Storage::url($report->path_img) }}" class="contact-block_img" alt="Изображение">
    @else
        <p class="mt-4 mb-4 text-gray-500">Изображение недоступно</p>
    @endif

    <div class="mt-4">
        <form action="{{ route('admin.approve', $report->id) }}" method="POST" style="display: inline;" onsubmit="disableButtons(this);">
            @csrf
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Одобрить</button>
        </form>

        <form action="{{ route('admin.reject', $report->id) }}" method="POST" style="display: inline;" onsubmit="disableButtons(this);">
            @csrf
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Отклонить</button>
        </form>
    </div>
</div>
@endif
