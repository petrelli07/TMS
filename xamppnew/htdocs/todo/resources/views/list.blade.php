<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Ajax ToDo List</title>
        <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
        <script type="text/javascript" src="{{ url('js/jquery-1.11.3.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('js/bootstrap.js') }}"></script>
    </head>
    <body>
    <div class="container">

        <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ajax ToDo List <a href="#" id="addNew" class="pull-right" data-toggle="modal" data-target="#myModal">
                                <i class="glyphicon glyphicon-plus-sign" aria-hidden="true"></i></a>
                        </h3>
                    </div>
                    <div class="panel-body" id="items">

                            <ul class="list-group">
                                @foreach($items as $item)
                                <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">{{ $item->item }}
                                <input type="hidden" id="itemId" value="{{ $item->id }} ">
                                </li>
                                @endforeach
                            </ul>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="title">Add New Item</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="id">
                            <p><input type="text" placeholder="Write Item Here" id="addItem" class="form-control"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="delete" data-dismiss="modal" style="display: none">Delete</button>
                            <button type="button" class="btn btn-primary" id="saveChanges" data-dismiss="modal" style="display: none">Save changes</button>
                            <button type="button" class="btn btn-primary" id="addButton" data-dismiss="modal">Add Item</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </div>
    </div>
    {{ csrf_field() }}
    <script>
        $(document).ready(function (){
            $(document).on('click', '.ourItem', function(event){
                    var text = $(this).text();
                    var id = $(this).find('#itemId').val();
                    var text =$.trim(text);
                    $('#title').text('Edit Item');
                    $('#addItem').val(text);
                    $('#delete').show('400');
                    $('#saveChanges').show('400');
                    $('#addButton').hide('400');
                    $('#id').val(id);
                    console.log(text);
            });

            $(document).on('click', '#addNew', function(event){
                $('#title').text('Add New Item');
                $('#addItem').val("");
                $('#delete').hide('400');
                $('#saveChanges').hide('400');
                $('#addButton').show('400');
            });

            $('#addButton').click(function(event) {
                var text = $('#addItem').val();
                $.post('list',{'text':text,'_token':$('input[name=_token]').val()}, function(data){
                    console.log(data);
                    $('#items').load(location.href + ' #items');
                });
            });

            $('#delete').click(function(event){
                var id = $("#id").val();
                $.post('delete',{'id':id,'_token':$('input[name=_token]').val()}, function(data){
                    $('#items').load(location.href + ' #items');
                    console.log(data);
                });
            });

            $('#saveChanges').click(function(event){
                var value = $("#addItem").val();
                var id = $.trim($("#id").val());
                $.post('update',{'id':id, 'value':value, '_token':$('input[name=_token]').val()}, function(data){
                    $('#items').load(location.href + ' #items');
                    console.log(data);
                });
            });
        });
    </script>
    </body>
</html>