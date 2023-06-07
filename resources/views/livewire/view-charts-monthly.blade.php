<div class="col-lg-6">
    <div class="card z-index-2 mb-4">
        <div class="card-header pb-0">
            <h5 class="text-center">Tonnage per Day</h5>
        </div>
        <div class="card-body p-3">
            <div class="chart">
                <canvas id="tons_day_chart" class="chart-canvas" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="card z-index-2 mb-4">
        <div class="card-header pb-0">
            <h5 class="text-center">Tons per Hour</h5>
        </div>
        <div class="card-body p-3">
            <div class="chart">
                <canvas id="tons_hour_chart" class="chart-canvas" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="card z-index-2 mb-4">
        <div class="card-header pb-0">
            <h5 class="text-center">KWH per Kilo</h5>
        </div>
        <div class="card-body p-3">
            <div class="chart">
                <canvas id="kwh_chart" class="chart-canvas" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="card z-index-2 mb-4">
        <div class="card-header pb-0">
            <h5 class="text-center">Man Hour per Kilo</h5>
        </div>
        <div class="card-body p-3">
            <div class="chart">
                <canvas id="man_chart" class="chart-canvas" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-6">
    <div class="card z-index-2 mb-4">
        <div class="card-header pb-0">
            <h5 class="text-center">Overtime Cost per Kilo</h5>
        </div>
        <div class="card-body p-3">
            <div class="chart">
                <canvas id="ot_chart" class="chart-canvas" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

@section('monthly')
    <script>
        window.onload = function() {
            var ot_ctx = document.getElementById("kwh_chart").getContext("2d");

            var ot_gs = ot_ctx.createLinearGradient(0, 230, 0, 50);

            ot_gs.addColorStop(1, 'rgba(203,12,159,0.2)');
            ot_gs.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            ot_gs.addColorStop(0, 'rgba(203,12,159,0)');

            new Chart(ot_ctx, {
                type: "line",
                data: {
                    labels: [
                        @foreach ($month_labels as $key => $value)
                            '{{ $value }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: "KwH",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: ot_gs,
                        fill: true,
                        data: [
                            @foreach ($kilowatt as $key => $value)
                                {{ $value }},
                            @endforeach
                        ],
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });

            var man_ctx = document.getElementById("man_chart").getContext("2d");

            var man_gs = man_ctx.createLinearGradient(0, 230, 0, 50);

            man_gs.addColorStop(1, 'rgba(203,12,159,0.2)');
            man_gs.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            man_gs.addColorStop(0, 'rgba(203,12,159,0)');

            new Chart(man_ctx, {
                type: "line",
                data: {
                    labels: [
                        @foreach ($month_labels as $key => $value)
                            '{{ $value }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: "MhH",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: man_gs,
                        fill: true,
                        data: [
                            @foreach ($man_hour as $key => $value)
                                {{ $value }},
                            @endforeach
                        ],
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });

            var ot_ctx = document.getElementById("ot_chart").getContext("2d");

            var gs = ot_ctx.createLinearGradient(0, 230, 0, 50);

            gs.addColorStop(1, 'rgba(203,12,159,0.2)');
            gs.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gs.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            // var gradientStroke2 = ot_ctx.createLinearGradient(0, 230, 0, 50);

            // gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            // gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            // gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

            new Chart(ot_ctx, {
                type: "line",
                data: {
                    labels: [
                        @foreach ($month_labels as $key => $value)
                            '{{ $value }}',
                        @endforeach
                    ],
                    datasets: [{
                        label: "OTH",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gs,
                        fill: true,
                        data: [
                            @foreach ($overtime_cost as $key => $value)
                                {{ $value }},
                            @endforeach
                        ],
                        maxBarThickness: 6

                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });

            var ton_day = document.getElementById("tons_day_chart").getContext("2d");

            var ton_gs = ton_day.createLinearGradient(0, 230, 0, 50);

            ton_gs.addColorStop(1, 'rgba(203,12,159,0.2)');
            ton_gs.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            ton_gs.addColorStop(0, 'rgba(203,12,159,0)');

            new Chart(ton_day, {
                type: "line",
                data: {
                    labels: [
                        @foreach ($ton_day as $key => $value)
                            '{{ $key }}',
                        @endforeach
                        // 'Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6'
                    ],
                    datasets: [{
                        label: "TpD",
                        data: [
                            @foreach ($ton_day as $key => $value)
                                {{ $value }},
                            @endforeach
                            // Utils.numbers({count: 6, min: -100, max: 100}),
                        ],
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: ot_gs,
                        fill: true,
                        maxBarThickness: 6
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });

            var ton_hour = document.getElementById("tons_hour_chart").getContext("2d");

            var ton_hour_gs = ton_hour.createLinearGradient(0, 230, 0, 50);

            ton_hour_gs.addColorStop(1, 'rgba(203,12,159,0.2)');
            ton_hour_gs.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            ton_hour_gs.addColorStop(0, 'rgba(203,12,159,0)');

            new Chart(ton_hour, {
                type: "line",
                data: {
                    labels: [
                        @foreach ($ton_hour as $key => $value)
                            '{{ $key }}',
                        @endforeach
                        // 'Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6'
                    ],
                    datasets: [{
                        label: "TpD",
                        data: [
                            @foreach ($ton_hour as $key => $value)
                                {{ $value }},
                            @endforeach
                            // Utils.numbers({count: 6, min: -100, max: 100}),
                        ],
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: ot_gs,
                        fill: true,
                        maxBarThickness: 6
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false,
                        }
                    },
                    interaction: {
                        intersect: false,
                        mode: 'index',
                    },
                    scales: {
                        y: {
                            grid: {
                                drawBorder: false,
                                display: true,
                                drawOnChartArea: true,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                padding: 10,
                                color: '#b2b9bf',
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                display: false,
                                drawOnChartArea: false,
                                drawTicks: false,
                                borderDash: [5, 5]
                            },
                            ticks: {
                                display: true,
                                color: '#b2b9bf',
                                padding: 20,
                                font: {
                                    size: 11,
                                    family: "Open Sans",
                                    style: 'normal',
                                    lineHeight: 2
                                },
                            }
                        },
                    },
                },
            });
        }
    </script>
@endsection
