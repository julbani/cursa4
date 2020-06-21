@extends('layouts.app')

@section('content')

<main>
    <div class="conteiner-fluid">
        <div class="row px-4 py-3">
            <div class="col-sm-1"></div>
            <div class="col-sm-10">
                <form action="{{ url('questions/add') }}" method="POST" class="q_form">
                    @csrf
                    <h1 class="py-3 pl-3">Форма для запитання</h1>
                    <div class="form-group">
                        <input type="text" name="title" class="form-control mb-3" placeholder="Заголовок запитання">
                        <textarea cols="30" rows="10" class="form-control" placeholder="Задай тут своє питання коротко і зрозуміло" name="content" id="question-content"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-7 mt-5">
                            Предмет
                            <select class="btn3 bord mt-3" name="subject_id" id="subject-select">
                                <option disabled selected>Оберіть предмет</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div style="margin-left: 20px;">
                            <div class="form-group">
                                <label for="">Скільки балів ви готові віддати за відповідь?</label>
                                <input type="number" name="points" id="question-points" min="0" max="{{ Auth::user()->points }}">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button class="btn2 mt-4" type="submit" class="btn btn-success">Додати запитання</button>

                    </div>
                    
                </form>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
</main>


@endsection