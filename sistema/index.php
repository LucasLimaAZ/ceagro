<?php include 'partials/cabecalho.html' ?>


<style>
    body{
        background-color:#ECF0F5;
    }

    .loginCanvas{
        padding:1%;
        margin-top:15%;
        background-color:white;
        -webkit-box-shadow: 0px 0px 10px 1px rgba(156,156,156,1);
        -moz-box-shadow: 0px 0px 10px 1px rgba(156,156,156,1);
        box-shadow: 0px 0px 10px 1px rgba(156,156,156,1);
    }

</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3 loginCanvas">
                <div class="row">
                    <div style="text-align:center;padding:2%;margin-bottom:40px;" class="col-xs-12">
                        <img src="https://ceagro.com.br/wp-content/uploads/2018/12/d8b59575d9e85809b64607abad8383b4eab9a0e44d2a0a66c0688c627d6ca33d.png" width="200px" style="text-align:center;">
                    </div>
                </div>
                <div class="row">
                    <?php require('partials/components/errologin.html') ?>
                </div>
                <div class="row" style="margin-bottom:40px">
                    <div class="col-xs-12">
                        <form id="login">
                            <label for="usuario">Usuário: </label>
                            <input type="text" id="usuario" name="usuario" class="form-control">
                            <label style="padding-top:20px;" for="senha">Senha: </label>
                            <input type="password" id="senha" name="senha" class="form-control">
                            <button type="button" class="btn btn-primary" id="botao-login" style="margin-top:20px;width:100%" name="login">Entrar</button>
                            <p id="message" style="color:red;text-align:center;margin-top:20px;"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="public/assets/js/login.js"></script>
</html>