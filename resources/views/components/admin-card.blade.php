<div class="flex justify-center items-center bg-gray-100">
    <div class="bg-white shadow-md rounded-lg p-4 max-w-md w-full mb-2">
        <h2 class="font-bold text-xl mb-2">Заявка от {{ $report->created_at ? $report->created_at->format('d.m.Y') : 'Неизвестное время' }}</h2>
        <p><strong>Клиент:</strong> {{ $report->client->name ?? 'Неизвестный клиент' }}</p> 
        <p><strong>Время:</strong> {{ $report->time }}</p>
            <select id="statusSelect-{{ $report->id }}" name="statues_id" onchange="updateStatus(this, '{{ $report->id }}');">
                @foreach($statues as $status)
                    <option value="{{ $status->id }}" {{ $report->statues_id == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                @endforeach
            </select>
        </p>
    </div>
</div>

<script>
function updateStatus(selectElement, reportId) {
    const selectedValue = selectElement.value;
    let textColor;

    switch (selectedValue) {
        case '1':
            textColor = 'black'; 
            break;
        case '2':
            textColor = 'blue'; 
            break;
        case '3':
            textColor = 'red'; 
            break;
        default:
            textColor = 'black';
    }
    selectElement.style.color = textColor;

    const formData = new FormData();
    formData.append('status_id', selectedValue);
    
    fetch(`/reports/${reportId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log('Статус успешно обновлён');
        } else {
            alert('Ошибка при обновлении статуса');
        }
    })
    .catch(error => {
        console.error('Ошибка:', error);
    });
}
</script>
