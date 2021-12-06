<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Регистрационная форма</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>

    <body>
        <div class="container d-flex align-items-center vh-100" style="width: 70ch;">
            <div id="message" class="alert d-none mt-3"></div>

            <form id="my-form" class="row g-3 mt-1" method="POST">
                <h2 class="d-flex justify-content-center">Регистрация пользователя</h2>

                <div class="col-12">
                    <label for="inputEmail" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail4">
                </div>

                <div class="col-12">
                    <label for="inputPassword" class="form-label">Пароль</label>
                    <input type="password" name="password" class="form-control" id="inputPassword4">
                </div>

                <div class="col-12">
                    <label for="inputRepeatPassword" class="form-label">Повторите пароль</label>
                    <input type="password" name="repeat-password" class="form-control" id="inputPassword5">
                </div>

                <div class="col-12">
                    <label for="inputName" class="form-label">Имя</label>
                    <input type="text" name="firstname" class="form-control" id="inputAddress" placeholder="Егор">
                </div>

                <div class="col-12">
                    <label for="inputSurname" class="form-label">Фамилия</label>
                    <input type="text" name ="surname" class="form-control" id="inputAddress2" placeholder="Кузнецов">
                </div>

                <div class="col-12">
                    <button type="submit" id="send-data" class="btn btn-primary">Зарегистрироваться</button>
                </div>
            </form>
        </div>
    </body>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</html>