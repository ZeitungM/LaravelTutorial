@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">パスワード再発行</div>
          <div class="panel-body">
            <form action="{{ route('password.update') }}" method="POST">
              @csrf
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" /> 
              </div>
              <div class="form-group">
                <label for="password">新しいパスワード</label>
                <input type="password" class="form-control" id="password" name="password" /> 
              </div>
              <div class="form-group">
                <label for="password-confirm">メールアドレス</label>
                <input type="password" class="form-control" id="password-confirm" name="password-confirm" /> 
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">再発行リンクを送る</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection
