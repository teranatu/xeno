




@if( isset($seeThroughedCard) )
  <div class="col-12">
    <button class="btn btn-success" onclick="style.visibility ='hidden';document.getElementById('confirmed').submit()">確認が終わったらこのボタンを押してください</button>
    <div class="card pt-2 pr-2 pb-2 pl-2">透視したカード:{{ $seeThroughedCard  }}</div>
  </div>
  
  <form id="confirmed" method="POST" class="navbar-expand" action="{{ route('seeThroughedconfirmedCard',[$group])}}">
    @csrf
    <input type="hidden" name="confirmed" value="ok">
  </form>
@endif