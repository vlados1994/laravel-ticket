@extends('layouts.admin')
@section('nav-title')
Admin Panel
@endsection
@section('left-nav')
    <li><a href="">Роутинг</a></li>
    <li><a href="">Страницы</a></li>
    <li><a href="">Пользователи</a></li>
    <li><a href="">Система</a></li>
@endsection
@section('content')
<form class="col-md-8 col-md-offset-2">
  <div class="form-inline">
    <label for="inputroute">Путь</label>
    <input class="form-control" id="inputroute" type="text">
    <label for="inputpage">Страница</label>
    <input class="form-control" id="inputpage" type="text">
  </div>
  <div class="form-inline">
  	<label for="inputroute">Путь</label>
    <input class="form-control" id="inputroute" type="text">
    <label for="inputpage">Страница</label>
    <input class="form-control" id="inputpage" type="text">
  </div>
  <div class="form-inline">
   	<label for="inputroute">Путь</label>
    <input class="form-control" id="inputroute" type="text">
    <label for="inputpage">Страница</label>
    <input class="form-control" id="inputpage" type="text">
  </div>
</form>
@endsection