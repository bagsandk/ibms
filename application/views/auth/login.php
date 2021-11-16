<div class="form-content col-md-12">

    <h1 class="">Log In</h1>
    <?= form_open('auth/', ['class' => 'text-left']) ?>

    <div class="form">
        <div id="username-field" class="field-wrapper input">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <input id="username" name="username"  type="text" class="form-control" placeholder="Username">
            <span><?= form_error('username') ?></span>
        </div>

        <div id="password-field" class="field-wrapper input mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
            <span><?= form_error('password') ?></span>

        </div>
        <div class="d-sm-flex justify-content-between">
            <div class="field-wrapper toggle-pass">
                <p class="d-inline-block">Show Password</p>
                <label class="switch s-primary">
                    <input type="checkbox" id="toggle-password" class="d-none">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="field-wrapper">
                <button type="submit" class="btn btn-primary" value="">Log In</button>
            </div>

        </div>

        <!-- <div class="field-wrapper">
            <a href="auth_pass_recovery.html" class="forgot-pass-link">Forgot Password?</a>
        </div> -->

    </div>
    <?= form_close()?>>
    <p class="terms-conditions">© 2020 All Rights Reserved </p>

</div>