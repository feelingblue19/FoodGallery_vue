<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading"><strong>Verifikasi Akun</strong></div>
        <div class="panel-body">
            <p>Halo, {{$user->first_name}}</p>
            <p>Silakan klik link di bawah ini untuk melakukan verifikasi akun</p>
            <a href="{{ route('User.verif', $user->email_token)}}">{{ route('User.verif', $user->email_token)}}</a>
        </div>
    </div>
</div>

<style>
  .panel {
      margin-bottom: 20px;
      background-color: #fff;
      border: 1px solid transparent;
      border-radius: 4px;
      -webkit-box-shadow: 0 1px 1px rgba(0,0,0,.05);
      box-shadow: 0 1px 1px rgba(0,0,0,.05);
  }
  .panel-default {
      border-color: #ddd;
  }
  .panel-default>.panel-heading {
      color: #333;
      background-color: #f5f5f5;
      border-color: #ddd;
  }
  .panel-heading {
      padding: 10px 15px;
      border-bottom: 1px solid transparent;
      border-top-left-radius: 3px;
      border-top-right-radius: 3px;
  }

  .panel-body {
      padding: 15px;
  }

</style>

