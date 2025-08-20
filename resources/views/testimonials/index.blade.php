@extends('layouts.admin')

@section('content')

    {{-- <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>Testimonials</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right d-flex justify-content-end align-items-center">
                        <button class="btn btn-success">Add Testimonial</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Testimonials</strong>
                        </div>
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($testimonials as $testimonial)
                                        <tr>
                                            <td class="serial">{{ $loop->iteration }}.</td>
                                            <td> <span class="name">{{ $testimonial->name }}</span> </td>
                                            <td> <span class="designation">{{ $testimonial->designation }}</span> </td  >
                                            <td> <span class="message">{{ Str::limit($testimonial->message, 50) }}</span> </td>
                                            <td>
                                                <div class="btn-group btn-group-sm ">
                                                    <a href="{{ route('testimonials.edit', $testimonial->id) }}" style="font-size:2rem; color:#007bff; display:inline-block; margin-right:10px;"><i class="fa fa-edit"></i></a>
                                                    <form action="{{ route('testimonials.destroy', $testimonial->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="font-size:2rem; color:#bd2601; background:none; border:none; cursor:pointer;"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> <!-- /.table-stats -->
                    </div>
                </div>
            </div>
        </div>
    </div>
        
@endsection