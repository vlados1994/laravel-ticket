@extends('layouts.app')
@section('nav-title')
Admin Panel
@endsection
@section('left-nav')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Страницы <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('routing') }}">
                                            Роутинг
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            Правила URL
                                        </a>
                                    </li>
                                </ul>
                            </li>
    <li><a href="">Страницы</a></li>
    <li><a href="">Пользователи</a></li>
    <li><a href="">Система</a></li>
@endsection