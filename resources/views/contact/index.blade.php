@extends('layouts.admin')


@section('content')

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>Contact Messages</strong>
                        </div>
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Service</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($messages as $message)
                                        <tr>
                                            <td class="serial">{{ $loop->iteration }}.</td>
                                            <td> <span class="name">{{ $message->name }}</span> </td>
                                            <td> <span class="email">{{ $message->email }}</span> </td>
                                            <td> <span class="service">{{ $message->service }}</span> </td>
                                            <td> <span class="subject">{{ $message->subject }}</span> </td>
                                            <td> <span class="message">{{ Str::limit($message->message, 50) }}</span> </td>
                                            <td>
                                                {{-- <div class="btn-group btn-group-sm ">
                                                    <a href="{{ route('contact.show', $message->id) }}" style="font-size:2rem; color:#007bff; display:inline-block; margin-right:10px;"><i class="fa fa-eye"></i></a>
                                                    <form action="{{ route('contact.destroy', $message->id) }}" method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="font-size:2rem; color:#bd2601; background:none; border:none; cursor:pointer;">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end align-items-center">
                            {{ $messages->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection