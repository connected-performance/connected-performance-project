<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel 7 PDF Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<style>
    hr {
        margin-top: 1rem;
        margin-bottom: 1rem;
        border: 0;
        border-top: 3px solid rgb(0 0 0);
    }

    .container {
        margin-left: 2px;
    }

    .revenue_value {
        margin-left: 150px;
       
    }
</style>

<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="text-center lh-1 mb-2">
                    <h6 class="fw-bold">Expensify Statement</h6> <span class="fw-normal">Expense slip for the month of
                        June
                        2021</span>
                </div>
                <div class="d-flex justify-content-end"> <span>Working Branch:Expensify</span> </div>
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <div> <span class="fw-bolder">EMP Code</span> <small class="ms-3">39124</small> </div>
                            </div>
                            <div class="col-md-6">
                                <div> <span class="fw-bolder">EMP Name</span> <small class="ms-3">Connected</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div> <span class="fw-bolder">PF No.</span> <small class="ms-3">101523065714</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div> <span class="fw-bolder">Ac No.</span> <small class="ms-3">*******0701</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div> <span class="fw-bolder">ESI No.</span> <small class="ms-3"></small> </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div> <span class="fw-bolder">Mode of Pay</span> <small class="ms-3">SBI</small>
                                </div>
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <div> <span class="fw-bolder">Designation</span> <small class="ms-3">Marketing Staff
                                        (MK)</small> </div> --}}
                            </div>
                            <div class="col-md-6">
                                {{-- <div> <span class="fw-bolder">Ac No.</span> <small class="ms-3">*******0701</small>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <table class="mt-4 table table-bordered">
                        <thead class="bg-info text-white">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Marchent Name</th>
                                <th scope="col">Transaction ID</th>
                                <th scope="col">Category</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$data as $value)
                                <tr>
                                    <th scope="row">{{ $value->date }}</th>
                                    <th scope="row">{{ $value->marchent_name }}</th>
                                    <th scope="row">{{ $value->transactionID }}</th>
                                    <th scope="row">{{ $value->category }}</th>
                                    <th scope="row">{{ $value->description }}</th>
                                    <th scope="row">{{ $value->amount }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @php
                        $income = @$revenue_value - @$t_expense;
                        if ($income < 0) {
                            $statement = 'Loss';
                        } else {
                            $statement = 'Expense';
                        }
                    @endphp
                </div>
                <div class="row w-100">
                    {{-- <div class="col-md-4"> <br> <span class="fw-bold">Revenue: {{ @$revenue_value }}</span> </div> --}}
                    <div class="border col-md-8">
                        <div class="d-flex flex-column py-3">
                            <div class="row w-100">
                                <div class="col-6">
                                    <span class="text-dark font-weight-bold">Revenue:</span><span
                                        class="revenue_value">$</span> {{ @$revenue_value }}
                                </div>
                                <div class="col-6">
                                    {{-- <span class="revenue_value">$</span> {{ @$revenue_value }} --}}
                                </div>
                            </div>
                            <div class="row w-100">
                                <div class="col-6">
                                    <span class="text-dark font-weight-bold ">Expense:</span> <span class="revenue_value">-
                                        $</span> {{ @$t_expense }}
                                </div>
                                <div class="t_expense">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">

                                </div>

                                <div class="col-2 px-0">

                                    <hr class="revenue_value">
                                </div>
                            </div>
                            <div class="row w-100">
                                <div class="col-6">
                                    <span class="text-dark font-weight-bold">{{ $statement }}:</span> <span class="revenue_value">$</span> {{ @$income }}
                                </div>
                                <div class="col-6">
                                    {{-- <span class="revenue_value">$</span> {{ @$income }} --}}
                                    {{-- <hr class=""> --}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- <div class="d-flex aline-self-end">
                <div class="d-flex flex-column mt-2"> <span class="fw-bolder">For Kalyan Jewellers</span> <span
                        class="mt-4">Authorised Signatory</span> </div>
            </div> --}}
        </div>
    </div>
    </div>
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>
