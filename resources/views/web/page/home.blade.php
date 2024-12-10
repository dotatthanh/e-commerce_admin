@extends('web.layouts.master')
@section('content')
    <div class="container p-top50 pad20">
        <div class="row row20">
            <div class="col-md-7 col-sm-7 col-xs-12 pad20">
                <div class="slider-noibat">
                    <div><a href="#" class="c-img" title=""><img title=""
                                src="{{ asset('assets/web/images/anh-noi-bat.jpg') }}" alt=""></a></div>
                    <div><a href="#" class="c-img" title=""><img title=""
                                src="{{ asset('assets/web/images/anh1-1.jpg') }}" alt=""></a></div>
                    <div><a href="#" class="c-img" title=""><img title=""
                                src="{{ asset('assets/web/images/anh2-2.jpg') }}" alt=""></a></div>
                    <div><a href="#" class="c-img" title=""><img title=""
                                src="{{ asset('assets/web/images/anh2-3.jpg') }}" alt=""></a></div>
                </div>
                <ul class="category">
                    @foreach ($categories as $category)
                        <li><a href="{{ route('web.category', $category->id) }}"
                                title="{{ $category->name }}">{{ $category->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-12 pad20">
                <div class="row row10">
                    <div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
                        <a href="{{ route('web.category', 1) }}" title="Áo" class="c-img">
                            <img title="Áo" src="{{ asset('assets/web/images/anh1-1.jpg') }}" alt="">
                        </a>
                        <div class="shirt">
                            <a href="{{ route('web.category', 1) }}" title="Áo">ÁO</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
                        <a href="{{ route('web.category', 2) }}" title="Quần" class="c-img">
                            <img title="Quần" src="{{ asset('assets/web/images/anh1-1.jpg') }}" alt="">
                        </a>
                        <div class="trousers">
                            <a href="{{ route('web.category', 2) }}" title="Quần">QUẦN</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
                        <a href="{{ route('web.category', 3) }}" title="Giày" class="c-img">
                            <img title="Giày" src="{{ asset('assets/web/images/anh2-2.jpg') }}" alt="">
                        </a>
                        <div class="shoes">
                            <a href="{{ route('web.category', 3) }}" title="Giày">GIÀY</a>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 fashions pad10">
                        <a href="{{ route('web.category', 4) }}" title="Phụ kiện" class="c-img">
                            <img title="Phụ kiện" src="{{ asset('assets/web/images/anh2-3.jpg') }}" alt="">
                        </a>
                        <div class="accessories">
                            <a href="{{ route('web.category', 4) }}" title="Phụ kiện">PHỤ KIỆN</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 			SP bán chạy -->
    <div class="container p-top50">
        <h2 class="title-category">
            SẢN PHẨM BÁN CHẠY
        </h2>
        <div class="row p-top30">
            @foreach ($bestSellingProducts as $item)
                @include('web.components._product', [
                    'product' => $item,
                ])
            @endforeach
        </div>
    </div>
    <!-- 			End SP bán chạy -->

    <!-- 			SP Mới -->
    <div class="container p-top50 p-bot50">
        <h2 class="title-category bg-product-new">
            SẢN PHẨM MỚI
        </h2>
        <div class="row p-top30">
            @foreach ($newProducts as $item)
                @include('web.components._product', [
                    'product' => $item,
                ])
            @endforeach
        </div>
    </div>
    <!-- 			End SP Mới -->

    <!-- 			Gợi ý mua hàng -->
    <div class="container p-top50">
        <h2 class="title-category">
            GỢI Ý MUA HÀNG
        </h2>
        <div class="row p-top30">
            @foreach ($suggestedProducts as $item)
                @include('web.components._product', [
                    'product' => $item,
                ])
            @endforeach
        </div>
    </div>
    <!-- 			End Gợi ý mua hàng -->

    <button type="button" id="chat-ai"
        style="position: fixed; right: 0; bottom: 10px; background: #fff; border-radius: 100%;">
        <img src="{{ asset('/assets/images/chat-ai.svg') }}" alt="">
    </button>

    <div class="user-chat hidden" style="width: 328px; position: fixed; right: 0; bottom: 0;">
        <div class="card">
            <div class="px-4 py-2 border-bottom">
                <div class="row">

                    <div class="col-md-9 col-9">
                        <h5 class="font-size-15 mb-1">Chat AI</h5>
                        <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Đang hoạt
                            động</p>
                    </div>

                    <div class="col-md-3 col-3">
                        </button>
                        <ul class="list-inline user-chat-nav text-end mb-0">
                            <li class="list-inline-item d-none d-sm-inline-block">
                                <div class="dropdown">
                                    <button class="btn nav-btn dropdown-toggle" id="window-chat-minimize" type="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="mdi mdi-window-minimize"></i>
                                    </button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div>
                <div class="chat-conversation p-3">
                    <ul class="list-unstyled mb-0" data-simplebar style="height: 290px;">
                        {{-- <li>
                            <div class="chat-day-title">
                                <span class="title">Hôm nay</span>
                            </div>
                        </li>
                        <li>
                            <div class="conversation-list">
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Chat AI</div>
                                    <p>
                                        Xin chào!
                                    </p>
                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:00</p>
                                </div>

                            </div>
                        </li>

                        <li class="right">
                            <div class="conversation-list">
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Bạn</div>
                                    <p>Xin chào, bạn khỏe không? Cuộc họp tiếp theo của chúng ta thế nào?</p>

                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:02</p>
                                </div>
                            </div>
                        </li> --}}

                        {{-- <li>
                            <div class="conversation-list">
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Steven Franklin</div>
                                    <p>
                                        Yeah everything is fine
                                    </p>

                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:06</p>
                                </div>

                            </div>
                        </li>

                        <li class="last-chat">
                            <div class="conversation-list">
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Chat AI</div>
                                    <p>Cuộc họp tiếp theo vào ngày mai lúc 10.00 sáng</p>
                                    <p class="chat-time mb-0">10:06</p>
                                </div>

                            </div>
                        </li>

                        <li class=" right">
                            <div class="conversation-list">
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Henry Wells</div>
                                    <p>
                                        Wow that's great
                                    </p>

                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:07</p>
                                </div>
                            </div>
                        </li> --}}

                        {{-- <li class="right">
                            <div class="conversation-list">
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Bạn</div>
                                    <p>test</p>
        
                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:02</p>
                                </div>
                            </div>
                        </li> --}}
                    </ul>
                </div>
                <div class="p-3 chat-input-section">
                    <div class="row">
                        <div class="col">
                            <div class="position-relative">
                                <input type="text" class="form-control chat-input" placeholder="Nhập tin nhắn...">
                            </div>
                        </div>
                        <div class="col-auto">
                            <button type="button"
                                class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span
                                    class="d-none d-sm-inline-block me-2">Gửi</span> <i class="mdi mdi-send"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <!-- Bootstrap Css -->
    <link href="{{ asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    <!-- JAVASCRIPT -->
    {{-- <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/libs/metismenu/metismenu.min.js') }}"></script> --}}
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/libs/node-waves/node-waves.min.js') }}"></script> --}}
    <!-- toastr plugin -->
    {{-- <script src="{{ asset('/assets/libs/toastr/toastr.min.js') }}"></script> --}}
    <!-- App js -->
    {{-- <script src="{{ asset('assets/js/app.min.js') }}"></script> --}}

    <script>
        $("#chat-ai").on("click", function() {
            $(".user-chat").toggleClass('hidden');
            $("#chat-ai").toggleClass('hidden');
        });
        $("#window-chat-minimize").on("click", function() {
            $(".user-chat").toggleClass('hidden');
            $("#chat-ai").toggleClass('hidden');
        });

        $(".chat-send").on("click", function() {
            let message = $(".chat-input").val();

            let htmlYou = `
                <li class="right">
                    <div class="conversation-list">
                        <div class="ctext-wrap">
                            <div class="conversation-name">Bạn</div>
                            <p>${message}</p>

                            <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> ${getCurrentTime()}</p>
                        </div>
                    </div>
                </li>`;
            $(".simplebar-content").append(htmlYou);
            $(".chat-input").val('')

            generateChatAI(message)
        });

        function generateChatAI(message) {
            $.ajax({
                    url: "{{ route('web.generate-chat-ai') }}",
                    type: "POST",
                    data: {
                        message: message
                    },
                })
                .done(function(response) {
                    if (response.status == "success") {
                        let htmlChatAi = `
                        <li>
                            <div class="conversation-list">
                                <div class="ctext-wrap">
                                    <div class="conversation-name">Chat AI</div>
                                    <p>
                                        ${response.data.data.replace(/\n/g, "<br>")}
                                    </p>
                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> ${getCurrentTime()}</p>
                                </div>

                            </div>
                        </li>`;

                        $(".simplebar-content").append(htmlChatAi);
                    } else {
                        alert('Lỗi server!');
                    }
                })
                .fail(function() {
                    alert('Lỗi server!');
                });
        }

        function getCurrentTime() {
            let currentTime = new Date();
            let hours = currentTime.getHours().toString().padStart(2, '0');
            let minutes = currentTime.getMinutes().toString().padStart(2, '0');
            return `${hours}:${minutes}`;
        }
    </script>
@endsection
