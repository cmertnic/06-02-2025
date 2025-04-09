@extends('layouts.main')

@section('content')
    <div class="flex justify-center items-center bg-gray-100 flex-col max-w-screen-sm ml-auto mr-auto mt-10">
        <h1>В нашем городе 10 и 11 марта пройдёт ИТ конференция «ФОРУМ ИТ»!</h1>
        <p class="text-center mt-10">Аудитория форума —начинающие и опытные ИТ-специалисты из разных регионов страны.</p>
        <p class="text-center mt-10">«ФОРУМ ИТ» - одно из самых востребованных мероприятий, посвященных вопросам
            программирования, тестирования и обеспечения информационной безопасности в информационных системах.</p>
        <p class="text-center mt-10">Форум проводится в офлайн и онлайн-форматах, ожидаемое число участников более 2,5 тыс.
            специалистов из всех регионов страны. </p>
        <p class="text-center mt-10">Среди них будут известные эксперты, руководители и представители федеральных и
            региональных органов власти, ведущих российских ИТ-компаний, образовательных и научных центров, крупнейших
            промышленных предприятий, компаний в сфере телекоммуникаций, энергетики, ВПК, финансов, машиностроения и других
            отраслей. </p>
        <h2 class="font-bold text-2xl mt-5">Секции:</h2>
        <ol class="text-center mt-5">
            <li>Ребенок может выслать на конкурс только одну работу. </li>
            <li>Работы, в соответствующих категорией, должны быть выполнены детьми самостоятельно и индивидуально.</li>
            <li>Стиль всегда остаются на усмотрение участника.</li>
        </ol>

        @foreach ($reports as $report)
        @if ($report->acess === 1)
            <x-report-card :report="$report" />
        @endif
    @endforeach
    

        @auth
            <form method="GET" action="{{ route('request.create') }}">
                @csrf
                <button type="submit" class="bg-blue-500 mt-4 ml-auto text-white font-bold py-2 px-4 rounded">
                    принять участие
                </button>
            </form>
        </div>
    @else
        <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs mt-2 text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
            href="{{ route('register') }}">
            принять участие
        </a>
        </div>
    @endauth
    </div>
@endsection
