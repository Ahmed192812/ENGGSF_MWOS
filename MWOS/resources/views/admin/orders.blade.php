
@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
<div class="row mb-2 text-center">
        <div class="col">
            <table class="table table-striped m-0 align-bottom border">
                <thead>
                    <tr>
                        <th scope="col">order ID</th>
                        <th scope="col-4">....</th>
                        <th scope="col">....</th>
                        <th scope="col">..</th>
                        <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                @if($Materials->isNotEmpty())
                @foreach ($Materials as $Material)
                    <tr>
                        <td class="col text-center align-middle">{{ $Material->id}}</th>
                        <td class="col-4 text-center align-middle">
                            <img src="{{asset('imgs/materials/' . $Material->image)}}" style="width: 200px; height: 150px;">
                        </th>
                        <td class="col text-center align-middle">{{ $Material->name}}</td>
                        <th class="col text-center align-middle">{{ $Material->costPerUnit}}</th>
                        <td class="col text-center align-middle">
                        <a href="javascript:void(0)" type="button" class="btn btn-sm btn-secondary rounded-pill px-3 edit" data-id="{{ $Material->id }}">Edit</a>
                            <a href="javascript:void(0)" type="button" class="btn btn-sm btn-danger rounded-pill px-3 delete" data-id="{{ $Material->id }}">Delete</a>
                        </td>
                    </tr>
                            @endforeach
                        
                        @else
                            <tr>
                            <h2>No record found</h2>
                            </tr>
                            
                            
                        @endif
                </tbody>
            </table>
            {!! $Materials->links() !!}

        </div>
    </div>
        </div>