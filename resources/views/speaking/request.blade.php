@extends('layouts.admin')

@section('content')

<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Speaking Requests</strong>
                    </div>
                    <div class="table-stats order-table ov-h">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Organization</th>
                                    <th>Event Type</th>
                                    <th>Event Date</th>
                                    <th>Expected Attendees</th>
                                    <th>Event Location</th>
                                    <th>Budget Range</th>
                                    <th>Additional Details</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($speakingRequests as $request)
                                    <tr>
                                        <td>{{ $request->id }}</td>
                                        <td>{{ $request->first_name }}</td>
                                        <td>{{ $request->last_name }}</td>
                                        <td>{{ $request->email }}</td>
                                        <td>{{ $request->phone }}</td>
                                        <td>{{ $request->organization }}</td>
                                        <td>{{ $request->event_type }}</td>
                                        <td>{{ $request->event_date }}</td>
                                        <td>{{ $request->expected_attendees }}</td>
                                        <td>{{ $request->event_location }}</td>
                                        <td>{{ $request->budget_range }}</td>
                                        <td>{{ $request->additional_details }}</td>
                                        <td>{{ $request->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex justify-content-end align-items-center">
                        {{ $speakingRequests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

