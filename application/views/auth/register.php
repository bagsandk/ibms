<div class="form-content">

    <h1 class="">Register</h1>
    <p class="signup-link register">Already have an account? <a href="<?= base_url('auth') ?>">Log in</a></p>
    <?= form_open('auth/register', ['class' => 'text-left']) ?>
    <div class="form">
        <div id="nama-field" class="field-wrapper input">
            <label for="nama">Nama</label>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <input id="nama" name="nama" type="text" value="<?= $this->input->post('nama') ?>"  class="form-control" placeholder="Nama">
            <span><?= form_error('nama') ?></span>
        </div>

        <div id="email-field" class="field-wrapper input">
            <label for="email">EMAIL</label>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign register">
                <circle cx="12" cy="12" r="4"></circle>
                <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
            </svg>
            <input id="email" name="email" type="text" value="<?= $this->input->post('email') ?>" class="form-control" placeholder="Email">
            <span><?= form_error('email') ?></span>

        </div>
        <div id="no_hp-field" class="field-wrapper input">
            <label for="no_hp">No HP</label>
            <input id="no_hp" name="no_hp" type="text" value="<?= $this->input->post('no_hp') ?>"  class="form-control" placeholder="No HP">
            <span><?= form_error('no_hp') ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone register mt-3">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
            </svg>
        </div>

        <div id="password-field" class="field-wrapper input mb-2">
            <div class="d-flex justify-content-between">
                <label for="password">PASSWORD</label>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
            </svg>
            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
            <span><?= form_error('password') ?></span>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>
        </div>

        <div class="field-wrapper terms_condition">
            <div class="n-chk">
                <label class="new-control new-checkbox checkbox-primary">
                    <input type="checkbox" class="new-control-input">
                    <span class="new-control-indicator"></span><span>I agree to the <a href="javascript:void(0);"> terms and conditions </a></span>
                </label>
            </div>

        </div>

        <div class="d-sm-flex justify-content-between">
            <div class="field-wrapper">
                <button type="submit" class="btn btn-primary" value="">Get Started!</button>
            </div>
        </div>

    </div>
    <?= form_close() ?>

</div>