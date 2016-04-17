<!DOCTYPE html>
<html>
    <head>
        <title>Repo Rank</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,400,700" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    </head>
    <body>
        <header class="container">
            <h1 class="text-center">Repo Rank</h1>
            <form>
                <div class="github-url">
                    http://github.com/
                </div>
                <div>
                    <input type="text" class="form-control" name="u" placeholder="username" value="{{$username}}" />
                </div>
                <div class="slash">/</div>
                <div>
                    <input type="text" class="form-control" name="r" placeholder="repository" value="{{$repository}}" />
                </div>
                <div>
                    <input type="submit" class="btn btn-success" value="Generate Code"/>
                </div>
            </form>
            @if(strlen($username) > 0 && strlen($repository) > 0)
                <div class="examples">
                    <div>
                        <img src="https://reporank.com/{{$username}}/{{$repository}}">
                        <textarea class="form-control" rows="4">[![GitHub Rank](https://reporank.com/{{$username}}/{{$repository}})](https://reporank.com?u={{$username}}&r={{$repository}})</textarea>
                    </div>
                    <div>
                        <img src="https://reporank.com/{{$username}}/{{$repository}}?style=square">
                        <textarea class="form-control" rows="4">[![GitHub Rank](https://reporank.com/{{$username}}/{{$repository}}?style=square)](https://reporank.com?u={{$username}}&r={{$repository}})</textarea>
                    </div>
                    <div>
                        <img src="https://reporank.com/{{$username}}/{{$repository}}?style=plastic">
                        <textarea class="form-control" rows="4">[![GitHub Rank](https://reporank.com/{{$username}}/{{$repository}}?style=plastic)](https://reporank.com?u={{$username}}&r={{$repository}})</textarea>
                    </div>
                    <div>
                        <img src="https://reporank.com/{{$username}}/{{$repository}}?style=social">
                        <textarea class="form-control" rows="4">[![GitHub Rank](https://reporank.com/{{$username}}/{{$repository}}?style=social)](https://reporank.com?u={{$username}}&r={{$repository}})</textarea>
                    </div>
                </div>
            @endif
        </header>
        <hr />
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Rank</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($all as $repo)
                        <tr>
                            <td><a href="https://github.com/{{$repo->username}}/{{$repo->name}}" target="new">{{$repo->username}}/{{$repo->name}}</a></td>
                            <td>{{numberReadable($repo->rank)}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            window.ga=function(){ga.q.push(arguments)};ga.q=[];ga.l=+new Date;
            ga('create','UA-76518755-1','auto');ga('send','pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
        <script src="https://code.jquery.com/jquery-2.2.2.min.js" integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
        <script type="text/javascript">
          $(function() {
            $("textarea").focus(function() { $(this).select(); } );
          });
        </script>
    </body>
</html>
