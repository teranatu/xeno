@extends('layouts.app')

@section('content')

  <div style="height: 300px" class="ml-2 row">
    <div class="col-3">
      <div class="text-left">
        <div class="btn btn-danger col-4">ユーザー</div>
        <div class="btn ">所持カード</div>
        <div class="btn "></div>
      </div>
      <div id="inRoomUsers"class="row">
      </div>
    </div>
    <div style="height: 300px" class="col-6">
    </div>
    <div style="height: 300px" class="col-3">
    </div>
  </div>

  <div class="col-6">
    <div class="row">
      <div class="col-6">
        <div class="row">
          <button class="btn btn-danger col-2 pt-2 pb-2" onclick="style.display ='none';location.href='{{ route('initialization')}}'">初期化</button>
          <button class="btn btn-primary col-2 pt-2 pb-2" onclick="style.display ='none';location.href='{{ route('drawKillCard')}}'">転生札を引く</button>
          <button class="btn btn-primary col-2 pt-2 pb-2" onclick="style.display ='none';location.href='{{ route('drawCard')}}'">1枚引く</button>
          <button class="btn btn-success col-2 pt-2 pb-2" onclick="style.display ='none';location.href='{{ route('discardLeft')}}'">左を使用</button>
          <button class="btn btn-success col-2 pt-2 pb-2" onclick="style.display ='none';location.href='{{ route('discardRight')}}'">右を使用</button>
          <button class="btn btn-success col-2 pt-2 pb-2" onclick="style.display ='none';location.href='{{ route('selectCard')}}'">選択(7)効果使用</button>
          <button class="btn btn-success col-2 pt-2 pb-2" onclick="style.display ='none';location.href='{{ route('exchangeCard')}}'">交換(8)効果使用</button>
        </div>
      </div>
      <div class="card col-6">
        <div class="row">
          <div id="usedCard" class=" col-3 pt-2 pb-2">フィールド：? </div>
          <div id="isCountCard" class="col-3 pt-2 pb-2">0</div>
          @foreach($users as $user)
          @if (isset($selectcard_1) && ($user->select_user == Auth::id()))
          <div class="col-2">
            <form method="POST" action="{{ route('selectedCard')}}">
              @csrf
              <button class="btn btn-primary pt-2 pb-2" type="submit">1枚目：{{ $selectcard_1 }}</button>
              <input type="hidden" name="selectedCard" value="{{ $selectcard_1 }}">
            </form>
          </div>
          @endif
            @if (isset($selectcard_2) && ($user->select_user == Auth::id()))
          <div class="col-2">
            <form method="POST" action="{{ route('selectedCard')}}">
              @csrf
              <button class="btn btn-primary pt-2 pb-2" type="submit">2枚目：{{ $selectcard_2 }}</button>
              <input type="hidden" name="selectedCard" value="{{ $selectcard_2 }}">
            </form>
          </div>
          @endif
            @if (isset($selectcard_3) && ($user->select_user == Auth::id()))
          <div class="col-2">
            <form method="POST" action="{{ route('selectedCard')}}">
              @csrf
              <button class="btn btn-primary pt-2 pb-2" type="submit">3枚目：{{ $selectcard_3 }}</button>
              <input type="hidden" name="selectedCard" value="{{ $selectcard_3 }}">
            </form>
          </div>
          @endif
          @if ((($user->id != Auth::id())) && ($user->exchange_user == Auth::id()))
          <div class="col-2">
            <form method="POST" action="{{ route('exchangedCard')}}">
              @csrf
              <button class="btn btn-primary pt-2 pb-2" type="submit">{{ $user->name }}</button>
              <input type="hidden" name="targetName" value="{{ $user->name }}">
            </form>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </div>
  </div>
  
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


@endsection