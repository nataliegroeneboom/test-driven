@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-8">
        <div class="card">
                <div class="card-heading">
                    <h2>Update Budgets</h2>
                </div>
                <div class="card-body">
                <form action="/budgets/{{$budget->id}}" method="POST">
                            {{ method_field('PUT') }}
                            @include('budgets.form', ['buttonText' => 'Update'])
                        </form>
                </div>      
            </div>  
        </div>
    </div>   
</div>
@endsection
