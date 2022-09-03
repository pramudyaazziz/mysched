<?= $this->extend("layouts/auth"); ?>
<?= $this->section("content"); ?>
< <div class="container">

    <!-- Nested Row within Card Body -->
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card o-hidden border-0 shadow-lg mt-4">
                <div class="card-body p-0">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <?php if (isset($validation)) : ?>
                            <div class="alert alert-danger">
                                <?= $validation->listErrors() ?>
                            </div>
                        <?php endif; ?>
                        <form action="<?= route_to('register.proses') ?>" method="post" class="user">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control form-control-user" value="<?= set_value('name') ?>" placeholder="Full Name">
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-user" value="<?= set_value('username') ?>" placeholder="username">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-user" value="<?= set_value('email') ?>" placeholder="Email Address">
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" name="confirmpassword" class="form-control form-control-user" placeholder="Repeat Password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Register</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= route_to('login') ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <?= $this->endSection(); ?>