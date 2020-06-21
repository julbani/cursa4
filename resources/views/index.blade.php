@extends('layouts.app')
@section('content')
<main>
<div class="container-fluid">
    <div class="row px-4 text-center">
        <div class="col-12 text-center">
            <a href="#" class="btn_m2">Додати питання</a>
        </div>
    </div>
    <div class="row px-4 py-5">
        <div class="col-sm-8 col-12">
            <form action="{{ url('/') }}" method="POST" class="filter-form">
                {{ csrf_field() }}
                <select multiple name="subjects[]" id="" class="btn3">
                    <option disabled selected>Предмети</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                    @endforeach
                </select>
                <select name="is_solved" id="" class="btn3">
                    <option selected>Всі</option>
                    <option value="solved">Лише вирішені</option>
                    <option value="not_solved">Лише не вирішені</option>
                </select>
                <button type="submit" class="btn btn-success" class="filter-btn">
                    Відфільтрувати
                </button>
            </form>
            
            @if (count($questions) > 0)
            @foreach($questions as $question)

            <div class="f_t mt-4">
                <div class="user_1 pt-3 pl-3">
                    <h2 class="pt-1">{{ $question->author->name }}</h2>
                    <h2 align="right" class="mr-3">Бали: {{ $question->points }}</h2>
                    <h2 align="right" class="mr-3">Опубліковано {{ date("Y-m-d",strtotime($question->created_at)) }}</h2>
                </div>
                <div class="task_1 pt-4 pl-3 text-center">
                    <a href="{{ url('/questions/'.$question->id) }}"><h1>{{ $question->title }}</h1></a>
                    <p>{{ $question->content }}</p>
                    <p>{{ $question->subject->name }}</p>
                </div>
            </div>

            @endforeach
            @elseif($is_search ?? '')
                <div class="card">
                    <p>Запит не знайшов жодного результату</p>
                    <a href="{{ url('/') }}">На головну</a>
                </div>
            @endif

        </div>
        @include('user_frame')
    </div>
</div>
</main>
@endsection