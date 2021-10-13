@extends ('backend.template')

@section ('title_page')
    {{ $title_page }}
@endsection

@section ('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="overview-wrap">
                            <h2 class="title-1">{{ $title_page }}</h2>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c1">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                    <div class="text">
                                        <h2>{{ end($memberRegister) }}</h2>
                                        <span>{{ trans('backend_statical.reg_in_month') }}</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <canvas id="numMemberRegWidget"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c2">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-collection-music"></i>
                                    </div>
                                    <div class="text">
                                        <h2>{{ end($tracksAdded) }}</h2>
                                        <span>{{ trans('backend_statical.tracks_added') }}</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <canvas id="tracksAddedWidget"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c3">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-accounts"></i>
                                    </div>
                                    <div class="text">
                                        <h2>{{ $totalUsers }}</h2>
                                        <span>{{ trans('backend_statical.total_users') }}</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <canvas id="widgetChart3"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="overview-item overview-item--c4">
                            <div class="overview__inner">
                                <div class="overview-box clearfix">
                                    <div class="icon">
                                        <i class="zmdi zmdi-audio"></i>
                                    </div>
                                    <div class="text">
                                        <h2>{{ number_format($totalTracks, '0', ',', '.') }}</h2>
                                        <span>{{ trans('backend_statical.total_tracks') }}</span>
                                    </div>
                                </div>
                                <div class="overview-chart">
                                    <canvas id="widgetChart4"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{-- Views --}}
                    <div class="col-lg-6">
                        <div class="au-card recent-report">
                            <div class="au-card-inner">
                                <h3 class="title-2">{{ trans('backend_statical.views') }}</h3>
                                <div class="chart-info">
                                    <div class="chart-info__left">
                                        <div class="chart-note">
                                            <span class="dot dot--blue"></span>
                                            <span>{{ trans('backend_statical.tracks') }}</span>
                                        </div>
                                        <div class="chart-note mr-0">
                                            <span class="dot dot--green"></span>
                                            <span>{{ trans('backend_statical.albums') }}</span>
                                        </div>
                                    </div>
                                    <div class="chart-info__right">
                                        <div class="chart-statis">
                                            <span class="index incre">
                                                @if($viewsInTracks['viewsInLastMonth'] > $viewsInTracks['viewsInMonth'])
                                                    @php
                                                        $rate = 100 - $viewsInTracks['viewsInMonth'] / $viewsInTracks['viewsInLastMonth'] * 100;
                                                    @endphp
                                                    <i class="zmdi zmdi-long-arrow-down"></i>{{ $rate }}%
                                                @elseif($viewsInTracks['viewsInLastMonth'] < $viewsInTracks['viewsInMonth'])
                                                    @php
                                                        $rate = 100 - $viewsInTracks['viewsInLastMonth'] / $viewsInTracks['viewsInMonth'] * 100;
                                                    @endphp
                                                    <i class="zmdi zmdi-long-arrow-up"></i>{{ $rate }}%
                                                @else
                                                    <i class="zmdi zmdi-long-arrow-up"></i>0%
                                                @endif
                                            </span>
                                            <span class="label">{{ trans('backend_statical.tracks') }}</span>
                                        </div>
                                        <div class="chart-statis mr-0">
                                            <span class="index decre">
                                                @if($viewsInAlbums['viewsInLastMonth'] > $viewsInAlbums['viewsInMonth'])
                                                    @php
                                                        $rate = 100 - $viewsInAlbums['viewsInMonth'] / $viewsInAlbums['viewsInLastMonth'] * 100;
                                                    @endphp
                                                    <i class="zmdi zmdi-long-arrow-down"></i>{{ $rate }}%
                                                @elseif($viewsInAlbums['viewsInLastMonth'] < $viewsInAlbums['viewsInMonth'])
                                                    @php
                                                        $rate = 100 - $viewsInAlbums['viewsInLastMonth'] / $viewsInAlbums['viewsInMonth'] * 100;
                                                    @endphp
                                                    <i class="zmdi zmdi-long-arrow-up"></i>{{ $rate }}%
                                                @else
                                                    <i class="zmdi zmdi-long-arrow-up"></i>0%
                                                @endif
                                            </span>
                                            <span class="label">{{ trans('backend_statical.albums') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="recent-report__chart">
                                    <canvas id="viewsWidget"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Comments --}}
                    <div class="col-lg-6">
                        <div class="au-card chart-percent-card">
                            <div class="au-card-inner">
                                <h3 class="title-2 tm-b-5">{{ trans('backend_statical.comments_in') }} %</h3>
                                <div class="row no-gutters">
                                    <div class="col-xl-6">
                                        <div class="chart-note-wrap">
                                            <div class="chart-note mr-0 d-block">
                                                <span class="dot dot--blue"></span>
                                                <span>{{ trans('backend_statical.tracks') }}</span>
                                            </div>
                                            <div class="chart-note mr-0 d-block">
                                                <span class="dot dot--red"></span>
                                                <span>{{ trans('backend_statical.albums') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="percent-chart">
                                            <canvas id="commentsWidget"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section ('style')
    <link rel="stylesheet" href="{{ asset(config('bower.css') . 'jquery.dataTables.min.css') }}">
@endsection

@section ('script')
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset(config('bower.js') . 'Chart.bundle.min.js') }}"></script>
    <script>
        @php
            $nameMonth = [];
            foreach ($memberRegister as $key => $value){
                $tmpDate = DateTime::createFromFormat('!m', $key);
                $nameMonth[] = $tmpDate->format('F');
            }
            $memberRegister = array_values($memberRegister);
            $tracksAdded = array_values($tracksAdded);
            $comments = array_values($comments);
            $viewsInTracks = array_values($viewsInTracks);
            $viewsInAlbums = array_values($viewsInAlbums);
        @endphp
        // Member Register in month
        var numMemberRegWidget = document.getElementById("numMemberRegWidget");
        if (numMemberRegWidget) {
            numMemberRegWidget.height = 130;
            var myChartMem = new Chart(numMemberRegWidget, {
                type: 'line',
                data: {
                    labels: {!! json_encode($nameMonth)  !!},
                    type: 'line',
                    datasets: [{
                        data: {!! json_encode($memberRegister) !!},
                        label: '{{ trans('backend_statical.dataset') }}',
                        backgroundColor: 'transparent',
                        borderColor: 'rgba(255,255,255,.55)',
                    },]
                },
                options: {

                    maintainAspectRatio: false,
                    legend: {
                        display: false
                    },
                    responsive: true,
                    tooltips: {
                        mode: 'index',
                        titleFontSize: 12,
                        titleFontColor: '#000',
                        bodyFontColor: '#000',
                        backgroundColor: '#fff',
                        titleFontFamily: 'Montserrat',
                        bodyFontFamily: 'Montserrat',
                        cornerRadius: 3,
                        intersect: false,
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                color: 'transparent',
                                zeroLineColor: 'transparent'
                            },
                            ticks: {
                                fontSize: 2,
                                fontColor: 'transparent'
                            }
                        }],
                        yAxes: [{
                            display: false,
                            ticks: {
                                display: false,
                            }
                        }]
                    },
                    title: {
                        display: false,
                    },
                    elements: {
                        line: {
                            tension: 0.00001,
                            borderWidth: 1
                        },
                        point: {
                            radius: 4,
                            hitRadius: 10,
                            hoverRadius: 4
                        }
                    }
                }
            });
        }
        // --END
        // Tracks added in Month
        var tracksAddedWidget = document.getElementById("tracksAddedWidget");
        if (tracksAddedWidget) {
            tracksAddedWidget.height = 130;
            var myChartComm = new Chart(tracksAddedWidget, {
                type: 'line',
                data: {
                    labels: {!! json_encode($nameMonth)  !!},
                    type: 'line',
                    datasets: [{
                        data: {!! json_encode($tracksAdded) !!},
                        label: '{{ trans("backend_statical.dataset") }}',
                        backgroundColor: 'rgba(255,255,255,.1)',
                        borderColor: 'rgba(255,255,255,.55)',
                    },]
                },
                options: {
                    maintainAspectRatio: true,
                    legend: {
                        display: false
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            gridLines: {
                                color: 'transparent',
                                zeroLineColor: 'transparent'
                            },
                            ticks: {
                                fontSize: 2,
                                fontColor: 'transparent'
                            }
                        }],
                        yAxes: [{
                            display: false,
                            ticks: {
                                display: false,
                            }
                        }]
                    },
                    title: {
                        display: false,
                    },
                    elements: {
                        line: {
                            borderWidth: 0
                        },
                        point: {
                            radius: 0,
                            hitRadius: 10,
                            hoverRadius: 4
                        }
                    }
                }
            });
        }
        // --END
        // Comments in Month
        var commentsWidget = document.getElementById("commentsWidget");
        if (commentsWidget) {
            commentsWidget.height = 280;
            var myChartCom = new Chart(commentsWidget, {
                type: 'doughnut',
                data: {
                    datasets: [
                        {
                            label: "{{ trans('backend_statical.comments_in_month') }}",
                            data: {!! json_encode($comments) !!},
                            backgroundColor: [
                                '#00b5e9',
                                '#fa4251'
                            ],
                            hoverBackgroundColor: [
                                '#00b5e9',
                                '#fa4251'
                            ],
                            borderWidth: [
                                0, 0
                            ],
                            hoverBorderColor: [
                                'transparent',
                                'transparent'
                            ]
                        }
                    ],
                    labels: [
                        '{{ trans("backend_statical.tracks") }}',
                        '{{ trans("backend_statical.albums") }}'
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    cutoutPercentage: 55,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleFontFamily: "Poppins",
                        xPadding: 15,
                        yPadding: 10,
                        caretPadding: 0,
                        bodyFontSize: 16
                    }
                }
            });
        }
        // --END
        // Views in Month
        var viewsWidget = document.getElementById("viewsWidget");
        if (viewsWidget) {
            viewsWidget.height = 250;
            var myChartView = new Chart(viewsWidget, {
                type: 'line',
                data: {
                    labels: ['{{ trans('backend_statical.last_month') }}', '{{ trans('backend_statical.now') }}'],
                    datasets: [
                        {
                            label: '{{ trans("backend_statical.views_in_tracks") }}',
                            backgroundColor: 'rgba(0,181,233,0.8)',
                            borderColor: 'transparent',
                            pointHoverBackgroundColor: '#fff',
                            borderWidth: 0,
                            data: {!! json_encode($viewsInTracks) !!}

                        },
                        {
                            label: '{{ trans("backend_statical.views_in_albums") }}',
                            backgroundColor: 'rgba(0,173,95,0.8)',
                            borderColor: 'transparent',
                            pointHoverBackgroundColor: '#fff',
                            borderWidth: 0,
                            data: {!! json_encode($viewsInAlbums) !!}

                        }
                    ]
                },
                options: {
                    maintainAspectRatio: true,
                    legend: {
                        display: false
                    },
                    responsive: true,
                    scales: {
                        xAxes: [{
                            gridLines: {
                                drawOnChartArea: true,
                                color: '#f2f2f2'
                            },
                            ticks: {
                                fontFamily: "Poppins",
                                fontSize: 12
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                maxTicksLimit: 5,
                                stepSize: 2000000,
                                max: 10000000,
                                fontFamily: "Poppins",
                                fontSize: 12
                            },
                            gridLines: {
                                display: true,
                                color: '#f2f2f2'

                            }
                        }]
                    },
                    elements: {
                        point: {
                            radius: 0,
                            hitRadius: 10,
                            hoverRadius: 4,
                            hoverBorderWidth: 3
                        }
                    }
                }
            });
        }
    </script>
@endsection
