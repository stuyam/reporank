<!DOCTYPE html>
<html>
    <head>
        <title>Repo Rank</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100,400,700" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 6em;
                margin-bottom: 30px;
            }
            .form-text{
                font-size: 1.5em;
                letter-spacing: 1px;
                font-weight: 400;
            }
            input{
                font-weight: 700;
                text-align: center;
            }
            .btn{
                width: 100%;
            }
            #username:after{
                content: "/";
                display: block;
                font-size: 1.5em;
                position: absolute;
                top: 0;
                right: -3px;
                font-weight: 400;
            }
            .form > *{
                margin-bottom: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Repo Rank</div>
                <div class="row form">
                    <div class="col-sm-3 form-text">
                        http://github.com/
                    </div>
                    <div class="col-sm-2" id="username">
                        <input type="text" class="form-control" placeholder="username" />
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" placeholder="repository" />
                    </div>
                    <div class="col-sm-3">
                        <input type="submit" class="btn btn-success" value="Generate Code"/>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
