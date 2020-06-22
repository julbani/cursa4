<!-- Choosing photo -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Оберіть фото</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('image.upload.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="modal-body">
            <input type="file" name="image">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary change-photo-btn">Зберегти</button>
          </div>
        </form>
    </div>
  </div>
</div>

<div class="col-sm-4">
    <div class="prof prof_1 ml-3">

        <div class="user_1 py-3 pl-3">
            <button type="button" data-toggle="modal" data-target="#exampleModal" class="modal-btn" style="background-image: url({{ asset('/images/'.Auth::user()->photo) }})">
            </button>

            
            <h2 class="pt-1">{{ Auth::user()->name }}<br>Балів: {{ Auth::user()->points }}</h2>
        </div>
        <h3 class="pt-5 pl-3"></h3>
        <h3 class="pt-2 pl-3">Відповідей: {{ count(Auth::user()->questions) }}</h3>
        <h3 class="pt-2 pl-3 pb-4">Правильних відповідей: {{ count(Auth::user()->answers()->where('is_chosen', '1')->get()) }}</h3>
    </div>
    <div class="prof ml-3 mt-3">
        <h3 class="pt-3 pl-3">Кому ви допомогли</h3>
        <?php $the_persons_you_help = [];

        foreach(Auth::user()->answers()->where('is_chosen', '1')->get() as $answer) {
            array_push($the_persons_you_help, $answer->question->author);
        }
        
        $the_persons_you_help = array_unique($the_persons_you_help);
        ?>

        @foreach ($the_persons_you_help as $person)
        <div class="user_1 py-3 pl-3">
            <img src="{{ asset('images/'.$person->photo) }}" alt="" class="user-img">
            <h2 class="pt-1">{{ $person->name }}</h2>
        </div>
        @endforeach
    </div>
</div>