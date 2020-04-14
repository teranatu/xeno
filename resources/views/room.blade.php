@extends('layouts.appInRoom')

@section('content')

  <div class="ml-2 pr-2 row">

    <div style="height: 300px" class="col-3">
      <div class="card col-12 h-15">
        <div class="row h-100">
          <div class="col-4 d-flex align-items-center">ユーザー</div>
          <div class="col-4 d-flex align-items-center">所持カード</div>
          <div class="col-4 d-flex align-items-center"></div>
        </div>
      </div>
      <div id="inRoomUsers"class="row h-85">
      </div>
    </div>

    <div style="height: 300px" class="col-6">
        <div class="card h-100">
          <div class="row">
            <div id="isCountCard" class="col-6 pt-2 pb-2 text-center">0</div>
            <div id="usedCard" class=" col-6 pt-2 pb-2 text-center">フィールド：? </div>
            <div class="col-6 text-center">
              <img class="w-50 mb-3 mt-3" src="{{ asset("/xenoCards/xenoCardDeck.png") }}">
            </div>
            <div id="usedCardLatest" class="col-6 text-center">

            </div>
            <div class="col-3 text-center">
              <button class="btn btn-primary pt-2 pb-2 w-80" onclick="style.visibility ='hidden';location.href='{{ route('drawCard')}}'">1枚引く</button>
            </div>
            <div class="col-3 text-center">
              <button class="btn btn-primary pt-2 pb-2 w-80" onclick="style.visibility ='hidden';location.href='{{ route('drawKillCard')}}'">転生札を引く</button>
            </div>
          </div>
        </div>
    </div>

    <div style="height: 300px" class="col-3 card">
      <div class="row h-100">
        <div class="col-6 d-flex align-items-center" id="Deadcard_1">1:0枚</div>
        <div class="col-6 d-flex align-items-center" id="Deadcard_2">2:0枚</div>
        <div class="col-6 d-flex align-items-center" id="Deadcard_3">3:0枚</div>
        <div class="col-6 d-flex align-items-center" id="Deadcard_4">4:0枚</div>
        <div class="col-6 d-flex align-items-center" id="Deadcard_5">5:0枚</div>
        <div class="col-6 d-flex align-items-center" id="Deadcard_6">6:0枚</div>
        <div class="col-6 d-flex align-items-center" id="Deadcard_7">7:0枚</div>
        <div class="col-6 d-flex align-items-center" id="Deadcard_8">8:0枚</div>
        <div class="col-6 d-flex align-items-center" id="Deadcard_9">9:0枚</div>
        <div class="col-6 d-flex align-items-center" id="Deadcard_10">10:0枚</div>
      </div>
    </div>

  </div>

  <div style="height: 300px" class="ml-2 pr-2 mt-4 row">

    <div class="col-3">
      <div class="row">
        <div class="col-12">
          <button class="btn btn-danger col-12 pt-2 pb-2" onclick="style.visibility ='hidden';location.href='{{ route('initialization')}}'">初期化</button>
        </div>
        <div class="col-12">
          <button class="btn btn-success col-12 mt-2 pt-2 pb-2" onclick="style.visibility ='hidden';location.href='{{ route('selectCard')}}'">選択(7)効果使用</button>
          <button class="btn btn-success col-12 mt-2 pt-2 pb-2" onclick="style.visibility ='hidden';location.href='{{ route('exchangeCard')}}'">交換(8)効果使用</button>
        </div>
        <div class="col-12">
          @foreach($users as $user)
          @if (isset($selectcard_1) && ($user->select_user == Auth::id()))
          <div class="col-4">
            <form method="POST" action="{{ route('selectedCard')}}">
              @csrf
              <button class="btn btn-primary pt-2 pb-2" type="submit">1枚目：{{ $selectcard_1 }}</button>
              <input type="hidden" name="selectedCard" value="{{ $selectcard_1 }}">
            </form>
          </div>
          @endif
            @if (isset($selectcard_2) && ($user->select_user == Auth::id()))
          <div class="col-4">
            <form method="POST" action="{{ route('selectedCard')}}">
              @csrf
              <button class="btn btn-primary pt-2 pb-2" type="submit">2枚目：{{ $selectcard_2 }}</button>
              <input type="hidden" name="selectedCard" value="{{ $selectcard_2 }}">
            </form>
          </div>
          @endif
            @if (isset($selectcard_3) && ($user->select_user == Auth::id()))
          <div class="col-4">
            <form method="POST" action="{{ route('selectedCard')}}">
              @csrf
              <button class="btn btn-primary pt-2 pb-2" type="submit">3枚目：{{ $selectcard_3 }}</button>
              <input type="hidden" name="selectedCard" value="{{ $selectcard_3 }}">
            </form>
          </div>
          @endif
          @if ((($user->id != Auth::id())) && ($user->exchange_user == Auth::id()))
          <div class="col-4">
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
    
    <div class="col-6">
      <div class="row">
        <div class="col-6 text-center">
          <button class="btn btn-success w-50" onclick="style.visibility ='hidden';location.href='{{ route('discardLeft')}}'">左を使用</button>
          @for ( $i = 1;$i < 11;$i++ )
            @if ( $i == Auth::user()->card_1 )
              <img class="w-75 mt-4" src="{{ asset("/xenoCards/xenoCard_$i.png") }}">
            @endif
          @endfor
          
        </div>
        <div class="col-6 text-center">
          <button class="btn btn-success w-50" onclick="style.visbility ='hidden';location.href='{{ route('discardRight')}}'">右を使用</button>
          @for ( $i = 1;$i < 11;$i++ )
            @if ( $i == Auth::user()->card_2 )
              <img class="w-75 mt-4" src="{{ asset("/xenoCards/xenoCard_$i.png") }}">
            @endif
          @endfor
        </div>
      </div>
    </div>

    <div class="col-3">遊び方</div>

  </div>





@endsection