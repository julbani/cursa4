@extends('layouts.app')
@section('content')

<main>
    <div class="container-fluid">
        <div class="row px-4 py-5">
            <div class="col-sm-8 col-12">
                <div class="f_t mt-4">
                    <div class="user_1 pt-3 pl-3">
                        <h2 class="pt-1">{{ $question->author->name }}</h2>
                        <h2 align="right" class="mr-3">{{ date("Y-m-d",strtotime($question->created_at)) }}</h2>
                    </div>
                    <div class="task_1 pt-4 pl-3 text-center">
                            <div class="edit-wrapper" style="display:none;">
                                <form>
                                    <label for="edited-title">Заголовок</label>
                                    <input type="text" name="title" id="edited-title">
                                    <label for="edited-content">Вміст</label>
                                    <textarea name="content" id="edited-content"></textarea>
                                </form>
                                <button class="btn btn-success save-changes-btn">Зберегти Зміни</button>
                            </div>

                        <h4 class="mt-3 mb-5 question-title">{{ $question->title }}</h4>
                        <h4 class="mt-3 mb-5 question-content">{{ $question->content}}</h4>
                        <p>{{ $question->points }}</p>
                        <p class="question-subject">{{ $question->subject->name }}</p>
                        
                         <button id="answer-ref" class="btn2 mt-4">Відповісти</button>
                         @if (Auth::check() && Auth::user()->id == $question->user_id)
                            <button class="btn btn-danger edit-btn">Редагувати</button>
                        @endif

                    </div>
                </div>

                <form action="{{ route('answer.add', '$question->id') }}" method="POST" id="add-answer-form" style="display:none;">
                    {{ csrf_field() }}
                    <textarea name="content" class="answer-input"></textarea>
                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                    <button class="btn btn-success submit-answer-btn" data-valid-user="{{ Auth::check() }}">Надіслати</button>
                </form>

                

                @foreach($answers->get() as $answer)
                <div class="answer-container f_t_1 mt-3 n_sm_look" data-answer-id="{{ $answer->id }}" data-points="{{ $question->points }}">

                    <div class="user_1 pt-3 pl-3">
                        <h2 class="pt-1 pb-2">{{ $answer->author->name }}</h2>
                    </div>
                    <div class="task_1 pt-5 pl-3">
                        <h4 class="answ">{{ $answer->content }}</h4>
                    </div>

                    <!-- the answer is chosen by the question author -->
                    @if ($answer->is_chosen) 
                        <div class="choose-answer-btn active"></div>
                    <!-- chose correct answer(question author only) -->
                    @elseif (Auth::check() && Auth::user()->id == $question->user_id)
                        @if (count($answers->where('is_chosen', '1')->get()) == 0)
                            <div class="choose-answer-btn"></div>
                        @endif
                    @endif
                </div>
                @endforeach
            </div>
            @include('user_frame')
        </div>
    </div>
</main>

<script>
    // stuff for ajax requests
    var editUrl = "{{ route('edit') }}";
    var chooseAnswerUrl = "{{ route('answer.choose', $question->id) }}";
</script>
@endsection