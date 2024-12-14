

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card custom-card">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="dt-length w-25">
                            <label for="perPage" class="">Per Page:</label>
                            <select name="per_page" id="perPage" class="form-select form-select-sm" onchange="per_page()">
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <option value="400">400</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 ">
                        <div class="search-section float-end">
                            <label for="perPage" class=""></label>
                            <select name="date_search" id="date_search" class="form-select form-select-sm"
                                    style="">
                                <option value="1"
                                        data-start="{{ getStartAndEndDate(0)[0] }}"
                                        data-end="{{ getStartAndEndDate(0)[1] }}">
                                    Today
                                </option>
                                <option value="1"
                                        data-start="{{ getStartAndEndDate(1)[0] }}"
                                        data-end="{{ getStartAndEndDate(1)[1] }}">
                                    Yesterday
                                </option>
                                <option value="1"
                                        data-start="{{ getStartAndEndDate(7)[0] }}"
                                        data-end="{{ getStartAndEndDate(7)[1] }}">
                                    Last 7 days
                                </option>
                                <option value="1"
                                        data-start="{{ \Carbon\Carbon::now()->startOfMonth()->format('Y-m-d') }}"
                                        data-end="{{ getStartAndEndDate(1,2)[1] }}">
                                    This Month
                                </option>

                                <option value="1"
                                        data-start="{{ \Carbon\Carbon::now()->subMonth(12)->format("Y-m-d") }}"
                                        data-end="{{ getStartAndEndDate(12,2)[1] }}">
                                    Last 12 Month
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="row mt-2 justify-content-between">
                        <div class="col-md-auto me-auto">

                        </div>
                    </div>

                    <div class="col-md-2">

                    </div>
                    <div class="col-md-10"></div>
                </div>

                <div class="order-container">
                    <div class="table-responsive">
                        <table class="table" id="orderTable">
                            <thead>
                            <tr>
                                <th> {{localize('SL')}} </th>
                                <th> {{localize('Date')}} </th>
                                <th> {{localize('Order by')}} </th>
                                <th> {{localize('Target')}} </th>
                                <th> {{localize('Pages')}} </th>
                                <th> {{localize('Price')}} </th>
                            </tr>
                            </thead>
                            <tbody class="orderTbody">
                            @include("dashboard.partners.orders.orders_table")
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
