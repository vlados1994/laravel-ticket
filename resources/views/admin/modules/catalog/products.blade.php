@extends('layouts.admin')

@section('nav-title')
    Admin Panel
@endsection

@section('content')
    <div class="container">
        <h3>Каталог: товары</h3>
        <div class="row no-margins">
            <button id="add-product" type="button" class="btn btn-default btn-lg">
                <span class="glyphicon glyphicon-plus"></span> Добавить новый товар
            </button>
        </div>

        <div class="row no-margins">

            <div id="products-list" class="col-lg-6 block-bordered top-buffer bg-white">
                <div class="block-title-row">Список товаров по категориям</div>
                <div id="products-container">
                    <br/><a class="0" href="#">Все категории</a>
                    @foreach($rootCategories as $category)
                        <br/><a  href="#" class="{{$category->id}}">{{$category->name}}</a>
                    @endforeach
                </div>
            </div>

            <div id="products-add-form" class="col-lg-6 block-bordered top-buffer bg-white" hidden>
                <div class="block-title-row">Добавить товар</div>
                <form id="products-add" class="top-buffer bottom-buffer">
                    <div class="form-group">
                        <label for="category">Выберите категорию</label>
                        <select id="category">
                            <option selected disabled>Выберите категорию</option>
                            @foreach($activeCategories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
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
                        <label for="url_path">Путь до изображения</label>
                        <input type="text" class="form-control" id="img_path">
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
    <script src="{{asset('/js/helper.js')}}"></script>
    <script>

        function productsRetrieve(catId) {
            $.ajax({
                url: "{{route('productsRetrieve')}}",
                method: "POST",
                data: {
                    'id' : catId,
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                },
                dataType: "json",
                success: function( msg ) {
                    $('#products-container').append('' +
                        '<div class="top-buffer block-title-row">Список товаров: </div>');
                    for(var key in msg) {
                        $('#products-container').append(
                            '<a href="#">' + msg[key] + "</a>"
                        );
                    }
                },
                error: function( jqXHR, textStatus ) {
                    console.log( "Request failed: " + jqXHR );
                }
            });
        }

        function acnhorClickListener() {
            $('#products-list').click(function (e) {
                e.preventDefault();
                if(e.target.tagName != 'A') {
                    return;
                }
                var catId = $(e.target).attr('class');
                console.log(catId);
                $.ajax({
                    url: "{{route('categoriesRetrieve')}}",
                    method: "POST",
                    data: {
                        'id' : catId,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    dataType: "json",
                    success: function( msg ) {
                        console.log(msg);
                        $('#products-container').html('');
                        for(var key in msg) {
                            $('#products-container').append(
                                '<br/><a  href="#" class="'+ key + '">' + msg[key] + '</a>'
                            );
                        }
                        productsRetrieve(catId);
                    },
                    error: function( jqXHR, textStatus ) {
                        $('#products-container').html('');
                        console.log( "Request failed: " + jqXHR );
                        productsRetrieve(catId);
                    }
                });


            });
        }

        $(function () {
            acnhorClickListener();
            $('#category').change(
                function (e) {
                    $('#category-fields').html('');
                    var id = $(this).val();
                    $.ajax({
                        url: "{{route('productsAttrsRetrieve')}}",
                        method: "POST",
                        data: {
                            'id' : id,
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                        },
                        dataType: "json",
                        success: function( msg ) {
                            for(var key in msg) {
                                $('#category-fields').append('<div class="form-group"><label for="'
                                    + key + '">'+ msg[key]
                                    + '</label><input type="text" class="form-control" id="'
                                    + key + '"></div>'
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

                var category_id = $( "#category option:selected" ).val();
                var name = $( "#name" ).val();
                var price = $( "#price" ).val();
                var description = $( "#description" ).val();
                var url_part = $( "#url_part" ).val();
                var img_path = $( "#img_path" ).val();
                var active = $( "#active" ).is(":checked");
                var availability = $( "#availability" ).is(":checked");

                var $additionalFields = $('#category-fields input');

                var additionalKeys = $additionalFields.map(function(){
                    return this.id;
                }).get();

                var additionalValues = $additionalFields.map(function(){
                    return $( this ).val();
                }).get();

                var additional = arrayCombine(additionalKeys, additionalValues);

                var action = "add";

                $.ajax({
                    url: "{{route('productsAdd')}}",
                    method: "POST",
                    data: {
                        'name' : name,
                        'category_id' : category_id,
                        'price' : price,
                        'description' : description,
                        'url_part' : url_part,
                        'img_path' : img_path,
                        'active' : active,
                        'availability' : availability,
                        'additional' : additional,
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                    },
                    dataType: "text",
                    success: function( msg ) {
                        console.log(msg);
                        document.getElementById('products-add').reset();
                        $('#category-fields').html('');
                    },
                    error: function( jqXHR, textStatus ) {
                        console.log( "Request failed: " + jqXHR );
                    }
                });
            });


        });
    </script>
@endsection
