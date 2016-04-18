<!DOCTYPE html>
<html>
    <head>
        <title>Repo Rank</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,400,700" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                    <input type="submit" class="btn btn-success" value="Generate Markdown"/>
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
                <div class="text-center text-muted">copy and paste into your GitHub readme to display the repo rank badge</div>
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
        <div class="text-center text-muted" style="margin-bottom: 20px;">Made with &lt;3 by <a href="http://stuyam.com">Stuart Yamartino</a></div>

        <a href="https://github.com/yamartino/reporank" class="github-corner"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:#FD6C6C; color:#fff; position: absolute; top: 0; border: 0; right: 0;"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style>

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
