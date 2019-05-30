
    {{ csrf_field() }}
    <div class="form-group {{$errors->has('category_id')?'has-error': ''}}">
        <label for="category_id">Category</label>
        <select name="category_id" id="" class="form-control">
            <option value=""></option>
            @foreach($categories as $category)
           <option value="{{$category->id}}" {{$category->id == (old('category_id')?:$budget->category_id)?'selected':''}}>
            {{$category->name}}
           </option>
            @endforeach
        </select>
    </div>
<div class="form-group {{$errors->has('amount')?'has-error': ''}}">
    <label for="amount">Amount</label>
    <input type="number" name="amount" class="form-control" value="{{ old('amount')?: $budget->amount }}">
</div>

<div class="form-group {{$errors->has('budget_date')?'has-error': ''}}">
    <label for="budget_date">Budget Date</label>
    <select name="budget_date" id="" class="form-control">
        <option value=""></option>
        @foreach($months as $month)
       <option value="{{$month}}" {{$month == $budget->getMonth() ? 'selected':''}}>
        {{$month}}
       </option>
        @endforeach
    </select>
</div>

<button class="btn btn-success" type="submit">{{isset($buttonText)? $buttonText: 'Save'}}</button>
