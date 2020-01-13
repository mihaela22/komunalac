@extends('layouts.admin')

@section('content')

    <!-- ---------------------------------- C R E A T E   M O D A L ------------------------------------------->

    <div id="addCategory" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">


                <form method="post" action="{{ route('categories.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Nova kategorija</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Naziv:</label>
                            <input type="text" class="form-control" name="name" required/>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Odustani">
                        <input type="submit" class="btn btn-green" value="Dodajte kategoriju">
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- ---------------------------------- E D I T   M O D A L ------------------------------------------->

    <div id="editCategory" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">


                <form method="post" action="{{route('categories.update', 'test')}}" id="editForm">
                    @csrf
                    @method('PATCH') <!-- ili PUT ? -->
                    <div class="modal-header">
                        <h4 class="modal-title">Uredite kategoriju</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="category_id" id="cat_id" value="">
                            <label for="name">Naziv:</label>
                            <input type="text" id="name" class="form-control" name="name" placeholder="" required/>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Odustani">
                        <input type="submit" class="btn btn-green" value="Spremi">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ---------------------------------- D E L E T E   M O D A L ------------------------------------------->

    <div id="deleteCategory" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">


                <form method="post" action="{{route('categories.destroy', 'test')}}" id="editForm">
                @csrf
                @method('DELETE') <!-- ili PUT ? -->
                    <div class="modal-header">
                        <h4 class="modal-title">Izbrišite kategoriju&nbsp;<i class="fas fa-exclamation-circle fa-1x"></i></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Jeste li sigurni da želite izbrisati kategoriju <span class="text-uppercase" id="catName"></span>&nbsp;?</p>
                        <div class="form-group">
                            <input type="hidden" name="category_id" id="cat_id" value="">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Odustani">
                        <input type="submit" class="btn btn-delete" value="Izbriši">
                    </div>
                </form>
            </div>
        </div>
    </div>



    <!-- -------------------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="row col-12">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <br />
            @endif
            @if(session()->get('success'))
                <div class="col-12">
                <div class="msg msg-clear col-12 col-md-3 col-lg-2 row" style="z-index: 200">
                    <div class="col-2" onclick="parentNode.remove()"><i class="far fa-times-circle fa-2x"></i></div><div class="col-9"></div>
                    <div class="col-12 py-2 d-flex justify-content-center">{{ session()->get('success') }}</div>
                </div>
                </div>
            @endif

                <div class="col-12">
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-heading shadow main-color-bg row justify-content-between align-items-center">
                        <h3 class="panel-title py-2 px-5 m-0 mcol-3">Kategorije</h3>
                        <a  href="#addCategory" class="col-3 m-2" data-toggle="modal" style="font-size: 0.5rem">
                            <i style="color: #f2f2f2;" class="fas fa-plus-circle fa-5x"></i>
                        </a>
                    </div>
                    <div class="row p-4">
                        @foreach($categories as $category)
                            <div class="card m-3 p-0 col-md-3" >
                                <h5 class="card-header" style="background-color: rgba(209,202,190,0.65); color: #f2f2f2">{{$category->name}}</h5>
                                <div class="card-body">
                                   <!-- <h5 class="card-title"> {{$category->name}}</h5>-->
                                    <div class="row justify-content-around">
                                       <!-- <a href="{{ route('categories.edit',$category->id)}}" class="btn btn-green col-4"><i class="far fa-edit"></i></a>-->

                                           <a href="#editCategory" class="edit btn btn-green col-4" data-mytitle="{{$category->name}}" data-catid="{{$category->id}}" data-toggle="modal"><i class="far fa-edit"></i></a>
                                      <!--  <form action="{{ route('categories.destroy', $category->id)}}" method="post" class="col-5">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-delete col-12" type="submit"><i class="fas fa-trash-alt"></i></button>
                                        </form>-->
                                        <a href="#deleteCategory" class="btn btn-delete col-4" data-mytitle="{{$category->name}}" data-catid="{{$category->id}}" data-toggle="modal"><i class="fas fa-trash-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
</div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>





    <script>
        $(function(){
            $(document).on('show.bs.modal', '#editCategory', function (event) {
            var button = $(event.relatedTarget)
            var title = button.data('mytitle')
                var cat_id = button.data('catid')
            var modal = $(this)

            modal.find('.modal-body #name').val(title)
                modal.find('.modal-body #cat_id').val(cat_id)
        })
        });

        $(function(){
            $(document).on('show.bs.modal', '#deleteCategory', function (event) {
                var button = $(event.relatedTarget)
                var title = button.data('mytitle')
                var cat_id = button.data('catid')
                var modal = $(this)

                modal.find('.modal-body #catName').text(title)
                modal.find('.modal-body #cat_id').val(cat_id)
            })
        });
    </script>

@endsection
