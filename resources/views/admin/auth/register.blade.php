<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Register Account</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min2167.css') }}">
    <script nonce="26de121b-4257-4b1b-982f-172287f329f2">
        (function(w, d) {
            ! function(Z, _, ba, bb) {
                Z.zarazData = Z.zarazData || {};
                Z.zarazData.executed = [];
                Z.zaraz = {
                    deferred: [],
                    listeners: []
                };
                Z.zaraz.q = [];
                Z.zaraz._f = function(bc) {
                    return function() {
                        var bd = Array.prototype.slice.call(arguments);
                        Z.zaraz.q.push({
                            m: bc,
                            a: bd
                        })
                    }
                };
                for (const be of ["track", "set", "debug"]) Z.zaraz[be] = Z.zaraz._f(be);
                Z.zaraz.init = () => {
                    var bf = _.getElementsByTagName(bb)[0],
                        bg = _.createElement(bb),
                        bh = _.getElementsByTagName("title")[0];
                    bh && (Z.zarazData.t = _.getElementsByTagName("title")[0].text);
                    Z.zarazData.x = Math.random();
                    Z.zarazData.w = Z.screen.width;
                    Z.zarazData.h = Z.screen.height;
                    Z.zarazData.j = Z.innerHeight;
                    Z.zarazData.e = Z.innerWidth;
                    Z.zarazData.l = Z.location.href;
                    Z.zarazData.r = _.referrer;
                    Z.zarazData.k = Z.screen.colorDepth;
                    Z.zarazData.n = _.characterSet;
                    Z.zarazData.o = (new Date).getTimezoneOffset();
                    Z.zarazData.q = [];
                    for (; Z.zaraz.q.length;) {
                        const bl = Z.zaraz.q.shift();
                        Z.zarazData.q.push(bl)
                    }
                    bg.defer = !0;
                    for (const bm of [localStorage, sessionStorage]) Object.keys(bm || {}).filter((bo => bo
                        .startsWith("_zaraz_"))).forEach((bn => {
                        try {
                            Z.zarazData["z_" + bn.slice(7)] = JSON.parse(bm.getItem(bn))
                        } catch {
                            Z.zarazData["z_" + bn.slice(7)] = bm.getItem(bn)
                        }
                    }));
                    bg.referrerPolicy = "origin";
                    bg.src = "../../../../cdn-cgi/zaraz/sd0d9.js?z=" + btoa(encodeURIComponent(JSON.stringify(Z
                        .zarazData)));
                    bf.parentNode.insertBefore(bg, bf)
                };
                ["complete", "interactive"].includes(_.readyState) ? zaraz.init() : Z.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, 0, "script");
        })(window, document);
    </script>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a><b>Seller Account</b></a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Create Your Account</p>
                <form action="{{ route('admin.postRegister') }}" method="POST">
                    @csrf
                    @if (Session::has('success'))
                        <div class="alert alert-success m-4" style="width: 90%;">
                            {{ Session::get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger m-4" style="width: 90%;">
                            {{ Session::get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" value="Seller" disabled placeholder="Name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                    </div>
                </form>
                <p class="mb-0">
                    Already have account?
                    <a href="{{ route('admin.login') }}" class="text-center">Login</a>
                </p>
            </div>
        </div>
    </div>
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/adminlte.min2167.js') }}"></script>
</body>

</html>
