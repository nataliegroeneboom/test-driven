@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
       <div class="col-md-8">
        <div class="card">
                <div class="card-heading">
                    <h2>Create Transaction</h2>
                </div>
                <div class="card-body">
                        <form action="/transactions" method="POST">
                            @include('transactions.form')
                        </form>
                </div>      
            </div>  
        </div>
    </div>   
</div>

@endsection