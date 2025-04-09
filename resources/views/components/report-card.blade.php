<div class="bg-white shadow-md rounded-lg p-4 max-w-md w-full mt-6">
    <h2 class="font-bold text-xl mb-2">
        Автор: {{ $report->fullname ?? 'Неизвестный автор' }}
    </h2>
    <p><strong>Тема:</strong> {{ $report->theme }}</p>
    <p><strong>Секция:</strong> {{ $report->section->title }}</p>
    @if ($report->path_img)
        <img src="{{ Storage::url($report->path_img) }}" class="contact-block_img" alt="Изображение">
    @else
        <p class="mt-4 mb-4 text-gray-500">Изображение недоступно</p>
    @endif
</div>
