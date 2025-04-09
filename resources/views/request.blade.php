@extends('layouts.main')

@section('content')
    <x-guest-layout>
        @if (auth()->check() && \App\Models\Report::where('user_id', auth()->user()->id)->exists())
            <div class="text-center text-blue-500/100 mb-10 text-4xl">
                Вы уже отправили работу. Желаем удачи!
            </div>
        @else
            <form method="POST" action="{{ route('request.store') }}" enctype="multipart/form-data">
                @csrf
                <h1 class="text-center text-blue-500/100 mb-10 text-4xl">Создание заявки</h1>

                <div>
                    <label for="fullname" class="block font-bold">ФИО выступающего:</label>
                    <x-text-input id="fullname" class="block mt-1 w-full" type="text" name="fullname" :value="old('fullname')" required />
                    <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="theme" class="block font-bold">Тема выступления:</label>
                    <x-text-input id="theme" class="block mt-1 w-full" type="text" name="theme" :value="old('theme')" required />
                    <x-input-error :messages="$errors->get('theme')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="section_id" class="block font-bold">Секция:</label>
                    <select id="section_id" name="section_id" class="block mt-1 w-full" required>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->title }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('section_id')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="path_img" class="block font-bold">Загрузите фотографию выступающего:</label>
                    <x-text-input id="path_img" class="block mt-1 w-full" type="file" name="path_img" required />
                    <x-input-error :messages="$errors->get('path_img')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Создать заявку') }}
                    </x-primary-button>
                </div>
            </form>
        @endif

        <div class="mt-4 text-center">
            <a href="{{ route('main') }}" class="text-blue-500 underline">Вернуться к списку выступлений</a>
        </div>

        <div class="mt-4 text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-primary-button>
                    {{ __('Выйти') }}
                </x-primary-button>
            </form>
        </div>
    </x-guest-layout>
@endsection
