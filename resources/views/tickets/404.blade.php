@extends('master')
@section('title', 'Ticket not found')
@section('content')

    <div class="container col-md-8 col-md-offset-2">
            <div class="well well bs-component">
                <div class="content">
                    <h2 class="header">Твое обращение не найдено.</h2>
                    <p>Вероятно, ты не правильно ввёл его номер.</p>
                </div>
                <a href="#" class="btn btn-info">Edit</a>
                <a href="#" class="btn btn-info">Delete</a>
            </div>
    </div>

@endsection