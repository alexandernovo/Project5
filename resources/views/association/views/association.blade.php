@extends('layout.mainlayout')
@section('content')
    @include('association.css.association')
    <div class="row mx-auto">
        <table id="associationTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Date Created</th>
                    <th>Owner of Association</th>
                    <th>Address</th>
                    <th>Permit Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection

@section('js')
    @include('association.js.association')
@endsection
