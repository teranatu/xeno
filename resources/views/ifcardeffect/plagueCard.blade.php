




@if ((($user->id != Auth::id())) && ($user->plague_user == Auth::id()))
  <div class="col-4">
    <button class="btn btn-success" onclick="style.visibility ='hidden';document.getElementById('{{ $user->name }}').submit()">{{ $user->name }}</button>
  </div>

  <form id="{{ $user->name }}" method="POST" class="navbar-expand" action="{{ route('plaguedCard', [$group])}}">
    @csrf
    <input type="hidden" name="targetName" value="{{ $user->name }}">
  </form>
@endif