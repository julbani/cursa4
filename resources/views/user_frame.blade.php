<div class="col-sm-4">
    <div class="prof prof_1 ml-3">
        <div class="user_1 py-3 pl-3">
            <h2 class="pt-1">{{ Auth::user()->name }}</h2>
        </div>
        <h3 class="pt-5 pl-3">Балів: {{ Auth::user()->points }}</h3>
        <h3 class="pt-2 pl-3">Відповідей: {{ count(Auth::user()->questions) }}</h3>
        <h3 class="pt-2 pl-3 pb-4">Правильних відповідей: {{ count(Auth::user()->answers()->where('is_chosen', '1')->get()) }}</h3>
    </div>
    <div class="prof ml-3 mt-3">
        <h3 class="pt-3 pl-3">Кому ви допомогли</h3>
        <?php $the_persons_you_help = [];

        foreach(Auth::user()->answers()->where('is_chosen', '1')->get() as $answer) {
            array_push($the_persons_you_help, $answer->question->author->name);
        }
        
        $the_persons_you_help = array_unique($the_persons_you_help);
        ?>

        @foreach ($the_persons_you_help as $person)
        <div class="user_1 py-3 pl-3">
            <h2 class="pt-1">{{ $person }}</h2>
        </div>
        @endforeach
    </div>
</div>
