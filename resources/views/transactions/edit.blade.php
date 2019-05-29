@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-8">
        <div class="card">
                <div class="card-heading">
                    <h2>Update Transaction</h2>
                </div>
                <div class="card-body">
                <form action="/transactions/{{$transaction->id}}" method="POST">
                            {{ method_field('PUT') }}
                            @include('transactions.form', ['buttonText' => 'Update'])
                        </form>
                </div>      
            </div>  
        </div>
    </div>   
</div>
@endsection
