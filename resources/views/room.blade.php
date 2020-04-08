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
            @elseif(($key == 0) && (!($user->id == Auth::id())))
            <div class="col-6 text-center">?</div>
            <div class="col-6 text-center"></div>
            @endif
            @if ($key == 1 && ($user->id == Auth::id()))
            <div class="col-6 text-center">{{ $user->card_1 }}</div>
            <div class="col-6 text-center">{{ $user->card_2 }}</div>
            @elseif(($key == 1) && (!($user->id == Auth::id())))
            <div class="col-6 text-center">?</div>
            <div class="col-6 text-center"></div>
            @endif
            @if ($key == 2 && ($user->id == Auth::id()))
            <div class="col-6 text-center">{{ $user->card_1 }}</div>
            <div class="col-6 text-center">{{ $user->card_2 }}</div>
            @elseif(($key == 2) && (!($user->id == Auth::id())))
            <div class="col-6 text-center">?</div>
            <div class="col-6 text-center"></div>
            @endif
            @if ($key == 3 && ($user->id == Auth::id()))
            <div class="col-6 text-center">{{ $user->card_1 }}</div>
            <div class="col-6 text-center">{{ $user->card_2 }}</div>
            @elseif(($key == 3) && (!($user->id == Auth::id())))
            <div class="col-6 text-center">?</div>
            <div class="col-6 text-center"></div>
            @endif
          </div>
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
        <button class="btn btn-danger col-4 pt-3 pb-3" onclick="location.href='{{ route('initialization')}}'">初期化</button>
        <button class="btn btn-primary col-4 pt-3 pb-3" onclick="location.href='{{ route('drawKillCard')}}'">転生札を引く</button>
        <button class="btn btn-primary col-4 pt-3 pb-3" onclick="location.href='{{ route('drawCard')}}'">1枚引く</button>
        <button class="btn btn-success col-4 pt-3 pb-3" onclick="location.href='{{ route('discardLeft')}}'">左を使用</button>
        <button class="btn btn-success col-4 pt-3 pb-3" onclick="location.href='{{ route('discardRight')}}'">右を使用</button>
        <button class="btn btn-success col-4 pt-3 pb-3" onclick="location.href='{{ route('selectCard')}}'">選択(8)効果使用</button>
      </div>
    </div>
    <div class="card col-6">
      <div class="row">
        <div id="usedCard" class="col-6">使用されたカード：? </div>
        <div id="isCountCard" class="col-6">0</div>
      </div>
    </div>
  </div>
  @if (isset($selectcard_1))
  <div class="row col-6 mt-5">
    <div class="col-4">1枚目：{{ $selectcard_1 }}</div>
  @endif
  @if (isset($selectcard_2))
    <div class="col-4">2枚目：{{ $selectcard_2 }}</div>
  @endif
  @if (isset($selectcard_3))
    <div class="col-4">3枚目：{{ $selectcard_3 }}</div>
  </div>
  @endif
  <div class="row mt-5">
    <div class="col-1 navbar pt-4 pb-4 text-center"></div>
    <div class="col-1 card pt-4 pb-4 text-center" id="Deadcard_1">1:0枚</div>
    <div class="col-1 card pt-4 pb-4 text-center" id="Deadcard_2">2:0枚</div>
    <div class="col-1 card pt-4 pb-4 text-center" id="Deadcard_3">3:0枚</div>
    <div class="col-1 card pt-4 pb-4 text-center" id="Deadcard_4">4:0枚</div>
    <div class="col-1 card pt-4 pb-4 text-center" id="Deadcard_5">5:0枚</div>
    <div class="col-1 card pt-4 pb-4 text-center" id="Deadcard_6">6:0枚</div>
    <div class="col-1 card pt-4 pb-4 text-center" id="Deadcard_7">7:0枚</div>
    <div class="col-1 card pt-4 pb-4 text-center" id="Deadcard_8">8:0枚</div>
    <div class="col-1 card pt-4 pb-4 text-center" id="Deadcard_9">9:0枚</div>
    <div class="col-1 card pt-4 pb-4 text-center" id="Deadcard_10">10:0枚</div>
    <div class="col-1 navbar pt-4 pb-4 text-center"></div>
  </div>
</div>

@endsection