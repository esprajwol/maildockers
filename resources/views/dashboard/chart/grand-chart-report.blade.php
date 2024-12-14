<div class="row mt-4">
    <div class="col-lg-12 col-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <label for="">Select Report Type</label>
                        <select id="reportType" class="form-select mt-2" >
                            <option value="today">Today's Report</option>
                            <option value="yesterday">Yesterday's Report</option>
                            <option value="last7days">Last 7 Days</option>
                            <option value="last30days">Last 30 Days</option>
                        </select>
                    </div>

                    <div class="col-lg-4">
                        <label for="" class="mb-2">Select Date Range</label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text text-muted">
                                    <i class="ri-calendar-line"></i>
                                </div>
                                <input type="text"
                                       class="form-control flatpickr-input active"
                                       id="daterange"
                                       placeholder="Date range picker"
                                       readonly="readonly">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mb-3 d-flex align-items-start justify-content-between">
                    <div>
                        <span class="text-fixed-white fs-11">{{localize("Order Analytics")}} </span>
                        <h4 class="text-fixed-white mb-0">
                            <p class="totalOrders">0</p>
                            {!! bench_mark(0, "customReportBenchMark") !!}
                        </h4>
                    </div>
                </div>

                <div id="grandChart"></div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="mb-3 d-flex align-items-start justify-content-between">
                    <div>
                        <span class="text-fixed-white fs-11">{{localize("Revenue Analytics")}} </span>
                        <h4 class="text-fixed-white mb-0">
                            <p class="totalEarnings">0</p>

                            {!! bench_mark(0, "customReportRevenueBenchMark") !!}
                        </h4>
                    </div>
                </div>

                <div id="revenueGrandChart"></div>
            </div>
        </div>
    </div>

</div>

