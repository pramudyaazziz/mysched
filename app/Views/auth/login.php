<?= $this->extend("layouts/auth"); ?>
<?= $this->section("content"); ?>
<div class="container auth">
    <div class="col">
        <!-- Outer Row -->
        <div class="row h-100 justify-content-center align-items-center">

            <div class="col-lg-6 col-md-9">

                <div class="card o-hidden border-0 shadow-lg ">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4">Welcome Back!</h1>
                                    </div>
                                    <?php if (session()->getFlashdata('success')) : ?>
                                        <div class="alert alert-success alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">x</button>
                                                <?= session()->getFlashdata('success') ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                    <?php if (session()->getFlashdata('error')) : ?>
                                        <div class="alert alert-warning alert-dismissible show fade">
                                            <div class="alert-body">
                                                <button class="close" data-dismiss="alert">x</button>
                                                <?= session()->getFlashdata('error') ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <form method="POST" action="<?= route_to('login.proses') ?>" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" name="username" aria-describedby="emailHelp" placeholder="Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block"><i class="fa-solid fa-right-to-bracket mr-1"></i>Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= route_to('register') ?>">Create an Account!</a>
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
<?= $this->endSection(); ?>