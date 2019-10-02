<div class="form-body">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">Name</label>
                <div class="col-md-10">
                    <input type="text" id="name" name="name"
                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           placeholder="Name"
                           value="{{ old('name', ($data->name?? '')) }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $errors->first('name')}}</strong>
                       </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group row">
                <label class="control-label col-md-2">Email</label>
                <div class="col-md-10">
                    <input type="email" id="email" name="email"
                           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="Email"
                           value="{{ old('email', ($data->email ?? '')) }}">
                    @if ($errors->has('email'))
                        <small class="form-control-feedback text-danger">{{ $errors->first('email') }}</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="form-actions">
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-linkedin">{{empty($data->id) ? "save" : "update"}}</button>
                    <a href="{{route('user.index')}}"
                       class="btn btn-danger"> Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>
