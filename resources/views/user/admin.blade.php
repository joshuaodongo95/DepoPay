<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.ico') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/css/userstyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/all.min.css"> --}}

    <title>{{ trans('panel.site_title') }}</title>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">


    @livewireStyles
    @stack('styles')
</head>

<body class="text-blueGray-800 antialiased">

    <noscript>You need to enable JavaScript to run this app.</noscript>

    <div id="app">
        <x-sidebar />

        <div class="relative md:ml-64 bg-blueGray-50 min-h-screen">
            <x-nav />

            <div class="relative bg-pink-600 md:pt-32 pb-32 pt-12">
                <div class="px-4 md:px-10 mx-auto w-full">&nbsp;</div>
            </div>

            <div class="relative px-4 md:px-10 mx-auto w-full min-h-full -m-48">
                @if (session('status'))
                    <x-alert message="{{ session('status') }}" variant="indigo" role="alert" />
                @endif
                <main>
                    <section>
                        <div class="featured-area pt-100 pb-70">
                            <div class="container">
                                @livewire('subscription.index')
                            </div>
                        </div>
                    </section>
                    {{-- <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Your Cart</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST">
                                        @csrf
                                        <table class="show-cart table">
                                            <!-- Your cart items here -->
                                        </table>
                                        <div class="grand-total">Total price: Ugx <span class="total-cart"></span></div>
                                        <!-- Only show the subscription button if there are items in the table -->
                                        @if (count($cartItems) > 0)
                                            <button type="submit"
                                                class="btn btn-primary float-right">Subscribe</button>
                                        @endif
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}


                </main>
                <x-footer />
            </div>
        </div>


    </div>

    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
    {{-- new --}}
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/cart.js') }}"></script>
    @livewireScripts
    @yield('scripts')
    @stack('scripts')
    <script>
        function closeAlert(event) {
            let element = event.target;
            while (element.nodeName !== "BUTTON") {
                element = element.parentNode;
            }
            element.parentNode.parentNode.removeChild(element.parentNode);
        }
    </script>
</body>

</html>
