@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    @foreach ($users as $key => $user)
    <div class="col-3">
      <div class="card">
        <div class="card-header">
          {{ $user->name }}
        </div>
        <div class="card-body">
          <div class="row">
            @if (($key == 0) && ($user->id == Auth::id()))
            <div class="col-6 text-center">{{ $user->card_1 }}</div>
            <div class="col-6 text-center">{{ $user->card_2 }}</div>
            @endif
            @if ($key == 1 && ($user->id == Auth::id()))
            <div class="col-6 text-center">{{ $user->card_1 }}</div>
            <div class="col-6 text-center">{{ $user->card_2 }}</div>
            @endif
            @if ($key == 2 && ($user->id == Auth::id()))
            <div class="col-6 text-center">{{ $user->card_1 }}</div>
            <div class="col-6 text-center">{{ $user->card_2 }}</div>
            @endif
            @if ($key == 3 && ($user->id == Auth::id()))
            <div class="col-6 text-center">{{ $user->card_1 }}</div>
            <div class="col-6 text-center">{{ $user->card_2 }}</div>
            @endif

            
          </div>
        </div>
        <div class="card-footer">
          <button>カードを公開</button>
          <button>カードを非公開</button>
          <button>カードを捨てる</button>
          <button>ランダムに捨てる</button>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<div class="container mt-5 mb-5">
  <div class="row">
    
      <div class="col-6">
        <div class="row">
            <button class="btn btn-danger col-2" onclick="location.href='{{ route('initialization')}}'">初期化</button>
            <button class="btn btn-primary col-2" >裏を引く</button>
            <button class="btn btn-primary col-2" onclick="location.href='{{ route('drawCard')}}'">1枚引く</button>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div id="isCountCard" class="card-text pt-4 pb-4 text-center"> 0
          </div>
        </div>
      </div>

          <div class="col-1 card pt-4 pb-4 text-center"></div>
          <div class="col-1 card pt-4 pb-4 text-center">1:0枚</div>
          <div class="col-1 card pt-4 pb-4 text-center">2:0枚</div>
          <div class="col-1 card pt-4 pb-4 text-center">3:0枚</div>
          <div class="col-1 card pt-4 pb-4 text-center">4:0枚</div>
          <div class="col-1 card pt-4 pb-4 text-center">5:0枚</div>
          <div class="col-1 card pt-4 pb-4 text-center">6:0枚</div>
          <div class="col-1 card pt-4 pb-4 text-center">7:0枚</div>
          <div class="col-1 card pt-4 pb-4 text-center">8:0枚</div>
          <div class="col-1 card pt-4 pb-4 text-center">9:0枚</div>
          <div class="col-1 card pt-4 pb-4 text-center">10:0枚</div>
          <div class="col-1 card pt-4 pb-4 text-center"></div>

  </div>
</div>

<script src="{{ asset('js/isCount.js') }}"></script>
@endsection