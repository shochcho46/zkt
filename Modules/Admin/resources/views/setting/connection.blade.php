<div class="row">
    <h1 class="m-4">Connection Status</h1>

    <div class="row">

        <div class="col-lg-4 col-4"></div>
        <div class="col-lg-4 mb-3 mt-3">


            @if ($connection['status'] == true)
                <div class="text-center mb-3">
                    <img src="{{ asset('assets/zkt/connect.png') }}" alt="success.png" class="img-fluid">
                </div>

                <div class="mt-5 text-start">
                    <strong>Device Status:</strong>
                    <span class="badge bg-success p-2">Connected</span>
                    <br>
                    <strong>Device Name:</strong>
                    {{ $connection['name'] }}
                    <br>
                    <strong>Time:</strong> {{ $connection['time'] }}
                </div>
            @else
                <div class="text-center mb-3">
                    <img src="{{ asset('assets/zkt/lostconnect.png') }}" alt="success.png" class="img-fluid">
                </div>
                <div class="mt-2 text-start">
                    <strong>Device Status:</strong>
                    <span class="badge bg-danger p-2">Not Connected</span>

                </div>
            @endif
        </div>
        <div class="col-lg-4 col-4"></div>
    </div>

</div>
