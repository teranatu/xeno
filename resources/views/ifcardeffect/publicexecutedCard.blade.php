




@if( $user->publicexcutetarget == Auth::id())
  <div class="col-6">
    <button class="btn btn-success" onclick="style.visibility ='hidden';document.getElementById('plaguedLeftCard').submit()">左を捨てさせる</button>
  </div>
  
  <form id="plaguedLeftCard" method="POST" class="navbar-expand" action="{{ route('publicExecutedLeftOrRightCard', [$group])}}">
    @csrf
    <input type="hidden" name="publicexecute" value="left">
  </form>

  <div class="col-6">
    <button class="btn btn-success" onclick="style.visibility ='hidden';document.getElementById('plaguedRightCard').submit()">右を捨てさせる</button>
  </div>
  
  <form id="plaguedRightCard" method="POST" class="navbar-expand" action="{{ route('publicExecutedLeftOrRightCard', [$group])}}">
    @csrf
    <input type="hidden" name="publicexecute" value="right">
  </form>
@endif