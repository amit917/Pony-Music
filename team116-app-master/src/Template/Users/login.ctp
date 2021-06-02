<div class="row">
    <div class="col-lg-4 col-md-6 ml-auto mr-auto">
        <div class="card">
            <br class="mb-5">
            <p class="description text-center"><?= $this->Html->image('pony_logo.png', ['alt' => 'Pony Music logo',
                'width' => 200]); ?></p>
            <div class="card-body card-login">
                <?= $this->Flash->render('auth') ?>
                <?= $this->Form->create() ?>
                <div class="form-group">
                    <?= $this->Form->control('email', ['class' => 'form-control', 'label' => 'Email:', 'placeholder'
                    => 'Email', 'type' => 'email', 'required' => true]) ?>
                </div>
                <div class="form-group">
                    <?= $this->Form->control('password', ['class' => 'form-control', 'label' => 'Password:',
                    'placeholder' => 'Password', 'type' => 'password', 'required' => true]) ?>
                </div>
                <br>
                <div class="form-group">
                    <?= $this->Form->button('Login',['class'=>'btn btn-block btn-primary']); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <br>
            <div class="footer text-center">
                <div class="form-group">
                    <?= $this->Html->link('I forgot my password',['controller'=>'users','action'=>'forgot_password'])?>
                </div>
            </div>
        </div>
    </div>
</div>