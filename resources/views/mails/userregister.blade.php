<h1>{{config('app.name')}}</h1>
<p>Merhaba {{$user->user_name}}. Kaydınız başarılı bir şekilde yapıldı</p>
<p>Kaydınızı aktifleştirmek için <a href="{{config('app.url')}}/user/activate/{{$user->activation_key}}">tıklayın</a>
    veya aşağıdaki bağlantıyı tarayıcınızda açın.</p>
<p>{{config('app.url')}}/user/activate/{{$user->activation_key}}</p>

