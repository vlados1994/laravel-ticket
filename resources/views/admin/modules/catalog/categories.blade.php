@extends('layouts.app')

@section('nav-title')
    Admin Panel
@endsection

@section('content')
    <div class="container">
        <h3>Каталог: настройки</h3>
        <div class="row no-margins">
            <button id="add-category" type="button" class="btn btn-default btn-lg">
                <span class="glyphicon glyphicon-plus"></span> Добавить новую категорию
            </button>
        </div>

        <div class="row no-margins">

            <div id="categories-list" class="col-lg-6 block-bordered top-buffer bg-white">
                <div class="block-title-row">Список категорий</div>
            </div>

            <div id="categories-add-form" class="col-lg-6 block-bordered top-buffer bg-white" hidden>
                <div class="block-title-row">Добавить категорию</div>
                <form class="top-buffer bottom-buffer">
                    <div class="form-group">
                        <label for="name">Имя категории:</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Родительская категория:</label>
                        <input type="text" class="form-control" id="parent_id">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea class="form-control" id="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="url_part">Отображение в URL</label>
                        <input type="text" class="form-control" id="url_part">
                    </div>
                    <div class="checkbox">
                        <label><input id="active" type="checkbox"> Показывать на сайте</label>
                    </div>
                </form>
            </div>
        </div>

        <button id="add-category-submit" type="button" class="btn btn-default btn-lg top-buffer">
            <span class="glyphicon glyphicon-plus"></span> Добавить
        </button>

    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#add-category').click(function () {
                $('#categories-list').prop('hidden', true);
                $('#add-category').css('display', 'none');
                $('#categories-add-form').prop('hidden', false);
                $('#add-category-submit').css('display', 'block');
            });

            $('#add-category-submit').click(function () {
                $('#categories-list').prop('hidden', false);
                $('#add-category').css('display', 'block');
                $('#categories-add-form').prop('hidden', true);
                $('#add-category-submit').css('display', 'none');

                var name = $( "#name" ).val();
                var parent_id = $( "#parent_id" ).val();
                var description = $( "#description" ).val();
                var url_part = $( "#url_part" ).val();
                var active = $( "#active" ).is(":checked");

                var request = $.ajax({
                    url: "{{route('catalogAjax')}}",
                    method: "POST",
                    data: {
                        'name' : name,
                        'parent_id' : parent_id,
                        'description' : description,
                        'url_part' : url_part,
                        'active' : active,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    dataType: "json",
                    success: function( msg ) {
                        console.log(msg);
                    },
                    error: function( jqXHR, textStatus ) {
                        alert( "Request failed: " + textStatus );
                    }
                });
            });


        });
    </script>
@endsection