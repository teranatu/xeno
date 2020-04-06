@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    @foreach ($users as $user)
    <div class="col-3">
      <div class="card">
        <div class="card-header">
          {{ $user->name }}
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-6 text-center">なし</div>
            <div class="col-6 text-center">なし</div>
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
        <div class="card">
          <button>1枚めくる</button>
          <button>裏をめくる</button>
          <button>初期化</button>
        </div>
      </div>
      <div class="col-6">
        <div class="card">
          <div class="card-text pt-4 pb-4 text-center">残カードX枚</div>
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


@endsection