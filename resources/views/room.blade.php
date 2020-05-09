@extends('layouts.appInRoom')

@section('content')

  <div class="ml-2 mr-3 pr-2 row mt-4">

    <div style="height: 350px" class="col-3">
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

    <div style="height: 350px" class="col-6">
        <div class="card h-100">
          <div class="row h-100">
            <div class="col-6 pt-2 pb-2 text-center h-100">
              <div id="isCountCard" class="h-15">
              0
              </div>
              <div id="cardDeck" class="h-70">
                <img class="w-50 mb-3 mt-3 cardDeck-visible" src="{{ asset("/xenoCards/xenoNoCard.png") }}">
              </div>
              <div class="row h-15">
                <div class="col-6 text-center">
                  <button class="btn btn-primary pt-2 pb-2 w-80" onclick="style.visibility ='hidden';location.href='{{ route('drawCard',[$group])}}'">1枚引く</button>
                </div>
                <div class="col-6 text-center">
                  <button class="btn btn-primary pt-2 pb-2 w-80" onclick="style.visibility ='hidden';location.href='{{ route('drawKillCard',[$group])}}'">転生札を引く</button>
                </div>
              </div>
            </div>

            <div class=" col-6 pt-2 pb-2 text-center">
              <p id="usedCard">フィールド：?</p>
              <div id="usedCardLatest" class="text-center">
              </div>
            </div>
          </div>
        </div>
    </div>

    <div style="height: 350px" class="col-3 card">
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

  <div class="ml-2 pr-2 mt-4 row">

    <div  style="height: 400px" class="col-3">
      <div class="row">
        <div class="col-12">
          <button class="btn btn-danger col-12 mt-2" onclick="style.visibility ='hidden';location.href='{{ route('initialization',[$group])}}'">初期化</button>
        </div>
        <div class="col-12">
          <button class="btn btn-success col-12 mt-2" onclick="style.visibility ='hidden';location.href='{{ route('publicExecuteCard',[$group])}}'">公開処刑(1&9)効果使用</button>
          <button class="btn btn-success col-12 mt-2" onclick="style.visibility ='hidden';location.href='{{ route('seeThroughCard',[$group])}}'">透視(3)効果使用</button>
          <button class="btn btn-success col-12 mt-2" onclick="style.visibility ='hidden';location.href='{{ route('plagueCard',[$group])}}'">疫病(5)効果使用</button>
          <button class="btn btn-success col-12 mt-2" onclick="style.visibility ='hidden';location.href='{{ route('selectCard',[$group])}}'">選択(7)効果使用</button>
          <button class="btn btn-success col-12 mt-2" onclick="style.visibility ='hidden';location.href='{{ route('exchangeCard',[$group])}}'">交換(8)効果使用</button>
        
          <div style="height: 140px;" class="card d-flex align-items-center">
          <div class="row text-center mt-4 pt-2">

          @include('ifcardeffect.seethroughedCard') <!-- 透視カード取得 -->
          
          @if (isset($users))
            @foreach ($users as $user)
              @include('ifcardeffect.publicexecuteCard') <!-- 公開処刑対象ユーザー選択ボタン -->
              @include('ifcardeffect.publicexecutedCard') <!-- 公開処刑対象カード選択ボタン -->
              @include('ifcardeffect.plagueCard') <!-- 疫病対象ユーザー選択ボタン -->
              @include('ifcardeffect.plaguedCard') <!-- 疫病対象カード選択ボタン -->
              @include('ifcardeffect.seethroughCard') <!-- 透視対象ユーザー選択ボタン -->
              @include('ifcardeffect.selectCard') <!-- 選択対象カード選択ボタン -->
              @include('ifcardeffect.exchangeCard') <!-- 交換対象ユーザー選択ボタン -->
            @endforeach
          @endif
          </div>
          </div>
        </div>
      </div>
    </div>
    
    <div style="height: 400px" class="col-6">
      <div class="row">

        <div class="col-4 text-right">
          <button class="btn btn-success w-50" onclick="style.visibility ='hidden';document.getElementById('discardLeft').submit()">左を使用</button>
          <form id="discardLeft" action="{{ route('discard',[$group])}}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="discard" value="left">
          </form>
        </div>
        <div class="col-4 text-center">
          <button class="btn btn-success w-50" onclick="style.visibility ='hidden';location.href='{{ route('cardShuffle',[$group])}}'">シャッフル</button>
        </div>
        <div class="col-4 text-left">
          <button class="btn btn-success w-50" onclick="style.visbility ='hidden';document.getElementById('discardRight').submit()">右を使用</button>
          <form id="discardRight" action="{{ route('discard',[$group])}}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="discard" value="right">
          </form>
        </div>

        <div id ="cardLeft" class="col-6 text-center">
          @for ( $i = 1;$i < 11;$i++ )
            @if ( $i == Auth::user()->card_1 )
              <img class="userid-visible w-60 mt-4" src="{{ asset("/xenoCards/xenoCard_$i.png") }}">
            @endif
          @endfor
        </div>
        <div id="cardRight" class="col-6 text-center">
          @for ( $i = 1;$i < 11;$i++ )
            @if ( $i == Auth::user()->card_2 )
              <img class="userid-visible w-60 mt-4" src="{{ asset("/xenoCards/xenoCard_$i.png") }}">
            @endif
          @endfor
        </div>

      </div>
    </div>

    <div  style="height: 400px" class="col-3">
      <p>公開処刑されたカード</p>
      <div id="inRoomPublicexectute" class="row">
        <div class="col-6 publicexecutecard_1">null</div>
        <div class="col-6 publicexecutecard_2">null</div>
      </div>
    </div>

  </div>
@endsection