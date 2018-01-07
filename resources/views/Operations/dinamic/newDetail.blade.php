<div class="modal fade" role="dialog" id='modalDetail'>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Form</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['id'=>'frmDetail']) !!}
                <input type="hidden" id="id" name="id" class="input-detail">
                <input type="hidden" id="dinamic_id" name="dinamic_id" class="input-detail">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="email">Label Field</label>
                            <input type="text" class="form-control input-detail" id="label_field" name='label_field'>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="email">Name Field</label>
                            <input type="text" class="form-control input-detail" id="name_field" name='name_field'>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="email">Placeholder Field</label>
                            <input type="text" class="form-control input-detail" id="placeholder_field" name='placeholder_field'>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="email">Type of Form</label>
                            <select id="type_form_id" name="type_form_id" class="form-control input-detail">
                                <option value="0">Selecccione</option>
                                @foreach($parameters as $val)
                                <option value="{{$val->code}}">{{$val->description}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" >Close</button>
                <button type="button" class="btn btn-success" id='newDetail'>Save</button>
            </div>
        </div>
    </div>
</div>