<script type='text/javascript'>
    $(document).ready(function(){
        //Handles menu drop down
        $('.dropdown-menu').find('form').click(function (e) {
            e.stopPropagation();
        });
    });
</script>

<ul class="nav navbar-nav navbar-right nav-pills pull-right vcenter btn-custom">
    <li class="active"><a class="btn btn-lg btn-custom" href="#">главная</a></li>
    <li><a class="btn btn-lg btn-custom" href="#">ЗАКАЗЧИКУ</a></li>
    <li><a class="btn btn-lg btn-custom" href="#">ИСПОЛНИТЕЛЮ</a></li>
    <li><a class="btn btn-lg btn-custom" href="#">ФАКИ</a></li>
    <li><a class="btn btn-lg btn-custom" href="#">РЕГИСТРАЦИЯ</a></li>
    <li><a class="btn btn-lg btn-custom" href="#">КОНТАКТЫ</a></li>
    <li class="dropdown"><a href="#" class="btn btn-lg btn-custom dropdown-toggle" data-toggle="dropdown">ВХОД</a>
        <ul class="dropdown-menu" style="padding: 15px;min-width: 250px;">
            <li>
                <div class="row">
                    <div class="col-md-12">
                        <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputEmail2">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address" required>
                            </div>
                            <div class="form-group">
                                <label class="sr-only" for="exampleInputPassword2">Password</label>
                                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Password" required>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
            <li class="divider"></li>
            <li>
                <input class="btn btn-primary btn-block" type="button" id="sign-in-google" value="Sign In with Google">
                <input class="btn btn-primary btn-block" type="button" id="sign-in-twitter" value="Sign In with Twitter">
            </li>
        </ul>
    </li>
</ul>