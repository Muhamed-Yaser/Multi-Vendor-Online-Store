import Echo from 'laravel-echo'

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: '414fcd32acf256e6c48e',
  cluster: 'eu',
  forceTLS: true
});

var channel = Echo.private(`App.Models.Admin.${adminID}`);
channel.notification(function (data) {
    console.log(data);
    alert(data.body);
});
