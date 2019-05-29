
    {{ csrf_field() }}
    <div class="form-group {{$errors->has('name')?'has-danger': ''}}">
        <label for="name">Name</label>
        <input 
            type="text" 
            name="name" 
            class="form-control {{$errors->has('name')?'form-control-danger': ''}}" 
            value="{{ old('name') ?: $category->name}}"
        >
    </div>
    <button class="btn btn-success" type="submit">{{isset($buttonText)? $buttonText: 'Save'}}</button>