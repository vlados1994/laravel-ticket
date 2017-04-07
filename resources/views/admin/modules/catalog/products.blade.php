@extends('layouts.admin')

@section('nav-title')
    Admin Panel
@endsection

@section('content')
    <div class="container">
        <h3>Каталог: настройки</h3>
        <div class="row no-margins">
            <button id="add-product" type="button" class="btn btn-default btn-lg">
                <span class="glyphicon glyphicon-plus"></span> Добавить новый товар
            </button>
        </div>

        <div class="row no-margins">

            <div id="products-list" class="col-lg-6 block-bordered top-buffer bg-white">
                <div class="block-title-row">Список товаров</div>

            </div>

            <div id="products-add-form" class="col-lg-6 block-bordered top-buffer bg-white" hidden>
                <div class="block-title-row">Добавить товар</div>
                <form class="top-buffer bottom-buffer">
                    <div class="form-group">
                        <label for="category">Выберите категорию</label>
                        <select id="category">
                            @foreach($categories as $category)
                                <option value="{{$category->type}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Название товара</label>
                        <input type="text" class="form-control" id="name">
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <input type="text" class="form-control" id="description">
                    </div>
                    <div class="form-group">
                        <label for="price">Цена</label>
                        <input type="text" class="form-control" id="price">
                    </div>
                    <div class="form-group">
                        <label for="url_part">Вид в url</label>
                        <input type="text" class="form-control" id="url_part">
                    </div>
                    <div class="form-group">
                        <label for="url_path">url_path</label>
                        <input type="text" class="form-control" id="url_path">
                    </div>
                    <div class="form-group">
                        <label for="availability">В наличии</label>
                        <input type="checkbox" class="form-control" id="availability">
                    </div>
                    <div class="form-group">
                        <label for="active">Отображать на сайте</label>
                        <input type="checkbox" class="form-control" id="active">
                    </div>
                    <div id="category-fields">
                    </div>
                </form>
            </div>
        </div>

        <button id="add-product-submit" type="button" class="btn btn-default btn-lg top-buffer">
            <span class="glyphicon glyphicon-plus"></span> Добавить
        </button>

    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('#category').change(
                function (e) {
                    var type = $(this).val();
                    $.ajax({
                        url: "{{route('productsAjax')}}",
                        method: "POST",
                        data: {
                            'type' : type,
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                        },
                        dataType: "json",
                        success: function( msg ) {
                            for(var i = 0; i < msg.length; i++) {
                                $('#category-fields').append('<div class="form-group"><label for="'
                                    + msg[i] + '">'+ msg[i]
                                    + '</label><input type="text" class="form-control"id="'
                                    + msg[i] + '"></div>'
                                );
                            }
                        },
                        error: function( jqXHR, textStatus ) {
                            $('#category-fields').html('');
                        }
                    });
                }
            );

            $('#add-product').click(function () {
                $('#products-list').prop('hidden', true);
                $('#add-product').css('display', 'none');
                $('#products-add-form').prop('hidden', false);
                $('#add-product-submit').css('display', 'block');
            });

            $('#add-product-submit').click(function () {
                $('#products-list').prop('hidden', false);
                $('#add-product').css('display', 'block');
                $('#products-add-form').prop('hidden', true);
                $('#add-product-submit').css('display', 'none');

                var category_id = $( "#name" ).val();
                var name = $( "#name" ).val();
                var price = $( "#price" ).val();
                var description = $( "#description" ).val();
                var url_part = $( "#url_part" ).val();
                var active = $( "#active" ).is(":checked");

                var action = "add";

                $.ajax({
                    url: "{{route('productsAjax')}}" + "/" + action,
                    method: "POST",
                    data: {
                        'name' : name,
                        'parent_id' : parent_id,
                        'description' : description,
                        'url_part' : url_part,
                        'active' : active,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    dataType: "text",
                    success: function( msg ) {
                        console.log(msg);
                    },
                    error: function( jqXHR, textStatus ) {
                        console.log( "Request failed: " + jqXHR );
                    }
                });
            });


        });
    </script>
@endsection
