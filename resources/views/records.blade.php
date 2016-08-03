<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>备案信息</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default">
                <div class="panel-heading">备案信息</div>

                <div class="panel-body">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>域名</th>
                        <th>主办单位名称</th>
                        <th>单位性质</th>
                        <th>网站备案/许可证号</th>
                        <th>网站名称</th>
                        <th>网站首页网址</th>
                        <th>审核时间</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($records as $record)
                        <tr>
                          <td>{{ $record->domain }}</td>
                          <td>{{ $record->company }}</td>
                          <td>{{ $record->company_type }}</td>
                          <td>{{ $record->license }}</td>
                          <td>{{ $record->website }}</td>
                          <td>{!! $record->website_front !!}</td>
                          <td>{{ $record->time }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {!! $records->render() !!}
                </div>
        </div>
    </div>
</div>
</body>
</html>
